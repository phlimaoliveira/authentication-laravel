<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\UtilsController;
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

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Método responsável por carregar a view do Forgot Password
     */
    public function forgotPassword($locale = 'pt-br') {
        App::setLocale($locale);
        
        if(Auth::check()) {
            // Usuário já está logado na aplicação, redireciona para o Dashboard
            return redirect()->route('dashboard');
        } else {
            return view('auth.forgot_password');
        }
    }

    /**
     * Método responsável por enviar email com as instruções para Redefinição de Senha
     * Ele cria um token na tabela password_resets vinculado ao email solicitado para redefinição de password
     * No email é passado um button com o token na URL para carregar no sistema e redefinir o password
     */
    public function forgot(Request $request) {        
        $utils = new UtilsController();

        // Verifica se usuário existe no database
        if($utils->checkUser($request->email) == false) {
            Session::flash('authError', __('auth.authError'));
            return Redirect::back();
        } else {
            $pswVerification = DB::table('password_resets')->where('email', '=', $request->email)->first();

            // Verifica se o usuário já fez alguma solicitação anterior
            if($pswVerification) {
                // Se ele fez alguma solicitação anteriormente, o sistema somente atualiza token na tabela password_resets
                DB::table('password_resets')->where('email', '=', $request->email)->update(['token' => Str::random(60)]);
            } else {
                // Se ele não fez, o sistema cria um novo token e armazena na tabela password_resets
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => Str::random(60),
                    'created_at' => Carbon::now()
                ]);
            }
            
            // Carrega os dados que ele criou na tabela
            $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

            // Passa o email e o token para o método sendReset Password, responsável por inserir os dados no template de email e enviar para o usuário
            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                Session::flash('passwordSent', __('auth.passwordSent'));
                return Redirect::back();
            } else {
                Session::flash('network_error', __('auth.network_error'));
                return Redirect::back();                
            }
        }
    }

    /**
     * Método responsável por enviar o email para o usuário com os dados para a redefinição de senha
     * Dados Referentes ao Email localizados na classe ForgotPasswordMail
     */
    public function sendResetEmail($email, $token) {
        // Carrega o nome de usuário do banco de dados
        $user = DB::table('users')->where('email', $email)->select('first_name')->first();
        // Gerando o link para resetar o password, consiste da rota com o token
        $link = 'http://authentication-project.test/' . 'passwords/reset/' . $token;
        Mail::to($email)->send(new ForgotPasswordMail($email, $link, $user->first_name));   
        return true;
    }

    /**
     * Método responsável por atualizar o password no banco de dados
     */
    public function resetPassword(Request $request) {
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
                // Encontrando o token da requisição no banco de dados       
                $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
                // Se não tem token data ou se ele é inválido, redireciona para a página de Esqueceu a Senha para solicitar novamente
                if (!$tokenData) return redirect()->route('forgot-password');

                $user = User::where('email', $tokenData->email)->first();
                
                if(!$user) {
                    Session::flash('authError', __('auth.authError'));
                    return Redirect::back();
                }
                // Criptografa e atualiza o password
                $user->password = Hash::make($request->password);
                $user->update();

                // Loga o usuário na aplicação depois de redefinir a Senha
                Auth::login($user);

                // Deleta o token da tabela password_resets
                DB::table('password_resets')->where('email', $user->email)->delete();
                return redirect()->route('dashboard');
            }  else {
                Session::flash('passwordNotCheck', __('auth.passwordNotCheck'));
                return Redirect::back();
            }
        }
    }

    /**
     * Método responsável por carregar o formulário para resetar o Password quando o usuário clica no botão
     * passado por email. Se não encontrar o token na tabela password_resets é porque ele expirou, então
     * o sistema redireciona o usuário para a página code_expired
     */
    public function showFormResetPassword($token) {        
        $user = DB::table('password_resets')->where('token', '=', $token)->first();
        if(!$user) return redirect()->route('code_expired');
        return view('auth.passwords.reset')->with(['token' => $token, 'email' => $user->email]);
    }
}
