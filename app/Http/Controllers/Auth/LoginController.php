<?php

namespace App\Http\Controllers\Auth;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login with Google. Please try again.');
        }

        if (!str_contains($googleUser->getEmail(), '@alunos.utfpr.edu.br') && !str_contains($googleUser->getEmail(), '@utfpr.edu.br')) {
            return redirect()->route('login')->with('error', 'Acesso negado. Utilize um e-mail UTFPR.');
        }
        $authUser = User::where('google_id', $googleUser->getId())->first();

        if (!$authUser) {
            $authUser = User::create([
                'name' => ucwords(strtolower($googleUser->getName())),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt($googleUser->getId()),
                'email_verified_at' => now(),
            ]);
        }

        $professor = Professor::where('email', $googleUser->getEmail())->first();

        if (!$professor) {
            Professor::create([
                'name' => ucwords(strtolower($googleUser->getName())),
                'email' => $googleUser->getEmail(),
            ]);
        }

        Auth::login($authUser, true);

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
