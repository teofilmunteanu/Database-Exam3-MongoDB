<?php
require_once "connection.php";
session_start();
$dbtable = "examendb3.cafes";
$msg = "Saved";

if(isset($_POST['submit'])){ 
    $name=$_POST['cafe_name'];
    $loc=$_POST['cafe_location'];
    $desc=$_POST['cafe_description'];
    $email=$_SESSION['email'];
    
    if($name=="" || $loc=="" || $desc==""){
        $msg="All fields are mandatory!";
    }
    else{
//        $cafesSql="SELECT * FROM cafes WHERE name='$name' AND emailAssigned='$email';";
//        $cafesResult=mysqli_query($con, $cafesSql)or die(mysqli_error($con));
        $filter=['emailAssigned' => $email, 'name' => $name];
        $query = new MongoDB\Driver\Query($filter);
        $article = $client->executeQuery($dbtable, $query);
        $resultCafesCount = count($article->toArray());

        if($resultCafesCount == 0){
            if (!file_exists('./images/')) {
                mkdir('./images', 0777, true);
            }

            $target="./images/". md5(uniqid(time())).basename($_FILES['image']['name']);

            if(! move_uploaded_file($_FILES['image']['tmp_name'],$target)){
                $msg="File not saved!";
            }
            else{
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetype = finfo_file($finfo, $target);
                $fileTypes = array("jpg", "jpeg", "png", "gif");
                $ok = false;
                foreach($fileTypes as $ft){
                    if($mimetype == 'image/'.$ft){
                        $ok = true;
                    }
                }
                if(! $ok){
                    $msg="Invalid file format!";
                }
            }      
        }
        else{
            $msg = "Caffe already added to this user!";
        }
    }
    
    
    if($msg == "Saved"){
//        $sql="INSERT INTO $table(name, location, description, image, uploadType, emailAssigned) VALUES('$name','$loc','$desc','$target','$uploadType', '$email')";
//        mysqli_query($con,$sql);
        $bulk = new MongoDB\Driver\BulkWrite;
        $data=array(
            '_id' => new MongoDB\BSON\ObjectID,
            'name'=>$name,
            'location'=>$loc,
            'description' => $desc,
            'image' => $target,
            'emailAssigned' =>$email
        );
        $bulk->insert($data);
        $client->executeBulkWrite($dbtable, $bulk);
         
        header('location:index.php');
    }
    
}
?>

<html>
    <head>
        <title>Upload Cafe</title>
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css1/mystyles2.css" rel="stylesheet">

    </head>
    
    <body>
        <div class="wrapper">
            <div id="formContent">
                <?php 
                    echo $msg;
                ?>
                <br/>
                <a type="button" class="btn btn-primary" href='index.php'>Back</a>
            </div>
        </div>
    </body>
</html>