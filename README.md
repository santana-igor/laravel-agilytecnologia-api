<p align="center">
  <img width="320" src="https://upload.wikimedia.org/wikipedia/commons/3/36/Logo.min.svg">
</p>

<p align="center">
  <a href="https://github.com/laravel/laravel">
    <img src="https://img.shields.io/badge/laravel-7.29.2-green.svg" alt="laravel">
  </a>
  <a href="https://packagist.org/packages/phpunit/phpunit">
    <img src="https://img.shields.io/badge/phpunit-8.5.8-blue.svg" alt="phpunit">
  </a>
</p>

# Introdução

Essa aplicação visa trabalhar no consumo e criação de **API rest** utilizando **Laravel Framework** aproveitando alguns recursos nativos, além de contar com aplicação de testes unitários (com **PHPUnit**) para garantir a resposta esperada.

Recursos trabalhados nessa aplicação:

- [Database: Migrations](https://laravel.com/docs/7.x/migrations)

- [Eloquent: Serialization](https://laravel.com/docs/7.x/eloquent-serialization#serializing-models-and-collections)

- [Artisan Console (Commands)](https://laravel.com/docs/7.x/artisan#writing-commands)

- [Artisan Test Runner](https://laravel.com/docs/7.x/testing#artisan-test-runner)

- [SQLite Database](https://laravel.com/docs/7.x/database#configuration)

- [Routing Laravel](https://laravel.com/docs/7.x/routing#route-parameters)

- [Controllers Laravel](https://laravel.com/docs/7.x/controllers#introduction)

- [Guzzle, PHP HTTP client](https://github.com/guzzle/guzzle)

# Descrição do problema
Empresa X, está interessada em calcular as informações pertencentes aos
usuários e seu trabalho de maneiras que não estão disponíveis diretamente no sistema de
log de trabalho.

Ela precisa que seja desenvolvido um Middleware em Laravel que se conectará com endpoints
REST descrevendo problemas, componentes, usuários e registros de tempo e apresentar
resumos JSON desses dados em um formato que faça sentido para que ser consumido posteriormente.

# Endpoints da API


Todos **Endpoints** fornecidos que estão sendo utilizados para semear o banco de dados local.

| Comando | Descrição | Endpoint |
| --- | --- | --- | 
| Issues | As tarefas que estão sendo feitas | [JSON](https://my-json-server.typicode.com/bomoko/algm_assessment/issues) |
| Components | São categorias / tags das tarefas | [JSON](https://my-json-server.typicode.com/bomoko/algm_assessment/components) |
| Timelogs | O número de segundos trabalhados em um problema por algum usuário | [JSON](https://my-json-server.typicode.com/bomoko/algm_assessment/timelogs) |
| Users | Os usuários que trabalham em tarefas, tempo de registro, etc | [JSON](https://my-json-server.typicode.com/bomoko/algm_assessment/users) |


# Primeira etapa - Semear banco de dados

- Passo 1:
  - Utilização do Database Migrations
  - Criação de tabelas para persistir os dados no banco SQLite

- Passo 2:
  - Desenvolvimento de classe e métodos para fazer as chamadas http. Utilização do GuzzleHttp Client
  - Popular as tabelas com os dados dos fornecidos pelos Endpoints
  - Utilização do Eloquent ORM para inserir os dados no banco

- Passo 3:
  - Criação de um Artisan Command para semear o banco com os dados obtidos nos Endpoints


# Segunda etapa - Criação dos Endpoints da API

  - Em Routes Web foi criado um Endpoint chamado /user-timelogs que retornará um JSON de usuários e quantos segundos eles trabalharam.

  - Em Routes Web foi criado um Endpoint chamado /component-metadata que retornará um JSON da quantidade de tarefas com a soma de todo tempo gasto agrupado por Component (categoria).


# Estrutura de arquivos da aplicação
O diretório `Services/Agily/` armazena toda regra da aplicação. Dentro de `Endpoints` estão os métodos para comunicação com a API. O Arquivo `Client.php` faz uso do `GuzzleHttp Client` e armazena a URL Base para servir as URI dos Endpoints individuais. Dentro do diretório `Reports` está a classe responsável por gerar os 2 relatório da aplicação. O arquivo `UserWorkLog.php` faz utilização do Eloquent Query Builder para obter os dados desejados.

Dentro do diretório `database` foi criado o arquivo `database.sqlite` que é utilizado na aplicação

No diretório `tests/Unit` está o arquivo `APITest.php` que é utilizado para testar os 2 Endpoints da API desenvolvida na aplicação.
```
app/Services/
        ├──── Agily/
        │        ├── Client.php
        │        └── Endpoints/
        │            ├── Components.php
        │            ├── Endpoint.php
        │            ├── Issues.php
        │            ├── Timelogs.php
        │            └── Users.php
        └──── Reports/
              └── UserWorkLog.php


database/
    └──── database.sqlite
    


tests/
    └──── Unit/
          └──── APITest.php
                

```


# Instruções de instalação

```bash
# Clone o projeto
git clone https://github.com/santana-igor/laravel-agilytecnologia-api.git

# Entre no diretório do projeto
cd laravel-agilytecnologia-api

# Instale as dependências
composer install
```


# Configurações necessárias
Ajuste o seu arquivo `.env` conforme mostrado abaixo.
Obs.: Lembre-se que estamos utilizando `sqlite`, logo é necessário possuir um arquivo chamado `database.sqlite` dentro do diretório `database/`.

```bash
# Crie o arquivo dentro do diretório database/
database/database.sqlite

# Ajuste o .env para receber o banco sqlite e a APP_URL que sua aplicação irá rodar. 
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=
DB_PASSWORD=
```

# Executando aplicação
Após seguir todos os passos anteriores, iremos rodar as `migrations` e executar o comando que irá semear o banco de dados com o JSON fornecido anteriormente.

```bash
# Gere a chave da aplicação
php artisan key:generate

# Execute as migrations
php artisan migrate

# Execute o comando que irá popular as tabelas
php artisan db:seedDatabase

# Inicie a aplicação
php artisan serve
```


# Testar com PHPUnit
Os testes já encontram-se no diretório `tests/Unit/`. Para executá-los, basta seguir as instruções:

```bash
# Inicie limpando o cache
php artisan config:cache

# Executar o test com Artisan
php artisan test

# Executar o test chamando diretamente phpunit. Obs.: Partindo da raiz da aplicação
$ vendor/phpunit/phpunit/phpunit
```

# Endpoints da aplicação
Lista dos Endpoints construídos na aplicação. 

Todas respostas estão em formado JSON.
```bash
# Retorna quantidade de usuários e o tempo de trabalho
/user-timelogs

# Retorna quantidade de tarefas e o tempo gasto agrupado por categoria
/component-metadata
```

# Autor

[LinkedIn](https://www.linkedin.com/in/igr-santana/) - Igor Santana Amaral

Copyright (c) 2020
