<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sobre o projeto

Este é um Projeto Básico de implementação dos métodos de Autenticação e Verificação de Identidade junto com o Laravel na sua versão "6.x". Você está livre para baixar e modificar esses métodos conforme a sua necessidade e eu espero que isso reflita positivamente na sua produtividade para codificar seus projetos sejam eles para estudos ou profissionais, os recursos, plataformas e funcionalidades que foram implementadas são:

### Recursos

- [Laravel 6](https://laravel.com/docs/6.x).
- [Mailtrap.io](https://mailtrap.io/).
- [SB-Admin-2 Free Bootstrap Template](https://startbootstrap.com/themes/sb-admin-2/).

### Funcionalidades

**- Página de Login:** Usuário pode se autenticar na plataforma e tem as opções de criar um Novo Cadastro caso não possua conta no sistema ainda ou solicitar e-mail para recuperação de senha que o aplicativo irá encaminhar um e-mail com as instruções de recuperação para o usuário caso ele possua cadastro. Tratamentos de exceções já foram implementados como: Usuário não tem registro no sistema / Dados Inválidos (Usuário não encontrado com E-mail ou Senha informados)

<img src="https://raw.githubusercontent.com/phlimaoliveira/authentication-laravel/master/public/img/prints/login_page.png" alt="Login Page">

**- Nova Conta:** Usuário pode se registrar no sistema gratuitamente criando uma Nova Conta, você pode ficar livre para desabilitar essa página de cadastro, incluir novas informações e utilizá-la conforme a sua necessidade. Não se esqueça de executar o comando php artisan migrate e configurar as variáveis do banco de dados de sua preferência no arquivo .env. Logo após efetuado o cadastro o sistema envia um email para confirmação de identidade, sendo que enquanto o usuário não confirmar o e-mail não é possível ele acessar as funções do Dashboard, simulando uma "proteção contra robôs".

<img src="https://raw.githubusercontent.com/phlimaoliveira/authentication-laravel/master/public/img/prints/register_page.png" alt="Register Page">

**- Esqueceu a Senha:** Usuário pode solicitar ao sistema instruções para redefinição de senha. Basta ele informar o e-mail cadastrado que o sistema redirecionara uma mensagem com o botão e um token criado para redefinição de senha. A cada solicitação o sistema deleta e cria um novo token, desta forma somente a última solicitação feita pelo usuário terá validade, caso o token seja inválido o sistema redireciona para uma página mostrando que a solicitação daquele usuário expirou.

<img src="https://raw.githubusercontent.com/phlimaoliveira/authentication-laravel/master/public/img/prints/forgot_password_page.png" alt="Forgot Password Page">

**- Dashboard:** O Dashboard é padrão, sem funcionalidades, todo em branco pronto para você trabalhar nas suas funcionalidades, estilizar e customizar as suas funções. Neste projeto foi utilizado o template SB-Admin-2 Free Bootstrap mas você pode ficar livre para alterar para outro de sua preferência.

<img src="https://raw.githubusercontent.com/phlimaoliveira/authentication-laravel/master/public/img/prints/dashboard_page.png" alt="Dashboard Page">

**- Pronto para tradução de textos estáticos:** Este projeto foi utilizado o recurso multi-language nativo do Laravel ([você pode conferir mais clicando neste link](https://laravel.com/docs/6.x/localization#configuring-the-locale)), onde foram utilizadas as linguagens English (en) e Português do Brasil (pt-br).

## Configurando o projeto

Para utilizar esse projeto basta ter o Framework Laravel versão "6.x" configurada na sua máquina, fazer o clone deste projeto e configurar o arquivo .env, informando os dados do seu banco de dados, esteja ele hospedado em algum servidor ou não e os dados do seu servidor de email, neste projeto foi utilizado o Banco de Dados MySQL e o servidor Mailtrap.io.

...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
...
...
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
...

Depois disso basta executar o projeto utilizando o comando php artisan serve ou você também pode utilizar qualquer ferramenta de sua preferência. Para este projeto foi utilizado o [Laragon] e eu recomendo bastante a utilização desta ferramenta, ela contribuiu bastante para a produtividade do projeto, configurando o namespace da aplicação, geração de URL do projeto e tem um terminal bacana para desenvolver e visualizar os comandos da aplicação.

## Próximos Passos...

Os próximos passos para esse projeto é configurar e implementar a autenticação com servidores externos como o Google e Facebook por exemplo.

## Contribua

Você também quer fazer parte disso? Fez alguma melhoria no código? Me envie uma mensagem que poderemos atualizar essa versão existente no repositório com as suas contribuições.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
