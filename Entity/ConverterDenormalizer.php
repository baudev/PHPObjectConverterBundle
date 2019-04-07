<?php

namespace Baudev\PHPObjectConverterBundle\Entity;

use Baudev\PHPObjectConverterBundle\Entity\Interfaces\LanguageConverterInterface;

final class ConverterDenormalizer
{

    /**
     * @var LanguageConverterInterface
     */
    private $languageConverter;

    /**
     * @var ClassNode
     */
    private $currentNodeClass;

    /**
     * ConverterHandler constructor.
     * @param LanguageConverterInterface $languageConverter
     */
    public function __construct(LanguageConverterInterface $languageConverter)
    {
        $this->languageConverter = $languageConverter;
    }

    /**
     * Sets the current class
     * @param ClassNode $classNode
     */
    public function setCurrentNodeClass(ClassNode $classNode){
        $this->currentNodeClass = $classNode;
    }


    /**
     * Returns the string output for every attributes.
     * @return string
     */
    private function getAttributesOutput(){
        $attributesOutput = '';
        /** @var AttributeNode $attributeNode */
        foreach ($this->currentNodeClass->getAttributes() as $attributeNode){
            $attributeNode->setCorrespondingType($this->languageConverter->getCorrespondingType($attributeNode->getCorrespondingType()));
            $attributeNode->setCorrespondingAccessibility($this->languageConverter->getCorrespondingAccessibility($attributeNode->getCorrespondingAccessibility()));
            $a = function (){ return 'test'; };
            $attributesOutput = $attributesOutput . $this->languageConverter->getAttributeLine($attributeNode);
        }
        return $attributesOutput;
    }

    /**
     * Returns the file output to be saved.
     * @return string
     */
    public function __toString()
    {
        return $this->languageConverter->getClassLine($this->currentNodeClass).$this->getAttributesOutput().$this->languageConverter->getClassEndLine();
    }


}