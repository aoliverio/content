<?php
use Cake\Routing\Router;

/**
 * 
 */
Router::plugin('Content', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});

/**
 * Display Dashboard/index by default 
 */
Router::scope('/', function ($routes) {
    $routes->connect('/content', ['plugin' => 'Content', 'controller' => 'Dashboard', 'action' => 'index']);
    $routes->connect('/Content', ['plugin' => 'Content', 'controller' => 'Dashboard', 'action' => 'index']);
});