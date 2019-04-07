<?php

namespace Baudev\PHPObjectConverterBundle\Entity;

class ClassNode
{
    /**
     * @var string The class name.
     */
    private $name;

    /**
     * @var AttributeNode[] The different attributes of the class.
     */
    public $attributes;

    /**
     * @var string|null If the class extends one class, it will be the extended class name.
     */
    private $extends;

    // TODO add interfaces?
    // TODO add final, abstract...?

    /**
     * ClassNode constructor.
     * @param string $name
     * @param string|null $extends
     */
    public function __construct(string $name, ?string $extends)
    {
        $this->name = $name;
        $this->extends = basename($extends);
    }

    public function __toString()
    {
        return 'node'.$this->name;
    }

    /**
     * Adds attribute to the Class
     * @param AttributeNode $attributeNode
     */
    public function addAttribute(AttributeNode $attributeNode){
        $this->attributes[] = $attributeNode;
    }

    /**
     * @param string $extends
     */
    public function setExtends(string $extends): void
    {
        $this->extends = $extends;
    }

}