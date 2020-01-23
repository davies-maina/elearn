<?php

namespace App\Exceptions;

use Exception;

class AuthFailsException extends Exception
{

    public function render()
    {

        return response()->json([

            'message' => 'credentials dont match our records'
        ], 422);
    }
}
