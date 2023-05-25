<?php
session_start();

if(isset($_SESSION['email'])){
    header("location:index.php");
}
?>
<html>
    <head>
        <title>User Login</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="assets/css1/mystyles2.css" rel="stylesheet" />
        <link href="assets/css1/variables-orange.css" rel="stylesheet"/>
        <link href="assets/css1/mainstyle7.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="wrapper">
            <h1><a href = "index.php">CaféBook</a><span>.</span></h1>
            <div id="formContent">
                <h2>User Login</h2>
                <form name="login" method="post" action="login_check.php" style="margin-left:5%;">
                    <table>
                        <?php if(isset($_SESSION['messageLogIn'])){
                            echo "<tr>
                                    <td colspan='2' style='color:red;'>".$_SESSION['messageLogIn']."</td>
                                </tr>";
                            unset($_SESSION['messageLogIn']);
                        }?>
                        <tr>
                            <td colspan="2"><strong>Enter your account:</strong></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="email" name="email"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td>Remember me:</td>
                            <td><input type="checkbox" name="rememberMe" value="1"></td>
                        </tr> 
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="submit" value="Log In"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">Don't have an account? </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><a href ='signup.php'>Sign up</a></td>
                        </tr>
                    </table> 
                </form>
            </div>
    </div>

    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/captchaScript.js"></script>
    </body>
</html>
