<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPassword extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
