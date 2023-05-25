<?php
    session_start();
    class PageHandler{
        public static function getHomePage(){
            header('Location: indexMain.php');
        }

        public static function getLoggedInPage(){
            header('Location: indexLoggedIn.php');
        }
    }
?>

<html>
    <head>
        <title>CaféBook</title>
    </head>
    
    <body>
        <?php 
        
        require_once 'securityHandler.php';

        if(isset($_SESSION['email'])){ 
            PageHandler::getLoggedInPage();
        }else if(isset($_COOKIE['email']) && isset($_COOKIE['token'])){
            if(SecurityHandler::checkUserToken($_COOKIE['email'], $_COOKIE['token'])){
                $_SESSION['email'] = $_COOKIE['email'];
                PageHandler::getLoggedInPage($_COOKIE['email']);
            }  
        }
        else{
            PageHandler::getHomePage();
        }

        ?>
    </body>
</html>
