<?php

namespace Baudev\PHPObjectConverterBundle\Entity;

use Baudev\PHPObjectConverterBundle\Entity\Interfaces\LanguageConverterInterface;

class AttributeNode
{
    /**
     * @var string The attribute name.
     */
    private $name;

    /**
     * @var string The type of the attribute.
     */
    private $type;

    /**
     * @var string The accessibility of the attribute such as public, private or protected.
     */
    private $accessibility;

    /**
     * Methods which will be executed to transform $type and $accessibility.
     * @var callable
     * @see LanguageConverterInterface::getCorrespondingAccessibility()
     * @see LanguageConverterInterface::getCorrespondingType()
     */
    private $correspondingAccessibility, $correspondingType;

    /**
     * AttributeNode constructor.
     * @param string $name
     * @param string $type
     * @param string $accessibility
     */
    public function __construct(string $name, string $type, string $accessibility)
    {
        $this->name = $name;
        $this->type = $type;
        $this->accessibility = $accessibility;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCorrespondingType(): string
    {
        // we use the transformation function
        if($this->correspondingType !== null){
            return call_user_func($this->correspondingType, $this->type);
        }
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCorrespondingAccessibility(): string
    {
        // we use the transformation function
        if($this->correspondingAccessibility !== null){
            return call_user_func($this->correspondingAccessibility, $this->accessibility);
        }
        return $this->accessibility;
    }

    /**
     * @param callable $correspondingAccessibility
     */
    public function setCorrespondingAccessibility(callable $correspondingAccessibility): void
    {
        $this->correspondingAccessibility = $correspondingAccessibility;
    }

    /**
     * @param mixed $correspondingType
     */
    public function setCorrespondingType(callable $correspondingType): void
    {
        $this->correspondingType = $correspondingType;
    }





}