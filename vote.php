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
//TODO cast vote
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
    welcome : <?php print($userRow['username']); ?>

</div>
</body>
</html>