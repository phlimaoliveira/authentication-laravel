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
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->sendEmailVerificationNotification();

            return redirect()->route('user.emailVerification');
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

    public function forgot(Request $request) {
        // Verifica se usuário existe no database
        if($this->checkUser($request->email) == false) {
            Session::flash('authError', __('auth.authError'));
            return Redirect::back();
        } else {
            // Implementa o método forgot
            $user = DB::table('users')->where('email', '=', $request->email)->first();            

            $pswVerification = DB::table('password_resets')->where('email', '=', $request->email)->first();

            if($pswVerification) {
                // Atualiza token           
                DB::table('password_resets')->where('email', '=', $request->email)->update(['token' => Str::random(60)]);
            } else {
                // Cria um novo token
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => Str::random(60),
                    'created_at' => Carbon::now()
                ]);
            }
            
            //Get the token just created above
            $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                Session::flash('passwordSent', __('auth.passwordSent'));
                return Redirect::back();
            } else {
                Session::flash('network_error', __('auth.network_error'));
                return Redirect::back();                
            }
        }
    }

    public function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('first_name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link        
        $link = 'http://authentication-project.test/' . 'passwords/reset/' . $token;
        Mail::to($email)->send(new ForgotPasswordMail($email, $link, $user->first_name));   
        return true;     
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
            'retype_password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            // Retorna Session indicando que os dados foram informados errados
            return 'Validator deu errado';
        } else {
            if(strlen($request->password) != strlen($request->retype_password)) {
                Session::flash('passwordNotCheck', __('auth.passwordNotCheck'));
                return Redirect::back();    
            } else if(strlen($request->password) < 8 || strlen($request->retype_password) < 8) {
                Session::flash('lengthErrorPassword', __('auth.lengthErrorPassword'));
                return Redirect::back(); 
            } else if(strcmp($request->password, $request->retype_password) === 0) {                
                // Validate the token        
                $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
                // Se não tem token data ou se ele é inválido, redireciona para a página de Esqueceu a Senha para solicitar novamente
                if (!$tokenData) return redirect()->route('forgot-password');

                $user = User::where('email', $tokenData->email)->first();
                // Redirect the user back if the email is invalid
                if(!$user) {
                    Session::flash('authError', __('auth.authError'));
                    return Redirect::back();
                }
                //Hash and update the new password
                $user->password = Hash::make($request->password);
                $user->update(); //or $user->save();

                //login the user immediately they change password successfully
                Auth::login($user);

                //Delete the token
                DB::table('password_resets')->where('email', $user->email)->delete();
                return redirect()->route('dashboard');
            }  else {
                Session::flash('passwordNotCheck', __('auth.passwordNotCheck'));
                return Redirect::back();
            }
        }
    }

    public function showFormResetPassword($token) {        
        $user = DB::table('password_resets')->where('token', '=', $token)->first();
        if(!$user) return redirect()->route('code_expired');
        return view('auth.passwords.reset')->with(['token' => $token, 'email' => $user->email]);
    }

}
