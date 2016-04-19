<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$_SiteDescription = '';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags 
        <link rel="icon" href="<?= $this->Url->build('/site_hemmas/img/favicon.ico') ?>" />-->
        <title><?= $_SiteDescription ?></title>
        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Custom css -->
        <?= $this->Html->css($this->request->plugin . '.custom') ?>
        <?= $this->Html->css($this->request->plugin . '.custom-list') ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <!-- Header -->
            <div class="row header">
                <?= $this->element('header'); ?>             
            </div>    
            <!-- Main Menu -->
            <?= $this->element('main-menu'); ?> 
            <!-- Page -->
            <div class="row">
                <div class="col-md-3">
                    <?= $this->element('menu-istituto'); ?>
                    <?= $this->element('menu-plessi'); ?>
                    <?= $this->element('menu-attivita'); ?>
                </div>
                <div class="col-md-6" style="margin-left: 0px; margin-right: 0px;">
                    <!--Breadcrumbs -->
                    <?php if (isset($data->id)) : ?>
                        <?= $this->element('breadcrumbs', ['current' => $data->id]); ?>
                    <?php endif; ?>                  
                    <!-- Content -->
                    <?= $this->fetch('content'); ?>
                </div>
                <div class="col-md-3" style="padding: 0px;">
                    <?= $this->element('menu-sidebar'); ?>
                    <?= $this->element('menu-news'); ?>
                </div>
            </div>
            <!-- Footer -->
            <?= $this->element('footer'); ?>
        </div>
        <!-- Cookies Directive -->
        <?= $this->element('cookies-directive'); ?>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>