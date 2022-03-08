## Sobre - Agenda de Contatos
Agenda de contatos API RES<br />
Esse programa foi criado para você cadastrar seus contatos<br /><br />
Ele conta com:<br />
- Busca por CEP para localizar endereços<br />
- Busca por CNPJ para buscar o nome da empresa e preenchero o Endereço comercial<br />
<br />
Para uma fácil utilização e testes dos recursos deste software, não foi implementado uma camada de autenticação de acesso e nem nas requisições a API<br />

## Contribuição
Obrigado por considerar contribuir com a Agenda de Contatos

## Tecnologias
Esse sistema foi criado utilizando as seguintes tecnologias:<br />
<a href="https://laravel.com/">Laravel v8</a><br />
<a href="https://vuejs.org/">VueJS v2.6.14</a><br />
<a href="https://getbootstrap.com/">Bootstrap v5.13</a><br />
<a href="https://fontawesome.com/">Fonteawesome v5.15.4</a><br />
<a href="https://sweetalert2.github.io/">Sweet Alert 2 v10.x</a><br />
<a href="https://datatables.net/">Data Tables v5.1.11</a><br />
<br />
Para utilização do sistema tenha em seu servidor os seguintes pacotes<br />
- Apache<br />
- PHP 7.4<br />
- MySQL ou MariaDB<br />
- Composer<br />
- Node<br />

## Utilização
Vamos aos primeiros passos da configuração.

1 - Crie o Banco de dados <code>jw_agenda</code> no seu mysql<br />
    <code>CREATE SCHEMA `jw_agenda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;</code><br />
<br />
2 - Setando o acesso ao banco de dados:<br />
    Renomeie o arquivo <code>.env.example</code> para <code>.env</code><br />
    No seu arquivo .env informe em:<br />
    "DB_USERNAME" o seu usuário do banco de dados<br />
    "DB_PASSWORD" a senha deste usuário no MySQL<br />
<br />
3 - Execute o comando:<br />
    <code>composer install</code><br />
    Para adcionar as bibliotas PHP<br />
<br />
4 - Executar o comando:<br />
    <code>npm install</code><br />
    Para adcionar as bibliotecas JavaScript<br />
<br />
5 - Executar o comando:<br />
    <code>npm run dev</code><br />
    Para fazer o deploy dos componentes da aplicação<br />
<br />
6 - No diretório da aplicação rode o comando:<br />
    <code>php artisan migrate</code><br />
    Para popular as tabelas no banco<br />
<br />
7 - No arquivo:<br />
    <code>/resources/js/axios.js</code><br />
    Altere o valor da variável <code> axios.defaults.baseURL</code> para o seu dóminio ou deixe com o valor padrão <code>http://localhost:8000/</code> se for usar o <code>php artisan serve</code><br />
<br />
8 - Se a aplicação não estiver em dominio na sua maquina execute o comando:<br />
    <code>php artisan serve</code><br />
    Para criar o ambiente virtual para acessar a aplicação atravez da url: <a href="http://localhost:8000">http://localhost:8000/</a><br />
<br />
9 - Depois é só acessar a aplicação através do seu navegador<br />

## Segurança e vulnerabilidades
Se você descobrir uma vulnerabilidade de segurança na Agenda de Contatos, envie um e-mail para<br />
Juliano Felisberto [julianoeloi1@gmail.com](mailto:julianoeloi1@gmail.com).<br />

## Licença
Este software é de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
