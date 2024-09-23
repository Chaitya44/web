<?php

        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            session_start();
            
            
            $uname= $_POST["email"];
            $pass= $_POST["password"];   
            $con=mysqli_connect("localhost","root","","php"); 
        
        if(!$con)
        {
            
            die("ERROR IN CONNECTION");
        }
        $sql="select *from forms where email='" .$uname. "'and password='" .$pass."'";
        $result=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
            $_SESSION["uname"]=$uname;
            //$HTTP_SESSION_VARS[$uname]=&$_SESSION["uname"];
            header("location:http://localhost/cart.php");
        }
        echo"<h1>invalid username or password</h1>";
        
        mysqli_close($con);
        }
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>


<body>
    <div class="wrapper">
        <form action="llogin.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Username"  required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required >
                <i class='bx bxs-lock-alt'></i>
            </div>     
            <div class="remember-forgot">
                <label><input type="checkbox" />Remember me
                </label>
                <a href="#">Forgot Password?</a>
            </div>     
            <button type="submit" class="btn">Login</button>
            
            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Register</a></p>

            </div>  
        </form>
    </div>
</body>
</html>   