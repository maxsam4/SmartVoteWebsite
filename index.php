<?php

require_once 'dbconfig.php';

if($voter->is_loggedin()!="")
{
    $voter->redirect('vote.php');
}

if(isset($_POST['btn-login']))
{
    $uname = $_POST['txt_uname_email'];
    $upass = $_POST['txt_password'];

    if($voter->login($uname,$upass))
    {
        $voter->redirect('vote.php');
    }
    else
    {
        $error = "Wrong Details !";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>VoteCo Login </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h2>Sign in.</h2><hr />
            <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_uname_email" placeholder="Username" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
                <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                    <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                </button>
            </div>
            <br />
        </form>
    </div>
</div>

</body>
</html>
