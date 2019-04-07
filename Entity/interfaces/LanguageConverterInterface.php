<?php

namespace Baudev\PHPObjectConverterBundle\Entity\interfaces;

interface LanguageConverterInterface
{

    /**
     * The language name.
     * @return string
     */
    function getLanguageName();

    /**
     * Returns the corresponding string for an attribute.
     * @param \Baudev\PHPObjectConverterBundle\Entity\AttributeNode $attributeNode
     * @return string
     */
    function getAttributeLine(\Baudev\PHPObjectConverterBundle\Entity\AttributeNode $attributeNode);

    /**
     * Returns the corresponding string for a class.
     * @param \Baudev\PHPObjectConverterBundle\Entity\ClassNode $classNode
     * @return string
     */
    function getClassLine(\Baudev\PHPObjectConverterBundle\Entity\ClassNode $classNode);

    /**
     * Returns the equivalent string for the string PHP type.
     * @return string
     */
    function getStringType();

    /**
     * Returns the equivalent string for the integer PHP type.
     * @return string
     */
    function getIntegerType();

}