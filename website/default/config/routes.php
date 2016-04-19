<?php

use Cake\Routing\Router;

Router::plugin('Site', function ($routes) {
    $routes->fallbacks('DashedRoute');
});

/**
 *  Default 
 */
Router::scope('/', function ($routes) {
    $alias = explode('/', dirname(dirname(__FILE__)));
    $routes->connect('/' . end($alias) . '/*', ['plugin' => 'Site', 'controller' => 'Page', 'action' => 'display']);
});
