## Blabber

O Blabber é uma micro rede-social construída em Laravel, onde as pessoas podem publicar, editar e apagar mensagens curtas (“blabs”) que são exibidas em um feed.

## Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades](#funcionalidades)
- [Stack](#stack)
- [Rotas](#rotas)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Instalação](#instalação)
- [Executando o Projeto](#executando-o-projeto)
- [Configurações](#configurações)
- [Autor](#autor)

## Sobre o Projeto

O **Blabber** é uma pequena micro rede-social de mensagens curtas, focado em mostrar os “blabs” mais recentes dos usuários.  
Os usuários podem se registrar e compartilhar textos de até 255 caracteres, enquanto visitantes conseguem visualizar o feed sem poder postar um "blab".

## Funcionalidades

- **Feed de blabs**
  - Listagem dos últimos blabs em ordem crescente.
  - Exibição do autor, avatar e timestamp do "blab".
  - Indicação visual quando um blab foi editado.

- **Autenticação de usuários**
  - Registro com nome, e‑mail e senha.
  - Login por e‑mail/senha com opção de “Remember Me”.

- **Criação e edição de blabs**
  - Usuários autenticados podem criar novos blabs com até 255 caracteres.
  - Validação de formulário com mensagens de erro amigáveis.
  - Edição de blabs próprios do usuário.
  - Exclusão de blabs próprios.

- **User Interface**
  - Layout responsivo baseado em Blade + Tailwind CSS.
  - Tema visual personalizado sobre DaisyUI (`laravelBlabber`) com ajustes de cores, botões, cards e toasts.
  - Toasts de feedback para ações de sucesso (criar, atualizar, apagar, login/logout, etc.).

## Stack

- **Backend**
  - **PHP** 8
  - **Laravel Framework** 12

- **Frontend**
  - **Vite 7**
  - **Blade**
  - **Tailwind CSS**
  - **DaisyUI**

- **Build**
  - **Node.js + npm**
  - **Composer** 

- **Infraestrutura**
  - **Banco de dados SQL**
  - **Sessões** e **filas**

## Rotas

Todas as rotas abaixo retornam apenas a view, sendo elas:

- **Feed e blabs**
  - **GET `/`**  
    Exibe a página inicial com o feed dos últimos blabs (`BlabController@index`).

  - **POST `/blabs`** (auth)
    Cria um novo blab associado ao usuário logado, com validação para o campo `message` (`BlabController@store`).

  - **GET `/blabs/{blab}/edit`** (auth + policy)
    Exibe o formulário de edição para um blab existente (apenas se o usuário atual for o autor) (`BlabController@edit`).

  - **PUT `/blabs/{blab}`** (auth + policy)
    Atualiza o texto de um blab existente, respeitando as mesmas regras de validação (`BlabController@update`).

  - **DELETE `/blabs/{blab}`** (auth + policy)
    Deleta um blab existente (apenas para o autor) (`BlabController@destroy`).

- **Autenticação**
  - **GET `/register`** (guest)
    Exibe o formulário de registro (`resources/views/auth/register.blade.php`).

  - **POST `/register`** (guest)
    Cria um novo usuário com `name`, `email` e `password`, faz login automático e redireciona para o feed (`Auth\Register`).

  - **GET `/login`** (guest)
    Exibe o formulário de login (`resources/views/auth/login.blade.php`).

  - **POST `/login`** (guest)
    Autentica o usuário usando as credenciais (`email`, `password`) com suporte a “Remember Me” (`Auth\Login`).

  - **POST `/logout`** (auth)
    Encerra a sessão atual, invalida e regenera o token CSRF, redirecionando de volta ao feed (`Auth\Logout` invocável).

## Estrutura do Projeto

- **`app/`**
  - **`Http/Controllers/BlabController.php`**.
  - **`Http/Controllers/Auth/Login.php`**.
  - **`Http/Controllers/Auth/Register.php`**.
  - **`Http/Controllers/Auth/Logout.php`**.
  - **`Models/User.php`**.
  - **`Models/Blab.php`**.
  - **`Policies/BlabPolicy.php`**.

- **`routes/`**
  - **`web.php`**.

- **`resources/views/`**
  - **`home.blade.php`**.
  - **`blabs/edit.blade.php`**.
  - **`auth/login.blade.php`** e **`auth/register.blade.php`**.
  - **`components/layout.blade.php`**.
  - **`components/blab.blade.php`**.

- **`resources/css/app.css`**

- **`resources/js/`**
  - **`app.js`**.
  - **`bootstrap.js`**.

- **`database/`**
  - **`migrations/2026_03_03_004200_create_blabs_table.php`** (migration da tabela `blabs` : `user_id`, `message`, timestamps).
  - **`seeders/BlabSeeder.php`** (cria usuários de exemplo e blabs de demonstração).

- **Build**
  - **`composer.json`**.
  - **`package.json`**.
  - **`vite.config.js`**.

## Instalação

Pré‑requisitos:

- **PHP** 8+
- **Composer**
- **Banco de dados** (ex.: MySQL) com um database criado (`blabber`)
- **Node.js + npm**

No diretório do projeto:

1. **Instalar packages do PHP**

   ```bash
   composer install
   ```

2. **Criar o arquivo `.env` a partir do exemplo**

   ```bash
   cp .env.example .env
   ```

3. **Gerar chave da aplicação**

   ```bash
   php artisan key:generate
   ```

4. **Configurar as variáveis de ambiente de banco de dados no `.env`**

   - `DB_CONNECTION`
   - `DB_HOST`
   - `DB_PORT`
   - `DB_DATABASE`
   - `DB_USERNAME`
   - `DB_PASSWORD`

5. **Rodar as migrations (e os seeders)**

   ```bash
   php artisan migrate
   # opcional: php artisan db:seed --class=BlabSeeder
   ```

6. **Instalar packages NPM**

   ```bash
   npm install
   ```

## Executando o Projeto

Para rodar o projeto, simplesmente use o comando:

  ```bash
  composer run dev
  ```

  Ele executa em paralelo:

  - `php artisan serve` (servidor Laravel)
  - `php artisan queue:listen --tries=1` (worker)
  - `npm run dev` (vite)

  Após rodar o comando, acesse a aplicação em `http://localhost:8000`.

## Configurações

As principais variáveis estão em `.env.example`, tais como:

- **Aplicação**
  - `APP_NAME`
  - `APP_ENV`
  - `APP_DEBUG`
  - `APP_URL`

- **Banco de dados**
  - `DB_CONNECTION` (ex.: `mysql`)
  - `DB_HOST`
  - `DB_PORT`
  - `DB_DATABASE` (por padrão use: `blabber`)
  - `DB_USERNAME`
  - `DB_PASSWORD`

- **Sessões, cache e filas**
  - `SESSION_DRIVER=database`
  - `QUEUE_CONNECTION=database`
  - `CACHE_STORE=database`

Para acessar a aplicação localmente, basta configurar as variáveis de **banco de dados** e rodar o projeto.

## Autor

**Guilherme Rocha (CoderRocha)**

- GitHub: [CoderRocha](https://github.com/coderrocha)
- LinkedIn: [Guilherme Rocha](https://www.linkedin.com/in/guilherme-rocha-da-silva)

---