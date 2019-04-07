<?php

namespace Baudev\PHPObjectConverterBundle\Entity\Enums;

/**
 * Different possible attribute accessor.
 * @package Baudev\PHPObjectConverterBundle\Entity\Enums
 */
class AccessibilityEnum
{

    public const PUBLIC = 'public';
    public const PUBLIC_STATIC = self::PUBLIC. ' static';

    public const PRIVATE = 'private';
    public const PRIVATE_STATIC = self::PRIVATE. ' static';

    public const PROTECTED = 'protected';
    public const PROTECTED_STATIC = self::PROTECTED. ' static';

}