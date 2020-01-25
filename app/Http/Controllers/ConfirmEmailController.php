<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ConfirmEmailController extends Controller
{
    public function index()
    {
        $token = request('token');

        $user = User::where('confirm_token', $token)->first();

        if ($user) {
            $user->confirm();
            return redirect('/');
        }
    }
}
