<?php

namespace App\Exception;

class ProductUniqueException extends \RuntimeException
{
    public function __construct(string $sku)
    {
        parent::__construct("Product #" . $sku . " is already registered.");
    }

}