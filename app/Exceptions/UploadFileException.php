<?php

namespace App\Exceptions;

use Exception;

class UploadFileException extends Exception
{
    public function render()
    {
        return response()->fail('unable to upload image');
    }
}
