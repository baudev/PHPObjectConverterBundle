<?php

namespace Baudev\PHPObjectConverterBundle\Exception;

class InvalidLanguageConverter extends \Exception
{

    public function __construct(string $converterName)
    {
        $message = "The converter ".$converterName. " does'nt exist.";
        parent::__construct($message, 0, null);
    }

}