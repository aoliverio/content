<?php
$this->layout = NULL;
$_SiteDescription = 'Login';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= $_SiteDescription ?></title>
        <link rel="shortcut icon" href="<?= imageBaseUrl ?>icon.ico" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--Sign-in style -->
        <?= $this->Html->css(cssBaseUrl . 'sign-in.css'); ?>
    </head>
    <body>
        <div class="container">
            <form class="form-signin" method="POST" action="<?= $this->request->here ?>">
                <?= $this->Flash->render() ?>
                <h2 class="form-signin-heading">Please sign in</h2>
                <hr/>
                <label for="inputEmail" class="sr-only">Email address</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input type="email" name="username" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                </div>
                <br/>
                <label for="inputPassword" class="sr-only">Password</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>
                <br/>
                <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Sign in</button>
                <hr/>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
            </form>
        </div> 
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>