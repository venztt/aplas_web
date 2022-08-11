<?php

namespace App\Http\Controllers;

use App\AplasSummary;

class AdminController extends Controller
{
    public function index()
    {
        $entities = AplasSummary::all();

        $data = ['entities' => $entities];

        return view('admin/main')->with($data);
    }
}
