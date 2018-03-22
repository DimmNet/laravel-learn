<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show($path = 'Dmitriy')
    {
        return view('welcome', compact('path'));
    }
}
