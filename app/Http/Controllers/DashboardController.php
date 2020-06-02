<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index($locale = 'pt-br') {
        App::setLocale($locale);
        
        return view('panel.dashboard');
    }
}
