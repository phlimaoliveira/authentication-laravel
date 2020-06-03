<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilsController;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App;
use Auth;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Método responsável por carregar o formulário para um novo Registro do Usuário     
     */
    public function create($locale = 'pt-br') {             
        App::setLocale($locale);

        if(Auth::check()) {
            // Se usuário estiver logado envia ele para o dashboard
            return redirect()->route('dashboard');
        } else {
            return view('auth.register');
        }        
    }

    /**
     * Método responsável por armazenar o registro de um novo usuário no Banco de Dados     
     */
    public function store(Request $request) {  
        $utils = new UtilsController();

        if(strlen($request->password) < 8 || strlen($request->retype_password) < 8) {              
            Session::flash('lengthErrorPassword', __('auth.lengthErrorPassword'));
            return Redirect::back();                      
        } else if($utils->checkUser($request->email) == true) {
            Session::flash('userExist', __('auth.userExist'));
            return Redirect::back();                      
        } else if(strcmp($request->password, $request->retype_password) === 0) {
            // Senhas são iguais
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Envia Email para Confirmação de Conta pelo Usuário
            $user->sendEmailVerificationNotification();

            return redirect()->route('user.emailVerification');
        } else {
            Session::flash('passwordNotCheck', __('auth.passwordNotCheck'));
            return Redirect::back();            
        }
    }
}
