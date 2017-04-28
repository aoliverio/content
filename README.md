# Content plugin for CakePHP 3.x

This is a Content Management System plugin for CakePHP 3.x applications.


## Installing Content via Composer

You can install Content into your project using [Composer](http://getcomposer.org). If you're starting a new project, we recommend using the [content-app](https://github.com/aoliverio/content-app) skeleton as a starting point. For existing applications you can run the following:

``` bash
$ composer require aoliverio/content
```

Load plugin in your application:
```
bin/cake plugin load -r Content
```

Set routes in /config/routes.php
```
    $routes->connect('/', ['plugin' => 'Content', 'controller' => 'Frontend']);
    $routes->connect('/page/*', ['plugin' => 'Content', 'controller' => 'Frontend', 'action' => 'page']);
    $routes->connect('/news/*', ['plugin' => 'Content', 'controller' => 'Frontend', 'action' => 'news']);
    $routes->connect('/category/*', ['plugin' => 'Content', 'controller' => 'Frontend', 'action' => 'category']);
    $routes->connect('/search/*', ['plugin' => 'Content', 'controller' => 'Frontend', 'action' => 'search']);
```

## Docs

For more informations about installation and configuration options, see the [wiki](https://github.com/aoliverio/content/wiki).

## Bugs & Feedback

[https://github.com/aoliverio/content/issues](https://github.com/aoliverio/content/issues).

## License

Copyright (c) 2015 Antonio Oliverio and licensed under [MIT License](http://opensource.org/licenses/mit-license.php).
