<?php

namespace Baudev\PHPObjectConverterBundle\Entity\Converters;

use Baudev\PHPObjectConverterBundle\Entity\AttributeNode;
use Baudev\PHPObjectConverterBundle\Entity\ClassNode;
use Baudev\PHPObjectConverterBundle\Entity\Enums\AccessibilityEnum;
use Baudev\PHPObjectConverterBundle\Entity\Enums\TypesEnum;
use Baudev\PHPObjectConverterBundle\Entity\Interfaces\LanguageConverterInterface;

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
     * @param AttributeNode $attributeNode
     * @return string
     */
    function getAttributeLine(AttributeNode $attributeNode)
    {
        return '    '.$attributeNode->getCorrespondingAccessibility(). ' ' . $attributeNode->getName().':'. $attributeNode->getCorrespondingType().";\n";
    }

    /**
     * Returns the corresponding string for a class.
     * @param ClassNode $classNode
     * @return string
     */
    function getClassLine(ClassNode $classNode = null)
    {
        return "class ". $classNode->getName() ." {\n\n";
    }


    /**
     * Returns the line to close the class.
     * @param ClassNode $classNode
     * @return mixed
     */
    function getClassEndLine(ClassNode $classNode = null)
    {
        return "\n}";
    }

    /**
     * Returns the equivalent string for the type passed as parameter.
     * @param string $typeEnum
     * @return string
     * @see TypesEnum
     */
    function getCorrespondingType(string $typeEnum)
    {
        return function ($typeEnum) {
            switch ($typeEnum) {
                case TypesEnum::STRING:
                    return 'string';
                    break;
                case TypesEnum::INTEGER:
                    return 'number';
                default:
                    return 'any';
            }
        };
    }

    /**
     * @param string $accessibilityEnum
     * @return mixed|string
     */
    public function getCorrespondingAccessibility(string $accessibilityEnum)
    {
        return function ($accessibilityEnum) {
            switch ($accessibilityEnum) {
                case AccessibilityEnum::PUBLIC:
                    return 'public';
                case AccessibilityEnum::PUBLIC_STATIC:
                    return 'public static';
                case AccessibilityEnum::PRIVATE:
                    return 'private';
                case AccessibilityEnum::PRIVATE_STATIC:
                    return 'private static';
                case AccessibilityEnum::PROTECTED:
                    return 'protected';
                case AccessibilityEnum::PROTECTED_STATIC:
                    return 'protected static';
                default:
                    return "public";
            }
        };
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