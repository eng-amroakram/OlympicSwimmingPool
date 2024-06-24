<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = auth()->user();

        if ($user) {
            if ($user->type == 'superadmin') {
                return redirect()->route('admin.index');
            }

            if ($user->type == 'admin') {
                return redirect()->route('admin.index');
            }
        }


        return redirect()->route('web.landing-page');
    }
}
