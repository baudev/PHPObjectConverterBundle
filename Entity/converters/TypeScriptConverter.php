<?php

namespace Baudev\PHPObjectConverterBundle\Entity\converters;

use Baudev\PHPObjectConverterBundle\Entity\interfaces\LanguageConverterInterface;

class TypeScriptConverter implements LanguageConverterInterface
{


    /**
     * The language name.
     * @return string
     */
    function getLanguageName()
    {
        return 'typescript';
    }

    /**
     * Returns the corresponding string for an attribute.
     * @param \Baudev\PHPObjectConverterBundle\Entity\AttributeNode $attributeNode
     * @return string
     */
    function getAttributeLine(\Baudev\PHPObjectConverterBundle\Entity\AttributeNode $attributeNode)
    {
        return 'line';
    }

    /**
     * Returns the corresponding string for a class.
     * @param \Baudev\PHPObjectConverterBundle\Entity\ClassNode $classNode
     * @return string
     */
    function getClassLine(\Baudev\PHPObjectConverterBundle\Entity\ClassNode $classNode)
    {
        return 'class';
    }

    /**
     * Returns the equivalent string for the string PHP type.
     * @return string
     */
    function getStringType()
    {
        return 'string';
    }

    /**
     * Returns the equivalent string for the integer PHP type.
     * @return string
     */
    function getIntegerType()
    {
        return 'number';
    }

    /**
     * Returns the file extension.
     * @return string
     */
    function getFileExtension()
    {
        return '.ts';
    }
}