<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        try {
            $user = Socialite::driver('github')->user();

            $searchUser = User::where('github_id', $user->id)->first();
            if ($searchUser) {
                Auth::login($searchUser);

                return redirect('/dashboard');
            } else {
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'auth_type'=> 'github',
                    'password' => Str::uuid()->toString(),
                ]);

                Auth::login($gitUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'github_id' => $user->github_id,
            ],
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
