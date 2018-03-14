<?php

session_start();

$DB_host = "127.0.0.1";
$DB_user = "root";
$DB_pass = "abc";
$DB_name = "vote";
try
{
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}


include_once 'class.voter.php';
$voter = new Voter($DB_con);