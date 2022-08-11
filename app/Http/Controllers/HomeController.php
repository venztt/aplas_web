<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->roleid == 'student') {
            $check = User::find(Auth::user()->id);
            return view('/student/main')->with(['status' => $check->status]);
        } else if (Auth::user()->roleid == 'admin') {
            return view('/admin/admin');
        } else {
            return view('/teacher/home');
        }
    }
}
