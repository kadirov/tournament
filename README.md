Tournament like FIFA World CUP
------------

This example project of using design patterns like "Dependency Injection", "Stage", "Memento", "Builder", "ORM", "MVC" e.t.c.
I have tried to adhered to the principles SOLID

Framework: Yii2

My code in "/src" folder.

Configuration
------------

### Database
~~~
/config/db.php
~~~
Default values
~~~
'dsn' => 'mysql:host=localhost;dbname=tournament',
'username' => 'dbuser',
'password' => 'dbpasswd',
~~~

INSTALLATION
------------

#### Install via Composer
~~~
composer install
./yii migrate
~~~

#### Run server
~~~
./yii serve
~~~

