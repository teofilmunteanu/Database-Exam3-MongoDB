
<?php
require_once "connection.php";
 $dbtable = 'examendb3.userTokens';
 
if(isset($_COOKIE['email']) && isset($_COOKIE['token'])){
    $email = $_COOKIE['email'];
    $token = $_COOKIE['token'];
//    $query="DELETE FROM usertokens WHERE email='$email' AND token='$token'";
//    $result= mysqli_query($con, $query)or die(mysqli_error($con));

    $bulk = new MongoDB\Driver\BulkWrite;
    $filter = ['email' => $email, 'token' => $token];

    $bulk->delete($filter);
    $client->executeBulkWrite($dbtable, $bulk);
    
    unset($_COOKIE['email']);
    unset($_COOKIE['token']);
    setcookie('email', '', time() - 3600);
    setcookie('token', '', time() - 3600);
}

session_start();
session_unset();
session_destroy();
header('location:index.php');

?>
