<!--
|--------------------------------------------------------------------------
| Template para E-mail com Instruções para Redefinição de Senha
|--------------------------------------------------------------------------
|
| Esse é o template da mensagem de verificação de conta enviada pelo
| sistema de autenticação quando o usuário se registra no sistema.
| Edite este template conforme precisar... =D
|
-->

@component('mail::message')

<img src="{{ asset('img/laravel.png') }}">

Olá {{ $name }}

<p>
asdfasdfasdfa sadfa sdf asd fa sdf as dfasdf as dfa sdf as df asdf as df asdfasdf asdf asdfas dfasdfa sd
</p>

@component('mail::button', ['url' => $link])
Resetar Senha
@endcomponent


Até mais,<br>
Att. Paulo<br>
<b>Sistema de Autenticação v1.0</b>

@endcomponent
