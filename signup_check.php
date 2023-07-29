<?php
class User{
    public $email;
    public $pass;
    public $lastName;
    public $firstName;
    
    public function setData($e, $p, $ln, $fn){
        $this->email = $e;
        $this->pass = $p;
        $this->lastName = $ln;
        $this->firstName = $fn;
    }
}

require_once 'connection.php';
session_start();
$dbtable="examendb3.users";
$message="Failed";

if(($_POST['email'] != "") && ($_POST['password'] != "")
        && ($_POST['cpassword'] != "") && ($_POST['lastName'] != "")
        && ($_POST['firstName'] != "")){
    $email = $_POST['email'];

    $filter=['email' => $email];
    $query = new MongoDB\Driver\Query($filter);
    $article = $client->executeQuery($dbtable, $query);
    $resultEmailsCount = count($article->toArray());
    
    if($resultEmailsCount == 0){
        if(strlen($_POST['password'])>=6){
            if($_POST['password'] == $_POST['cpassword']){

                $user = new User();
                $user->setData($_POST['email'], md5($_POST['password']), $_POST['lastName'], $_POST['firstName']);

                $bulk = new MongoDB\Driver\BulkWrite;
                $data=array(
                    '_id' => new MongoDB\BSON\ObjectID,
                    'email'=>$user->email,
                    'password'=>$user->pass,
                    'lastName' => $user->lastName,
                    'firstName' => $user->firstName
                );
                $bulk->insert($data);
                $client->executeBulkWrite($dbtable, $bulk);

                $message = "Success";

                header('location: index.php');  
            }
            else{
                $message = "Passwords must match";
            }        
        }
        else{
            $message = "Password is too short.";
        }
    }
    else
    {
        $message = "Email already used.";
    }
}
else{
    $message = "All of the fields are mandatory";
}


if($message == "Failed"){
    $message = "Something went wrong";
}

if($message != "Success")
{
    $_SESSION['messageSignUp'] = $message;
    header('location: signup.php');
}


?>

