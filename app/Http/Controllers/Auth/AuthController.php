<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        DB::beginTransaction();
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                DB::commit();
                return redirect()->route('index');
            } else {
                DB::rollBack();
                Alert::error('Incorrect credentials.');
                return redirect()->route('login.index');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Authentication error.');
        }

        return redirect()->route('login.index');
    }

    public function register()
    {
        return view('register.register');
    }

    public function registerTry(Request $request)
    {
        DB::beginTransaction();
        try {
            if (User::where('email', $request['email'])->exists()) {
                DB::rollBack();
                Alert::error('The account already exists.');
                return redirect()->route('login.index');
            }

            $random = Str::random(40);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
                'token' => $random,
                'status_id' => 5,
                'role_id' => 2,
            ]);

            Mail::to($user->email)->send(new VerifyMail($user));

            DB::commit();
            Alert::toast('User registered successfully.', 'success');
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Registration error.');
        }

        return redirect()->route('register');
    }

    public function verifyMail()
    {
        return view('auth.mail.verify-mail');
    }

    public function verified($token)
    {
        DB::beginTransaction();
        try {
            if (!User::where('token', $token)->where('status_id', 5)->exists()) {
                DB::rollBack();
                Alert::error('Invalid token');
                return redirect()->route('login.index');
            }

            $random = Str::random(40);

            $user = User::where('token', $token)->get()->first();
            $user->token = $random;
            $user->status_id = 1;
            $user->save();

            DB::commit();
            Alert::toast('Email verified successfully.', 'success');
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Validating error.');
        }

        return redirect()->route('login.index');
    }

    public function resendVerification(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->user()->sendEmailVerificationNotification();

            DB::commit();
            Alert::toast('Verification link sent successfully.', 'success');
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Verification error.');
            return redirect()->route('login.index');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
