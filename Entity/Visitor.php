<?php

namespace Baudev\PHPObjectConverterBundle\Entity;

use Baudev\PHPObjectConverterBundle\Entity\Enums\TypesEnum;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\NodeVisitorAbstract;

class Visitor extends NodeVisitorAbstract
{
    /**
     * @var bool
     */
    private $isToConvert = null;

    /** @var ClassNode */
    private $output;

    /**
     * @var bool
     */
    private $ignoreAnnotations, $enableAnnotations, $addPrivate, $addProtected;

    public function __construct(bool $ignoreAnnotations, bool $enableAnnotations, bool $addPrivate, bool $addProtected)
    {
        $this->ignoreAnnotations = $ignoreAnnotations;
        $this->enableAnnotations = $enableAnnotations;
        $this->addPrivate = $addPrivate;
        $this->addProtected = $addProtected;
    }

    public function enterNode(Node $node)
    {
        // it's a class
        if ($node instanceof Class_) {
            /** @var Class_ $class */
            $class = $node;
            // we check the annotations settings
            if($this->ignoreAnnotations){
                // we check if the class is ignored
                if($this->isContainAnnotation($class, "@ConverterIgnore")){
                    $this->isToConvert = false;
                }
            }
            if($this->enableAnnotations){
                // we check if the class is explicitly declared to convert
                if($this->isContainAnnotation($class, "@Converter")){
                    $this->isToConvert = true;
                    $this->output = new ClassNode($class->name, $class->extends);
                }
            }
            if(!$this->enableAnnotations && (($this->ignoreAnnotations && $this->isToConvert !== false) || !$this->ignoreAnnotations )) {
                // all classes must be converted except ignored ones
                $this->isToConvert = true;
                $this->output = new ClassNode($class->name, $class->extends);
            }
        }
        if ($this->isToConvert) {
            if ($node instanceof Property) {
                /** @var Property $property */
                $property = $node;
                $accessibility = null;
                if($property->isPublic()){
                    $accessibility = 'public';
                } else if($property->isPrivate()){
                    $accessibility = 'private';
                } else {
                    $accessibility = 'protected';
                }
                if($property->isStatic()){
                    $accessibility = $accessibility . ' static';
                }
                if ($property->isPublic() || ($property->isPrivate() && $this->addPrivate) || ($property->isProtected() && $this->addProtected)) {
                    $type = $this->parsePHPDocAttributeAnnotation($property->getDocComment());
                    $this->output->addAttribute(new AttributeNode($property->props[0]->name, $type, $accessibility));
                }
            }
        }
    }

    /**
     * Checks if the class contains the $annotation.
     * @param $class
     * @param string $annotation
     * @return bool
     */
    private function isContainAnnotation($class, string $annotation) {
        return $class->getDocComment() && strpos($class->getDocComment()->getText(), $annotation);
    }

    /**
     * @param Node $node
     * @return int|null|Node|Node[]|void
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Class_) {
            $this->isToConvert = false;
        }
    }

    /**
     * Returns the attribute type
     * @param \PhpParser\Comment|null $phpAnnotation
     * @return string
     */
    private function parsePHPDocAttributeAnnotation($phpAnnotation)
    {
        $result = TypesEnum::UNKNOWN;
        if ($phpAnnotation !== null) {
            if (preg_match('/@var[ \t]+([a-z0-9]+)/i', $phpAnnotation->getText(), $matches)) {
                $type = trim(strtolower($matches[1]));
                return $type;
            }
        }
        return $result;
    }

    /**
     * Returns
     * @return ClassNode
     */
    public function getOutput()
    {
        return $this->output;
    }
}