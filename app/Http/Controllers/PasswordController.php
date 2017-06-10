<?php namespace App\Http\Controllers;

use App\Http\Traits\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->broker = 'users';
    }
}