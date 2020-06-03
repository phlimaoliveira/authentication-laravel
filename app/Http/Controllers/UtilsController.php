<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use Auth;
use App\User;

/**
 * Classe responsável por armazenar métodos genéricos que podem ser utilizados em comum pelos Controllers
 */
class UtilsController extends Controller
{
    /**
     * Método responsável por carregar dados da Página de Login
     */
    public function loadLoginPage($locale = 'pt-br') {
        App::setLocale($locale);

        if(Auth::check()) {
            // Usuário já está logado na aplicação
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Método responsável por carregar dados da página de verificação de email que aparece logo após um novo registro do usuário
     */
    public function emailVerificationSend() {
        return view('auth.email_notification');
    }

    /**
     * Método responsável por verificar se o usuário existe no banco de dados
     */
    public function checkUser($email) {
        $checkUser = User::where('email', '=', $email)->get();
        if($checkUser->isEmpty()) {
            return false;
        }
        return true;
    }
}
