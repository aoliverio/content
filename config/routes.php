<?php
use Cake\Routing\Router;

/**
 * 
 */
Router::plugin('Content', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});

/**
 * 
 */
Router::scope('/', function ($routes) {
    $routes->connect('/content', ['plugin' => 'Content', 'controller' => 'Content', 'action' => 'index']);
    $routes->connect('/Content', ['plugin' => 'Content', 'controller' => 'Content', 'action' => 'index']);
});