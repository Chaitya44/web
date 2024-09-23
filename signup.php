<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
 
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    $age=$_POST["age"];
    $url=$_POST["url"];
    
    if($firstname=="" || $lastname=="" || $email=="" || $password=="" || $age=="" || $url=="")
    {
        die("Fields cannot be blank");
    }
    
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        die("enter valid email address");
    }
    
    elseif(!filter_var($age,FILTER_VALIDATE_INT))
    {
        die("please enter only numbers");
    }
    elseif(!filter_var($url,FILTER_VALIDATE_URL))
    {
        die("please enter valid url");
    }
    
    move_uploaded_file($_FILES["file"]["tmp_name"],$_FILES["file"]["name"]);
    echo "data saved and file uploaded succesfully";

    // Establish a connection to the database
    $con = mysqli_connect("localhost", "root", "", "php");

    // Check the connection
    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO forms (firstname, lastname, email, password, age, url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $password, $age, $url);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) 
    {
        // If successful, redirect to llogin.php
        header("Location: llogin.php");
        exit(); // Always exit after header redirection
    } 
    else 
    {
        echo "<h1 style='color:red; text-align:center;'>Error: " . mysqli_error($con) . "</h1>";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    

mysqli_close($con);


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins",sans-serif;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background : url(pexels-pixabay-531880.jpg) no-repeat;
    background-size: cover;
    background-position: center;
}

.wrapper{
    width: 900px;
    background:transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter:blur(60px);
    backdrop-filter:brightness(70%);
    box-shadow: 0 0 10px rgba(0,0,0,.2);
    color: #fff;
    border-radius: 30px;
    padding: 30px 40px;
}
.wrapper h1{
    font-size: 36px;
    text-align: center;
}

.wrapper .input-box{
    position: relative;
    width: 50%;
    height: 50%;
    margin: 30px 0;
}

.wrapper .input-box1{
    position: relative;
    width: 50%;
    height: 50%;
    margin: 30px 0;
}
.input-box input{
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255,255,255, .2);
    border-radius: 40px;
    font-size: 16px;
    color:#fff;
    padding: 20px 45px 20px;
}

.input-box1 input{
    
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    border: 2px solid rgba(255,255,255, .2);
    border-radius: 40px;
    font-size: 16px;
    color:#fff;
    padding: 20px 45px 20px;
}
.input-box input::placeholder{
    color:#fff;
}

.input-box i{
    position:absolute;
    right:20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.wrapper .remember-forgot{
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin:-15px 0 15px;
}
.remember-forgot label input{
    accent-color: #fff;
    margin-left: 3px;
}

.remember-forgot a{
    color:#fff;
    text-decoration: none;
}
.remeber-forgot a:hover{
    text-decoration: underline;
}
.sess{
    position: absolute;
    left: 5px;
    top:5px;
    font-size: 36px;
    text-align:left; 
    color: white;
    box-shadow: 10px 30px 10px rgba(0,0,0, .1); 
}
.wrapper .btn{
    width: 100%;
    height: 45px;
    background:#fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0,0,0, .1);
    cursor: pointer;
    font-size: 16px;
    color:#333;
    font-weight:600;
}
.wrapper .register-link{
    font-size:14.5px;
    text-align:center;
    margin: 20px 0 15px;
}
.register-link p a{
    color:#fff;
    text-decoration: none;
    font-weight: 600;
}
.register-link p a:hover{
    text-decoration: underline;
}

    </style>
</head>
<script>
function greet()
{
    alert("file uploaded succesfully");
}
</script>
<body>
<?php
echo "<div class='sess'>";
session_start();
if (!isset($_SESSION["VIEWS"]))
{
    $_SESSION["VIEWS"]=1;
    echo "VISITS ".$_SESSION["VIEWS"];
}
else
{
    $_SESSION["VIEWS"]+=1;
    echo "VISITS : ".$_SESSION["VIEWS"];
}

?>  
</div>
<div class="wrapper">

        <h1>Sign Up</h1>
        <form action="signup.php" method="post" enctype="multipart/form-data"> 
            <div class="input-box">
                <input type="text" name="firstname" placeholder="First Name"  />
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="lastname" placeholder="Last Name"  />
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email"  />
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box1">
                <input type="password" name="password" placeholder="Password" />
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box1">
                <input type="text" name="age" placeholder="Age" />
                <i class='bx bx-user'></i>
            </div>
            
            <div class="input-box1">
                <input type="text" name="url" placeholder="Website URL" />
                <i class='bx bx-code-curly'></i>
            </div> 
            <div class="input-box">        
            <input type="file" name="file" value="choose a file" />
            <i class='bx bx-file-blank bx-tada' ></i>
            </div>
            <button type="submit" name="submit" class="btn" >Sign Up</button>
            
            <div class="register-link">
                <p>Already have an account? <a href="llogin.php">Login Here</a></p>
            </div>
        </form>
    </div>
</body>

</html>
