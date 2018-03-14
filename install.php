<?php

require_once 'dbconfig.php';

try {
    $sql ="CREATE table IF NOT EXISTS voters(
     id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR( 150 ) NOT NULL, 
     password VARCHAR( 150 ) NOT NULL,
     tid VARCHAR( 150 ), 
     votedfor VARCHAR( 150 )
     );" ;
    $DB_con->exec($sql);
    print("Created voters table.\n");
    $sql ="CREATE table IF NOT EXISTS party(
     id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
     walletname VARCHAR( 150 ) NOT NULL,
     walletpass VARCHAR( 150 ) NOT NULL
     );" ;
    $DB_con->exec($sql);
    print("Created party table.\n");
    //TODO Insert dummy data
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}