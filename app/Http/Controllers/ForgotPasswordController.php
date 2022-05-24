<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('login.password.email', [
            'title' => 'Reset Password'
        ]);
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('login.password.verify', ['token' => $token], function ($message) use ($request) {
            $message->from('admin@example.com');
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()
            ->with([
                'success' => true,
                'message' => 'Kami telah mengirimkan email tautan reset password Anda!'
            ]);
    }
}
