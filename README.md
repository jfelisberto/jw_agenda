JEFWeb - AGENDA

Agenda de contatos em VueJS e Laravel 8.83.3 com API RES

Olá bem vindo ao sistema de Agenda

Vamos aos primeiros passos da configuração.

1 - Crie o Banco de dados <code>jw_agenda</code> no seu mysql<br />
    <code>CREATE SCHEMA `jw_agenda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;</code>
<br />
2 - Setando o acesso ao banco de dados:<br />
    No seu arquivo .env informe em:<br />
    "DB_USERNAME" o seu usuário do banco de dados<br />
    "DB_PASSWORD" a senha deste usuário no MySQLbr />
<br />
3 - No diretório da aplicação rode o comando:<br />
    <code>php artisan migrate</code><br />
    Para popular as tabelas no banco<br />
<br />
4 - Execute o comando:<br />
    <code>composer install</code><br />
    Para adcionar as bibliotas PHP<br />
<br />
5 - No arquivo:<br />
    <code>/resources/js/axios.js</code><br />
    Altere o valor da variável <code> axios.defaults.baseURL</code> para o seu dóminio ou deixe com o valor padrão <code>http://localhost:8000/</code> se for usar o <code>php artisan serve</code><br />
<br />
6 - Executar o comando:<br />
    <code>npm install</code><br />
    Para adcionar as bibliotecas JavaScript<br />
<br />
7 - Executar o comando:<br />
    <code>npm run dev</code><br />
    Para fazer o deploy dos componentes da aplicação<br />
<br />
8 - Se a aplicação não estiver em dominio na sua maquina execute o comando:<br />
    <code>php artisan serve</code><br />
    Para criar o ambiente virtual para acessar a aplicação atravez da url:<br />
    <a href="http://localhost:8000">http://localhost:8000/</a><br />
    Se chegou aqui pode pular o item 9<br />
<br />
9 - Depois é só acessar a aplicação através do seu navegador<br />
