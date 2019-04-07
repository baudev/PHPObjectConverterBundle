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
    private $attributes;

    /**
     * @var string|null If the class extends one class, it will be the extended class name.
     */
    private $extends;

    // TODO add Interfaces?
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
        $this->attributes = array();
    }

    public function __toString()
    {
        return 'node'.$this->name;
    }

    /**
     * @param string $extends
     */
    public function setExtends(string $extends): void
    {
        $this->extends = $extends;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return AttributeNode[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param AttributeNode[] $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * Adds attribute to the Class
     * @param AttributeNode $attributeNode
     */
    public function addAttribute(AttributeNode $attributeNode){
        $this->attributes[] = $attributeNode;
    }


}