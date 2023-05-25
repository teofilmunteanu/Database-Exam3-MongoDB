<?php
session_start();

if(isset($_SESSION['email'])){
    header("location:index.php");
}
?>
<html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="assets/css1/mystyles2.css" rel="stylesheet" />
        <link href="assets/css1/variables-orange.css" rel="stylesheet"/>
        <link href="assets/css1/mainstyle7.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="wrapper">
            <h1><a href = "index.php">CaféBook</a><span>.</span></h1>
            <div id="formContent">
                <h2>User Registration</h2>
                <form name="signup" method="post" action="signup_check.php" style="margin-left:5%;">
                    <table>
                        <?php if(isset($_SESSION['messageSignUp'])){
                            echo "<tr>
                                    <td colspan='2' style='color:red;'>".$_SESSION['messageSignUp']."</td>
                                </tr>";
                            unset($_SESSION['messageSignUp']);
                        }
                        ?>
                        <tr>
                            <td colspan="2"><strong>Create your account:</strong></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="email" name="email"></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><input type="text" name="lastName"></td>
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><input type="text" name="firstName"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td>Confirm Password:</td>
                            <td><input type="password" name="cpassword"></td>
                        </tr> 
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="submit" value="Sign Up"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">Already have an account? </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><a href ='login.php'>Log In</a></td>
                        </tr>
                    </table> 
                </form>
            </div>
        </div>
        
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/captchaScript.js"></script>
    </body>
</html>



