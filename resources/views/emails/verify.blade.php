<!--
|--------------------------------------------------------------------------
| Template para E-mail de Verificação de Conta
|--------------------------------------------------------------------------
|
| Esse é o template da mensagem de verificação de conta enviada pelo
| sistema de autenticação quando o usuário se registra no sistema.
| Edite este template conforme precisar... =D
|
-->

@component('mail::message')

<img src="{{ asset('img/laravel.png') }}">

Obrigado por se cadastrar no Sistema de Autenticação Laravel v1.0. Confirme que você não é um robo clicando no botão abaixo para verificar a sua conta.

@component('mail::button', ['url' => $url])
Verificar Conta
@endcomponent


Te vejo no Painel de Administração<br>
Att. Paulo<br>
<b>Sistema de Autenticação v1.0</b>

@endcomponent
