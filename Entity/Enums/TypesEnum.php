<?php

namespace Baudev\PHPObjectConverterBundle\Entity\Enums;

/**
 * Class TypesEnum
 * @package Baudev\PHPObjectConverterBundle\Entity\Enums
 * @see https://www.php.net/manual/en/language.types.intro.php
 */
final class TypesEnum
{

    public const BOOLEAN = 'bool';
    public const INTEGER = 'int';
    public const FLOAT = 'float';
    public const STRING = 'string';

    public const ARRAY = 'array';
    public const OBJECT = 'object';
    public const CALLABLE = 'callable';
    public const ITERABLE = 'iterable';

    public const RESOURCE = 'resource';
    public const NULL = 'null';

    public const UNKNOWN = 'UNKNOWN';

}