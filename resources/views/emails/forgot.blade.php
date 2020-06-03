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

Olá {{ $name }},

<p>
Nós entendemos que esse tipo de coisa acontece, então você pode redefinir a sua senha clicando no botão abaixo.
</p>

@component('mail::button', ['url' => $link])
Redefinir Senha
@endcomponent


Até mais,<br>
Att. Paulo<br>
<b>Sistema de Autenticação v1.0</b>

@endcomponent
