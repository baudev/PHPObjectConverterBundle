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
     * @var string If the class extends one class, it will be the extended class name.
     */
    private $extends;

    // TODO add interfaces?
    // TODO add final, abstract...?

    /**
     * ClassNode constructor.
     * @param string $name
     * @param AttributeNode[] $attributes
     * @param string $extends
     */
    public function __construct(string $name, array $attributes, string $extends)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->extends = $extends;
    }

}