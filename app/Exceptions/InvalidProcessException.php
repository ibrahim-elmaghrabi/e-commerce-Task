<?php

namespace App\Exceptions;

use Exception;


class InvalidProcessException  extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'error can not  set order from your store'
        ]);
    }
}