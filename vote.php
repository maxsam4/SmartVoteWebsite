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
    $ex = shell_exec("./simplewallet --voter " .$userRow['username']. " --password lol123 --party VwNrgk7AkhUTM59SGCkzuSjYJXqe4CW1NNfTAV4uVhFjDJ33PYsNgTPhPDPQoVG8PpS9g5wTSghYvAon9NaDdca61MT94mXbF");
    $stmt = $DB_con->prepare("UPDATE voters SET votedfor = 'Congress' WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $done = 1;
    $stmt = $DB_con->prepare("SELECT * FROM voters WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}
if(isset($_POST['bjp']))
{
    $ex = shell_exec("./simplewallet --voter " .$userRow['username']. " --password lol123 --party VwPSxjt81CfKhBFUEDtTS99u94rskDDm81D9w8Lr5s6ZWC6W24yP4vhUcH54DSDGhbC9vChF6fYSpLvrFm3rLW1H1ViodpcyX");
    $stmt = $DB_con->prepare("UPDATE voters SET votedfor = 'BJP' WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $done = 1;
    $stmt = $DB_con->prepare("SELECT * FROM voters WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <title>welcome, <?php print($userRow['username']); ?>!</title>
</head>

<body>

<div class="header">
    <div class="right">
        <label><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
    </div>
</div>
<div class="content">
<div class="form-container">
    welcome, <?php print($userRow['username']);?>! </br>
    <?php if (isset($userRow['votedfor']) && !empty($userRow['votedfor'])){?>
        <hr /><h2> You have already voted for <?php print($userRow['votedfor'])?>!</h2>
    <?php }else{?>
    <form method="post">
    <hr /><h2>Cast your vote : </h2><hr />
        
        <button type="submit" name="congress" class="btn btn-block btn-primary">
            <i class="glyphicon glyphicon-log-in"></i>&nbsp;Congress
        </button>
        <div class="clearfix"></div><hr />
        <button type="submit" name="bjp" class="btn btn-block btn-primary">
            <i class="glyphicon glyphicon-log-in"></i>&nbsp;BJP
        </button>
    </form>
    <?php } ?>
</div>
</div>
</body>
</html>