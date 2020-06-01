<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use Auth;

class UtilsController extends Controller
{
    public function loadLoginPage($locale = 'pt-br') {
        App::setLocale($locale);

        if(Auth::check()) {
            // Usuário já está logado na aplicação
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }
}
