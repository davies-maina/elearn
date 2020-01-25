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
            request()->session()->flash('success', 'Your email has been confirmed');
            return redirect('/');
        } else {
            request()->session()->flash('error', 'confirmation token not recognized');
            return redirect('/');
        }
    }
}
