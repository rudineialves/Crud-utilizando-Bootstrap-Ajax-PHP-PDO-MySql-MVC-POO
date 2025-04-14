# 🧩 CRUD com Bootstrap, AJAX, PHP, PDO, MySQL, MVC e POO

![PHP](https://img.shields.io/badge/PHP-7%2B-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![License](https://img.shields.io/github/license/rudineialves/Crud-utilizando-Bootstrap-Ajax-PHP-PDO-MySql-MVC-POO)
![Last Commit](https://img.shields.io/github/last-commit/rudineialves/Crud-utilizando-Bootstrap-Ajax-PHP-PDO-MySql-MVC-POO)
![Repo Stars](https://img.shields.io/github/stars/rudineialves/Crud-utilizando-Bootstrap-Ajax-PHP-PDO-MySql-MVC-POO?style=social)


Um sistema completo de CRUD (Create, Read, Update, Delete) utilizando boas práticas com PHP orientado a objetos, estrutura MVC, Bootstrap para o front-end e AJAX para interações assíncronas sem recarregar a página.

---

## 🛠️ Tecnologias Utilizadas

- **PHP 7+**
- **MySQL** (banco de dados relacional)
- **PDO** (acesso seguro ao banco)
- **MVC** (Model View Controller)
- **POO** (Programação Orientada a Objetos)
- **Bootstrap 5** (interface responsiva)
- **jQuery + AJAX** (requisições dinâmicas)

---

## 📦 Funcionalidades

✅ Cadastro de registros  
✅ Listagem de dados em tabela  
✅ Edição inline com AJAX  
✅ Exclusão com confirmação  
✅ Mensagens de sucesso/erro dinâmicas  
✅ Validação básica no front e back-end

---

## 📸 Demonstração

http://nwdhostserver.com.br/rudinei/crud_php_users/

---

## 🚀 Como usar

1. Clone o projeto:
```bash
git clone https://github.com/rudineialves/Crud-utilizando-Bootstrap-Ajax-PHP-PDO-MySql-MVC-POO.git
```

2. Importe o banco de dados:

Vá até o arquivo users_table.sql e importe no seu MySQL.

3. Configure o banco:

No método connect do arquivo models/Users.class.php, ajuste suas credenciais:

```php
public function connect()
{ 
  $dbType     = "mysql";
  $dbHost     = "localhost";
  $port       = "3306";
  $dbUser     = "root";
  $dbPassword = "myypass123";
  $dbName     = "nome_do_db";

```

Suba no seu servidor local (ex: XAMPP, Laragon) e acesse a URL principal.

---

## 📂 Estrutura de Pastas

```pgsql
/Crud-MVC
├── controllers/
│   └── Users.php
├── css/
│   └── application.css
├── images/
│   └── close.png
│   └── edit.png
│   └── loader.gif
├── js/
│   └── bootstrap/
│   └── toastr/
│   └── jquery.min.js
│   └── plugins.config.js
├── models/
│   └── Users.class.php
├── views/
│   └── users/
│       └── popEditUsers.php
│   └── users.php
├── views_js/
│   └── users/
│       └── popEditUsers.js
│   └── users.js
├── LICENSE
├── README.md
├── index.php
└── users_table.sql
```
## 📄 Licença
MIT License

