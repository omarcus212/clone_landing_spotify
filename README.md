# Projeto Spotify Clone

Este é um aplicativo web inspirado no Spotify, construído com Laravel (framework PHP), com autenticação de usuário, verificação de e-mail, redefinição de senha e login social com Google. Foi projetado para fins educacionais, com uma estrutura sólida para fácil manutenção, depuração e escalabilidade. O backend usa MySQL, o frontend é impulsionado por Vite e Tailwind CSS, e o deployment é no Railway com serviços de e-mail via Resend. Supabase é integrado para funcionalidades adicionais de banco de dados/autenticação (ex: real-time ou storage, configurável).

## Funcionalidades

Registro e Login de Usuário: 1FA padrão (usuário/senha) com confirmação de e-mail via OTP (One-Time Password) enviado por e-mail.
Autenticação com Google: Login/registro perfeito usando Google OAuth (define o usuário como ativo imediatamente, ignorando a confirmação de e-mail, pois o Google cuida da segurança).
Confirmação de E-mail: Após registro (não Google), o usuário recebe OTP via e-mail; a conta é ativada após verificação.
Redefinição de Senha: Fluxo seguro com link/token por e-mail; sem campo de e-mail necessário no formulário de reset (puxado da URL/sessão).
Frontend: Vite para bundling, Tailwind CSS para estilização – responsivo para mobile, tablet e desktop (incluindo 1366x768).
Banco de Dados: MySQL para dados principais; Supabase para funcionalidades suplementares (ex: atualizações em tempo real ou armazenamento de arquivos – configurável).
Serviço de E-mail: Resend para envio de e-mails (confirmação, resets) – confiável e com camada gratuita disponível.
Deployment: Railway para hospedagem (escalabilidade fácil, gerenciamento de variáveis de ambiente).
Configuração de Desenvolvimento: Docker para ambiente local, mas início rápido com composer run dev.
Segurança: Senhas hash, proteção CSRF, gerenciamento de sessão; pronto para 2FA (extensível).
Estrutura: Código limpo e modular para fácil correção de bugs – controllers, services, views separados.

## 🚄 Railway (Limitações do Plano Free)

Este projeto utiliza envio de e-mails para algumas funcionalidades, como:

- Redefinição de senha
- Verificação de conta (OTP / confirmação por e-mail)
- Login social (Google) com possíveis notificações por e-mail

⚠️ **Importante:**  
No plano gratuito do Railway, o envio de e-mails via SMTP/HTTPS pode não funcionar corretamente devido a limitações de infraestrutura e certificados SSL.  
Por esse motivo, algumas funcionalidades foram **desativadas ou removidas** no ambiente do Railway:

- ❌ Redefinição de senha por e-mail
- ❌ Confirmação de conta por e-mail (OTP)
- ❌ Qualquer fluxo que dependa diretamente de envio de e-mail

### 🔒 Comportamento do sistema no Railway

Quando o envio de e-mail está desativado ou ocorre algum erro:

- O sistema **não exibe erros técnicos** para o usuário
- O usuário é redirecionado para a tela de login
- Uma mensagem amigável é exibida informando que o serviço de e-mail está indisponível no momento

Essas funcionalidades funcionam normalmente em ambiente local quando o serviço de e-mail está configurado corretamente.

## Requisitos

PHP 8.1+ (testado em 8.3)
Composer 2+
Node.js 18+ & npm para Vite/Tailwind
MySQL 8+ (ou compatível como MariaDB)
Docker (opcional para dev local)
Contas: Google Developer Console (para OAuth), Resend (para e-mails), Supabase (para DB/auth), Railway (para deploy)

## 🚀 Como rodar o projeto

### 1. Clone o repositório

```bash

git clone https://github.com/omarcus212/clone_landing_spotify
cd clone_landing_spotify

```

## Configure as variáveis de ambiente e arquivos de configuração

- Antes de subir o ambiente, você precisará configurar as variáveis de ambiente:

* Adicione as seguintes linhas ao arquivo .env:

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1 ou backend-mysql(Docker)
- DB_PORT=3306
- DB_DATABASE=seu banco de dados ou (pj_spotify_laravel)
- DB_USERNAME=root
- DB_PASSWORD=

* Utilize o arquivo .env.example como base, ele já possui as variáveis definidas para facilitar o - processo.

* Atualize também os arquivos docker-compose.yml e phinx.yml com as informações do seu banco de dados, utilizando as variáveis que você definiu no .env.

* ⚠️ Importante: Verifique se todas as variáveis de ambiente estão corretas antes de seguir para o próximo passo.

## Suba o projeto local

1. Entre na pasta do backend:

```bash
cd api
```

2. Instale as dependências PHP:

```bash
composer install
```

3. Gere a key do Laravel:

```bash
php artisan key:generate
```

4. Rode as migrations:

```bash
php artisan migrate
```

5. Rode os seeders:

```bash
php artisan db:seed
```

6. Inicie o servidor:

```bash
composer run dev
```

```bash
O backend estará rodando em http://127.0.0.1:8000/login
```

## Google OAuth

GOOGLE_CLIENT_ID=seu_google_client_id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=seu_google_secret
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback

## Resend E-mail

MAIL_MAILER=resend
RESEND_API_KEY=re_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
MAIL_FROM_ADDRESS=no-reply@seu_dominio.com

## Uso

Registro Normal: Preencha o form → receba OTP no e-mail → verifique → conta ativa → login.
Login com Google: Clique no botão → autentique no Google → conta ativa automática (sem OTP).
Reset de Senha: No perfil (logado) → clique "Redefinir" → receba link no e-mail → nova senha (sem campo de e-mail visível no form).
Debug/Correção de Bugs: Estrutura sólida: Controllers em /app/Http/Controllers/Auth/, Views em /resources/views/auth/, Models em /app/Models/. Use dd() ou logs para debug. Rotas em /routes/web.php com nomes claros.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

https://resend.com/
https://railway.com/
https://supabase.com/

sincere-determination-production.up.railway.app/
