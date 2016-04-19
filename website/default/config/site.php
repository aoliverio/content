<?php

/**
 * Site plugin file configuration
 * 
 * The following $Site array configuration is processed by Site/config/bootstrap.php, 
 * each element is processed and turned into Configure::write('Site.KEY', VALUE)
 * to be called up at any plugin file through Configure::read('Site.KEY').
 * 
 * Those constants are difined in App/config/bootstrap before load the Site plugin
 * WEBSITE_BASE_URL, It is the base URL of the directory that contains all of the Site plugins
 * SITE_BASE_URL, It is the base url of the Site plugin in use
 */
$Site = [
    'imageBaseUrl' => SITE_BASE_URL . '/webroot/img/',
    'cssBaseUrl' => SITE_BASE_URL . '/webroot/css/',
    'jsBaseUrl' => SITE_BASE_URL . '/webroot/js/',
    'uploadBaseUrl' => APP_BASE_URL . '/uploads',
    'pagePath' => SITE_FULLPATH . '/src/Template/Page/',
    'homeDefaultTemplate' => 'default',
    'pageDefaultTemplate' => 'page_2cl',
];
