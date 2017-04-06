<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class Login extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login', ['title' => 'Login', 'subtitle' => 'Members']);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        return $this->handleSocialCallback(Socialite::driver('facebook')->user());
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        return $this->handleSocialCallback(Socialite::driver('google')->user());
    }

    /**
     * @param  \Laravel\Socialite\Two\User
     * @return \Illuminate\Http\Response
     */
    private function handleSocialCallback($user)
    {
        $existingUser = User::where('email', $user->getEmail())->first();

        if (!$existingUser) {
            $this->logout();

            return redirect()->route('register', ['oauthSuccess' => true]);
        }

        Auth::login($existingUser, true);

        return redirect()->intended($this->redirectPath());
    }
}
