<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

/**
 * Configure 'SITE' variables from /config/site.php
 */
require __DIR__ . '/site.php';
foreach ($Site as $key => $value):
    Configure::write('Site.' . $key, $value);
endforeach;

/**
 * 
 */
define('imageBaseUrl', Configure::read('Site.imageBaseUrl'));
define('cssBaseUrl', Configure::read('Site.cssBaseUrl'));
define('jsBaseUrl', Configure::read('Site.jsBaseUrl'));

/**
 * Default uploadBaseUrl used in Content plugin
 */
define('uploadBaseUrl', Configure::read('Site.uploadBaseUrl'));
