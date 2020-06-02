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

            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);
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
        $link = 'http://authentication-project.test/' . 'password/reset/' . $token . '?email=' . urlencode($user->email);
        Mail::to($email)->send(new ForgotPasswordMail($email, $link, $user->first_name));        
    }

    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'retype_password' => 'required|confirmed',
            'token' => 'required']);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return view('index');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }

    }

}
