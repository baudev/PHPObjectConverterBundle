<?php

namespace Baudev\PHPObjectConverterBundle\Entity;

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

    public function __toString()
    {
        return 'att';
        // TODO: Implement __toString() method.
    }


}