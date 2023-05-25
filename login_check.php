<?php
require_once 'connection.php';
require_once 'securityHandler.php';
session_start();
$dbtable="examendb3.users";
$message="Failed";


if(($_POST['email'] != "") && ($_POST['password'] != "")){
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
//        $query = "SELECT * FROM $table WHERE email='$email' AND password='$pass'";
//        $result=mysqli_query($con, $query);
    $filter=['email' => $email, 'password' => $pass];
    $query = new MongoDB\Driver\Query($filter);
    $article = $client->executeQuery($dbtable, $query);
    $resultEmailsCount = count($article->toArray());

    if($resultEmailsCount == 1){
        if(isset($_POST['rememberMe'])){
            SecurityHandler::addToken($email);
        }

        $message = "Success";
        $_SESSION['email'] = $email;

        header('location: index.php');    
    }
    else{
        $message = "Email/Password Invalid.";
    }
}
else{
    $message = "You must supply an email and password.";
}


if($message == "Failed"){
    $message = "Something went wrong";
}

if($message != "Success")
{
    $_SESSION['messageLogIn'] = $message;
    header('location: login.php');
}

?>

