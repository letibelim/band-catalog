<?php

namespace App\Import\Exception;

use RuntimeException;

class BadlyFormattedFileException extends RuntimeException
{
    protected $message = 'File is not correctly formatted';
}
