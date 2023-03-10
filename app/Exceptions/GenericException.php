<?php

namespace App\Exceptions;

use Exception;


class GenericException  extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'error happened please try again '
        ]);
    }
}