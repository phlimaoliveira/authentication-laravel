<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App;
use Auth;
use Session;
use DB;
use App\User;

class AuthController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Método para autenticação dos usuários na plataforma
     */
    public function authenticate(Request $request)
    {        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Tudo ok, redireciona para o dashboard
            return redirect()->intended('dashboard');
        } else {
            Session::flash('authError', __('auth.authError'));
            return Redirect::back();
        }
    }

    /**
     * Método para desautenticar o usuário na plataforma (Logout)
     */
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    

}
