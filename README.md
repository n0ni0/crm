**CRM**
====

  
[![Build Status](https://travis-ci.org/n0ni0/crm.svg?branch=dev)](https://travis-ci.org/n0ni0/crm) 
[![Coverage Status](https://coveralls.io/repos/github/n0ni0/crm/badge.svg?branch=dev)](https://coveralls.io/github/n0ni0/crm?branch=dev)

This applications is created with the PHP Framework Symfony 2.  
Crm for managing tasks, contacts, notes and planning in a calendar.  
This application has been created to practice with symfony 2 and has the basic functions, a good crm must have many more options.
I think it is not prepared to use it with real dates, only for testing.  

CRM use this bundles:
-----------------------

[FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) -- User management  
[KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) -- Paginate results  
[CalendarBundle](https://github.com/adesigns/calendar-bundle) -- Calenddar




**Installation**
------------

- Clone the repository from github

```
$ git clone git@github.com:n0ni0/crm.git <your-path-to-install>
$ cd <your-path-to-install>
```

- Use Composer to get the dependencies

```
$ composer install
```

-  Set up the Database and load example dates

```
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
$ php app/console doctrine:fixtures:load
```

- Run a built-in web server

```
$ php app/console server:run
```

- And type in your favourite browser:

```
http://127.0.0.1:8000
```

> **NOTE**
>
> To use built-in web server you need PHP 5.4 or higher
> http://http://symfony.com/doc/current/cookbook/web_server/built_in.html
>
> If you're using PHP 5.3, configure your web server to point at the web/ directory of the project.
> http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
>

**Users created in fixtures**  
   name: `username`  
   pass: `password`  

   name: `admin`  
   pass: `admin`  
