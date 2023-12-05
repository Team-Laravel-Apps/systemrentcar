<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LogoutController extends Controller
{
    public function posts(Request $request)
    {
        auth()->logout();
        Alert::success('Logout', 'Anda berhasil logout dari sistem');
        return redirect()->route('login');
    }
}
