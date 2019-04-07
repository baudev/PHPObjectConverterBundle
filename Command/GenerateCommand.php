<?php

namespace Baudev\PHPObjectConverterBundle\Command;


use Baudev\PHPObjectConverterBundle\Entity\ConverterDenormalizer;
use Baudev\PHPObjectConverterBundle\Entity\Interfaces\LanguageConverterInterface;
use Baudev\PHPObjectConverterBundle\Entity\Visitor;
use Baudev\PHPObjectConverterBundle\Exception\InvalidLanguageConverter;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class GenerateCommand extends Command
{

    protected static $defaultName = 'converter:generate';

    /**
     * @var bool
     */
    private $ignoreAnnotations, $enableAnnotations, $addPrivate, $addProtected;
    /**
     * @var string Project directory.
     */
    private $projectDir;

    public function __construct($projectDir, bool $ignoreAnnotations, bool $enableAnnotations, bool $addPrivate, bool $addProtected)
    {
        parent::__construct();
        $this->projectDir = $projectDir;
        $this->ignoreAnnotations = $ignoreAnnotations;
        $this->enableAnnotations = $enableAnnotations;
        $this->addPrivate = $addPrivate;
        $this->addProtected = $addProtected;
    }

    protected function configure()
    {
        $this
            ->setName('converter:generate')
            ->setDescription('Convert PHP classes into ones in a different language.')
            ->addArgument(
                'converter',
                InputArgument::REQUIRED,
                'Which class converter must be used.'
            )
            ->addArgument(
                'fromDir',
                InputArgument::REQUIRED,
                'The directory containing classes to scan.'
            )
            ->addArgument(
                'toDir',
                InputArgument::OPTIONAL,
                'Where to export generated classes.'
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws InvalidLanguageConverter
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // we collect command params
        $language = $input->getArgument('converter');
        $fromDir = $input->getArgument('fromDir');
        $toDir = $input->getArgument('toDir');
        if($toDir === null){
            $toDir = 'build';
        }

        // we check if the converter exists
        /** @var LanguageConverterInterface $converter */
        $converter = null;
        $finder = new Finder();
        $finder->files('*.php')->in(__DIR__ . '/../Entity/Converters/');
        foreach ($finder as $file){
            // we instance each class of the directory Converters
            $base = 'Baudev\PHPObjectConverterBundle\Entity\Converters';
            if($file->getRelativePath() != null){
                $base = $base. '\\'.$file->getRelativePath();
            }
            $name = $base.'\\'.basename($file->getFilename(), '.php');
            $class = new \ReflectionClass($name);
            /** @var LanguageConverterInterface $obj */
            $obj = $class->newInstanceArgs();
            if($language === $obj->getLanguageName()){
                $converter = $obj;
                break;
            }
        }
        // if any converter is matching, we throw an error
        if($converter === null){
            throw new InvalidLanguageConverter($language);
        }

        // we parse the different entity objects
        $converterDenormalizer = new ConverterDenormalizer($converter);
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $traverser = new NodeTraverser();
        $fs = new Filesystem();
        $finder = new Finder();
        $finder->files('*.php')->in( $this->projectDir . '/' . $fromDir);

        // for each class of the from directory
        foreach ($finder as $file) {
            // we collect class and attributes information
            $visitor = new Visitor($this->ignoreAnnotations, $this->enableAnnotations, $this->addPrivate, $this->addProtected);
            $traverser->addVisitor($visitor);
            $code = $file->getContents();
            try {
                $traverser->traverse($parser->parse($code));
                if($visitor->getOutput()){
                    $targetFile = $this->projectDir . '/' . $toDir . '/' . str_replace( '.php','.ts', $file->getFilename());
                    // we set which classNode must be denormalized
                    $converterDenormalizer->setCurrentNodeClass($visitor->getOutput());
                    // we save the output
                    $fs->dumpFile($targetFile, $converterDenormalizer);
                    $output->writeln('Class file created ' . $targetFile);
                }
            } catch (\ParseError $e) {
                $output->writeln('Error while parsing a PHP class: ' .$e->getMessage());
            }
        }

    }

}