<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App;
use Auth;
use Session;
use App\User;

class AuthController extends Controller
{

    // Localização Default: Português do Brasil (pt-br)
    // Mostra página para inserção de um Novo Usuário
    public function create($locale = 'pt-br') {             
        App::setLocale($locale);

        if(Auth::check()) {
            // Usuário já está logado na aplicação
            return redirect()->route('dashboard');
        } else {
            return view('auth.register');
        }        
    }

    public function store(Request $request) {  
        if(strlen($request->password) < 8 || strlen($request->retype_password) < 8) {              
            Session::flash('lengthErrorPassword', __('auth.lengthErrorPassword'));
            return Redirect::back();                      
        } else if($this->checkUser($request->email) == true) {
            Session::flash('userExist', __('auth.userExist'));
            return Redirect::back();                      
        } else if(strcmp($request->password, $request->retype_password) === 0) {
            // Senhas são iguais
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            
            $user->save();

            // Retorna para a View de Confirmação do Email
            return 'Usuário Cadastrado! Por favor confirme o Email';
        } else {
            Session::flash('passwordNotCheck', __('auth.passwordNotCheck'));
            return Redirect::back();            
        }
    }

    public function authenticate(Request $request)
    {        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        } else {
            Session::flash('authError', __('auth.authError'));
            return Redirect::back();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgotPassword($locale = 'pt-br') {
        App::setLocale($locale);
        
        if(Auth::check()) {
            // Usuário já está logado na aplicação
            return redirect()->route('dashboard');
        } else {
            return view('auth.forgot_password');
        }
    }

    public function checkUser($email) {
        $checkUser = User::where('email', '=', $email)->get();
        if($checkUser->isEmpty()) {
            return false;
        }
        return true;
    }

}
