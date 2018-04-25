<?php
include_once 'dbconfig.php';
if(!$voter->is_loggedin())
{
    $voter->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM voters WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['congress']))
{
    $ex = shell_exec('./simplewallet --voter ' + $userRow['username'] + ' --password abc --party VwNZz3XdQwc6W84a66Pf86YwiBCLdVr21VnvQGvRRXCGZqk8zkUhV35JjKkp4hs9KtG8FpVsRsHVDTzcCuJDpERJ2caXfFu88');
    $stmt = $DB_con->prepare("UPDATE voters SET votedfor = 'Congress' WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
}
if(isset($_POST['bjp']))
{
    $ex = shell_exec('./simplewallet --voter ' + $userRow['username'] + ' --password abc --party VwMikWmwBtVfFvzui3Zu7FNqnL6eiPFm18dWtkF8JzdJaJ7xLT34QXZh32DYbCa9NzdTQUsUWQwx6eYMp2S1S13c2noeZgdZ9');
    $stmt = $DB_con->prepare("UPDATE voters SET votedfor = 'BJP' WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <title>welcome - <?php print($userRow['username']); ?></title>
</head>

<body>

<div class="header">
    <div class="left">
        <label>Welcome to VoteCo</label>
    </div>
    <div class="right">
        <label><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
    </div>
</div>
<div class="content">
<div class="form-container">
    welcome : <?php print($userRow['username']);?> </br>
    <?php if (isset($userRow['votedfor']) && !empty($userRow['votedfor'])){
       echo '<h2> You have already voted for ' + $userRow['votedfor'] + '</h2>';
    }else{?>
    <form method="post">
        <h2>Choose your candidate</h2><hr />
        <div class="clearfix"></div><hr />
        <button type="submit" name="congress" class="btn btn-block btn-primary">
            <i class="glyphicon glyphicon-log-in"></i>&nbsp;Congress
        </button>
        <br /><br />
        <button type="submit" name="bjp" class="btn btn-block btn-primary">
            <i class="glyphicon glyphicon-log-in"></i>&nbsp;BJP
        </button>
    </form>
    <?}?>
</div>
</div>
</body>
</html>