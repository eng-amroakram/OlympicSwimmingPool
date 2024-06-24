<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPagesController extends Controller
{
    public function logout()
    {
        $admin = Auth::user();

        if ($admin) {
            Auth::logout();
            return redirect()->route('admin.login');
        }

        return redirect()->route('index');
    }
}
