<?php
    require __DIR__.'/connection.php';
    
    class SecurityHandler{
        static function generateToken(){
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);

            return $token;
        }

        static function addToken($email){
            $dbtable = "examendb3.userTokens";
            $token = self::generateToken();

            /* set cookie to last 1 year */
            $expirationAdder = 60*60*24*365;
            setcookie('email', $email, time()+$expirationAdder);
            setcookie('token', $token, time()+$expirationAdder);

//            $query="INSERT INTO $table(email, token, expirationDate) VALUES ('{$email}',"
//                . "'{$token}', NOW()+00010000000000)";
//
//            $result= mysqli_query($GLOBALS['con'], $query)or die(mysqli_error($con));
            $bulk = new MongoDB\Driver\BulkWrite;
            
            $expDate = (new DateTime())->add(new DateInterval('P1Y'));
            $data=array(
                '_id' => new MongoDB\BSON\ObjectID,
                'email'=>$email,
                'token'=>$token,
                'expirationDate' => new MongoDB\BSON\UTCDateTime($expDate->getTimestamp() * 1000)
            );
             $bulk->insert($data);

             $GLOBALS['client']->executeBulkWrite($dbtable, $bulk);
        }

        static function checkUserToken($email, $token){ 
            $dbtable = "examendb3.userTokens";
            $filter=[
                'email' => $email, 
                'token' => $token,
                'expirationDate' => ['$gt' => new MongoDB\BSON\UTCDateTime(time() * 1000)]
            ];
            $query = new MongoDB\Driver\Query($filter);
            $article = $GLOBALS['client']->executeQuery($dbtable, $query);
            $doc= current($article->toArray());
            if($doc){
                return true;
            }
            return false;
//            $query = "SELECT * FROM $table WHERE email='$email' AND token='$token' AND expirationDate > NOW() LIMIT 1";
//            $result=mysqli_query($GLOBALS['con'], $query);
//
//            if(mysqli_num_rows($result) == 1){
//                return true;
//            }
//            return false;
        }
    }
    
    
   
    
    
    
    