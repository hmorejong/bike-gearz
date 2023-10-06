BIKE GEARZ
========================


Bike Gearz is a proof of concept implemented over Symfony Framework designed to simulate the inventory management of a Bike Workshop using an updated LAMP stack.
following the [Symfony's latest documentation][1].


Requirements
------------

* PHP 8.1.0 or higher;
* Composer installed or [Download Composer][6];
* MySQL server & PDO-MySQL PHP extension enabled;
* Node is required to compile symfony/webpack-encore [Installing Node.js and npm ][7];
* and the [usual Symfony application requirements][2];

Installation
------------

There are few different ways of installing this project, the bellow described option is one of the must common. Please feel free to use the following steps depending on your needs:

**Step 1.** Clone the code repository

```bash
$ git clone git@github.com:hmorejong/bike-gearz.git
```

**Step 2.** Locate the project folder and install composer dependencies on your computer

```bash
$ cd my_project/
$ composer install
```

**Step 3.** Installing npm dependencies to compile symfony frontend assets as specified in [Front-end Tools: Handling CSS & JavaScript][8]

```bash
$ npm install
$ npm run dev
```

**Step 4.** Create a new MySQL schema, and proceed to run the migrations to generate the DDL in the MySQL server 

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
```


Usage
-----

There's no need to configure anything before running the application. There are
2 different ways of running this application depending on your needs:

**Option 1.** [Download Symfony CLI][4] and run this command:

```bash
$ cd bike-gearz/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

**Option 2.** Use a web server like Nginx or Apache to run the application
(read the documentation about [configuring a web server for Symfony][3]).

On your local machine, you can run this command to use the built-in PHP web server:

```bash
$ cd bike-gearz/
$ php -S localhost:8000 -t public/
```

Open http://localhost:8000 in the browser of preference

[1]: https://symfony.com/doc/current/index.html
[2]: https://symfony.com/doc/current/setup.html#technical-requirements
[3]: https://symfony.com/doc/current/setup/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://symfony.com/book
[6]: https://getcomposer.org/
[7]: https://docs.npmjs.com/downloading-and-installing-node-js-and-npm
[8]: https://symfony.com/doc/current/frontend.html