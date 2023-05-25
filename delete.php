<?php
require_once 'connection.php';
//$sql1="SELECT * FROM cafes WHERE id='{$_GET['id']}'";
//$query=mysqli_query($con, $sql1) or die(mysqli_error($con));
//$row=mysqli_fetch_array($query);
//unlink($row["image"]);
//$sql2="DELETE FROM cafes WHERE id='{$_GET['id']}'";
//$query=mysqli_query($con, $sql2) or die(mysqli_error($con));
$dbtable = 'examendb3.cafes';
$id= new \MongoDB\BSON\ObjectId($_GET['id']);
$bulk = new MongoDB\Driver\BulkWrite;
$filter = ['_id' => $id];
        
$bulk->delete($filter);
$client->executeBulkWrite($dbtable, $bulk);

header('location:index.php');


?>