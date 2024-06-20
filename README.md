# Projeto de Teste para a empresa SoftDesign

Funcionalidades:

Tela de Login
• A tela inicial deve ser a de login;
• Não deve ser possível acessar outras telas sem realizar o login;

CRUD de Livros
• Listagem de livros com paginação e filtragem;
• Adição e Edição de Livros;
o Dados do Livro
	Título;
	Descrição;
	Autor;
	Número de Páginas;
	Data de Cadastro;
• Exclusão de um livro.

Clima da região
• Integração com API externa para exibir o clima de uma determinada região;
• Mostrar apenas o Clima atual.
o API https://hgbrasil.com/status/weather. Consultar documentação https://console.hgbrasil.com/documentation/weather.

## Back-End em Yii2

Criar um database no seu banco com o nome yii2angular17

localizado na pasta `/back`

Antes de iniciar o Yii2, primeiro precisa rodar o composer e o migrate

    composer install
	php yii migrate

e após isso para rodar o servidor basta executar o código:

    php yii serve --port=4300

ele irá rodar no http://localhost:4300/api

## Front-End em Angular 17

Antes de iniciar, ter o Node 20 instalado, e o Angular Cli 17

localizado na pasta `/front`

Antes de iniciar o Angular17 precisa rodar a instalação de dependências

    npm install

e depois rodar o servidor do Angular17

    ng serve

ele irá rodar no http://localhost:4200

para logar no sistema basta usar as credenciais:

- **username:** admin
- **password:** admin

