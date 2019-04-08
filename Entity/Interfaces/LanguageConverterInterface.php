<?php

namespace Baudev\PHPObjectConverterBundle\Entity\Interfaces;

use Baudev\PHPObjectConverterBundle\Entity\AttributeNode;
use Baudev\PHPObjectConverterBundle\Entity\ClassNode;
use Baudev\PHPObjectConverterBundle\Entity\Enums\AccessibilityEnum;

interface LanguageConverterInterface
{

    /**
     * The language name.
     * @return string
     */
    function getLanguageName();

    /**
     * Returns the corresponding string for a class.
     * @param ClassNode $classNode
     * @return string
     */
    function getClassLine(ClassNode $classNode = null);

    /**
     * Returns the line to close the class.
     * @param ClassNode $classNode
     * @return mixed
     */
    function getClassEndLine(ClassNode $classNode = null);

    /**
     * Returns the corresponding string for an attribute.
     * @param AttributeNode $attributeNode
     * @return string
     */
    function getAttributeLine(AttributeNode $attributeNode);


    /**
     * Returns the equivalent string for the type passed as parameter.
     * @param string $typeEnum
     * @see TypesEnum
     */
    function getCorrespondingType(string $typeEnum);

    /**
     * Returns the equivalent.
     * @param string $accessibilityEnum
     * @see AccessibilityEnum
     */
    function getCorrespondingAccessibility(string $accessibilityEnum);

    /**
     * Returns the file extension.
     * @return string
     */
    function getFileExtension();

}