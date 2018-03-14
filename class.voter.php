<?php

class Voter
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function login($uname,$upass)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM voters WHERE username=:uname LIMIT 1");
            $stmt->execute(array(':uname'=>$uname));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0)
            {
                if(password_verify($upass, $userRow['password']))
                {
                    $_SESSION['user_session'] = $userRow['id'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function register($uname,$upass)
    {
        try
        {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO voters(username,password) 
                                                       VALUES(:uname, :upass)");

            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":upass", $new_password);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    public function vote($party){
        switch ($party){
            case 1:
                $address = "ljndfgnfjdkgbkjdfhbgjkskbs";
                break;
            case 2:
                $address = "ljndfgnfjdkgbkjdfhbgjkskbs";
                break;
        }
        //TODO Call vote transfer API nigger and store results in db
    }
}