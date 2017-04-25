<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $creds = $request->only($this->username(), 'password');
        $creds['active'] = true;

        return $creds;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // The old system used a poor password hash, so the passwords have been nullified during the migration.
        // If a user wants to login with local auth, they need to reset their password first.
        $user = User::where('email', $request->get($this->username()))->first();

        if ($user and $user->password == '0') {
            return redirect()
                ->route('password.request')
                ->with('errorMsg', 'For security purposes, your password needs to be reset.');
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => trans('auth.failed')]);
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
        $existingUser = User::where([
            ['email', $user->getEmail()],
            ['active', true],
        ])->first();

        if (!$existingUser)
            return redirect()->route('register')->with('oauthSuccess', true);

        Auth::login($existingUser, true);

        return redirect()->intended($this->redirectPath());
    }
}
