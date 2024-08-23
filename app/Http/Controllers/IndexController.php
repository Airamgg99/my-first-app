<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role_id;
        switch ($role) {
            case 1:
                return view('pages.admin');
                break;

            case 2:
                return view('pages.user');
        }
    }
}
