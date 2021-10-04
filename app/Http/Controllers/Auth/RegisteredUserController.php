<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $temporary_user = EmailVerification::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'expiration_datetime' => now()->addHour(1),
            'token' => uniqid('', true),
        ]);

        Mail::to($request->email)->send(new \App\Mail\SendVerifyEmailMail($temporary_user));

        return redirect('/verify_email/notification');
    }
    public function notification()
    {
        return view('auth.verify-email-notifications');
    }
    public function invalid_token()
    {
        return view('auth.invalid-token');
    }
    public function verify($verify_id, $token, Request $request)
    {
        $temporary_user = EmailVerification::where('id', $verify_id)
            ->where('token', $token)
            ->where('expiration_datetime', '>=', now()->subHour(1))
            ->first();

        if (is_null($temporary_user)) {
            return redirect('/verify_email/invalid_token');
        }

        $is_exists = User::where('email', $temporary_user->email)->exists();

        if ($is_exists) {
            return redirect('/verify_email/invalid_token');
        }

        $user = User::create([
            'name' => $temporary_user->name,
            'email' => $temporary_user->email,
            'password' => $temporary_user->password,
            'email_verified_at' => time(),
        ]);

        Auth::login($user);
        return redirect('/user/' . $user->id);
    }
}
