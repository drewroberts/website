<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AMPController extends Controller
{

    /**
     * Index Page
     * @return void
     */
    public function index() {
        return view('amp.index');
    }
}
