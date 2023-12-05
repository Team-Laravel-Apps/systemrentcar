<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class LoginController extends Controller
{
    public function _construct()
   {
     $this->middleware ("guest");
   }

   public function index()
   {
     return view('auth.login');
   }

   public function posts(Request $request)
   {
        $cek = User::select('username')->where('username', '=', $request->username)->first();

        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'required' => 'kolom :attribute harus diisi.',
            'exists' => ':attriburte tidak cocok dengan data kami.',
        ]);

        $validator->after(function ($validator) use ($request){

            $user = User::where('username', $request->input('username'))->first();

            if (!$user || !password_verify($request->input('password'), $user->password)) {
                $validator->errors()->add('password', 'password salah');
              }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else {

        }

        if($cek && !auth()->attempt($request->only('username','password'), $request->remember))
        {
            Alert::warning('log in','Sepertinya password dan username salah');
            return back()->with('gagal','invalide login detailes');

        }
        elseif($cek)
        {
            Alert::success('Login','Anda berhasil login');
            return redirect()->route('dashboard');

        }
        else {
            Alert::error('log in','Sepertinya password dan username tidak tersedia');
            return back()->with('gagal','invalide login detailes');

        }
   }

}

