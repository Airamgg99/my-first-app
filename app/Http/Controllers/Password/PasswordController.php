<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function show()
    {
        return view('auth.password.forgot-password');
    }

    public function reset(Request $request)
    {
        DB::beginTransaction();
        try {
            $random = Str::random(40);
            $user = User::where('email', $request['email'])->get()->first();

            if (!$user) {
                Alert::error('Invalid email.');
                return redirect()->route('login.index');
            }


            $user->token = $random;
            $user->save();

            Mail::to($user->email)->send(new ResetPasswordMail($user));

            DB::commit();
            Alert::toast('Email sent succesfully.', 'success');
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Reseting error.');
        }

        return redirect()->route('login.index');
    }

    public function send($token)
    {
        DB::beginTransaction();
        try {
            $user = User::where('token', $token)->get()->first();
            if (!$user) {
                DB::rollBack();
                Alert::error('The link has expired');
                return redirect()->route('login.index');
            }
            DB::commit();
            return view('auth.password.update-password', ['user' => $user]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Sending error.');
        }

        return redirect()->route('login.index');
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $random = Str::random(40);

            $user = User::find($id);
            $user->password = $request['password'];
            $user->token = $random;
            $user->save();

            DB::commit();
            Alert::toast('Password updated successfully.', 'success');
            return redirect()->route('login.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Updating error');
        }

        return redirect()->route('login.index');
    }
}
