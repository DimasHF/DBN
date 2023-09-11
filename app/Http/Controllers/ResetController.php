<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ResetController extends Controller
{
    //
    public function resetmitra(){
        return view('Reset.mitra');
    }

    public function resetmitraproses(Request $request){

        $request->validate([
            'email' => 'required|email|exists:mitras,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::send("Email.resetmitra", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->back()->with('success', 'Link Reset Password Telah Dikirim Ke Email Anda');
    }

    public function resetmitraemail($token){

        return view('Reset.newmitra', ['token' => $token]);
    }

    public function resetmitraprosesemail(Request $request, $token){
        //dd($request->all());

        $request->validate([
            'password' => 'required',
            'repassword' => 'required|same:password',
        ]);

        $cek = DB::table('password_reset_tokens')->where('token', $token)->first();

        if(!$cek){
            return redirect()->back()->with('error', 'Token Tidak Valid');
        }

        DB::table('mitras')->where('email', $cek->email)->update([
            'password' => bcrypt($request->password),
        ]);


        DB::table('password_reset_tokens')->where('token', $token)->delete();

        return redirect()->route('mitra.login')->with('success', 'Password Berhasil Diubah');
    }
}
