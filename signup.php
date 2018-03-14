<?php
require_once 'dbconfig.php';

if($voter->is_loggedin()!="")
{
    $voter->redirect('vote.php');
}

if(isset($_POST['btn-signup']))
{
    $uname = trim($_POST['txt_uname']);
    $upass = trim($_POST['txt_upass']);

    if($uname=="") {
        $error[] = "provide username !";
    }
    else if($upass=="") {
        $error[] = "provide password !";
    }
    else
    {
        try
        {
            $stmt = $DB_con->prepare("SELECT username FROM voters WHERE username=:uname");
            $stmt->execute(array(':uname'=>$uname));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['user_name']==$uname) {
                $error[] = "sorry username already taken !";
            }
            else
            {
                if($voter->register($uname,$upass))
                {
                    $voter->redirect('index.php');
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sign up : cleartuts</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    ?>
                    <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                    <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="index.php">Sign In</a></label>
        </form>
    </div>
</div>

</body>
</html>