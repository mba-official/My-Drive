<?php

session_start();
if(isset($_SESSION["login"])){
    header("location: /projects/MyDrive/mydrive.php");
    exit();
}

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mydrive';

$con = mysqli_connect($server, $username, $password, $database);
if(!$con){
    echo"Failed due to ". mysqli_connect_error();
}
$show_error = false;

if(isset($_POST["Login_btn"])){
    $username = $_POST['user_username'];
    $pswd = sha1($_POST['user_pswd']);
    $sql_query = "SELECT * FROM `login_details_marked` WHERE `user_username` = '$username' AND `user_pswd` = '$pswd'";
    $result = mysqli_query($con, $sql_query);
    $output = mysqli_num_rows($result);
    if($output > 0){
        session_start();
        $_SESSION["login"] = true;
        $_SESSION['Logged_In'] = $username;
        header("location: /projects/MyDrive/mydrive.php");
    }else{
       $show_error = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Notes - Safe Private Drive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-primary">
    <div class="mt-5 text-center text-white">
        <h1 class="display-4" style="font-weight: bold;">My Drive</h1>
        <h5 style="margin-bottom: 7rem;">My Private Place</h5>
        <h1 class="display-4" style="font-weight: bold;">Login</h1>
    </div>
    <div class="text-center text-white mt-5">
        <?php if($show_error){echo 'Invalid Username or Password.';}?>
    </div>
    <div class="container mt-3 text-white d-flex justify-content-center">
        <form method="post">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" name="user_username" class="form-control" />
            </div>
            <!-- Password input -->
            <div class="form-outline">
                <label class="form-label" for="pswd">Password</label>
                <input type="password" id="pswd" name="user_pswd" class="form-control" />
            </div>
            <div>    
                <input class="form-check-input show_pswd bg-danger mb-4" type="checkbox" onclick="show_hide_pswd()" id="show_pswd">
                    <label class="form-check-label" for="show_pswd">
                        Show Password
                    </label>
            </div>
            <!-- Submit button -->
            <center><button type="submit" id="Login_btn" name="Login_btn" class="btn btn-success btn-block mb-4">Login</button></center>
        </form>
    </div>




    <script>
            function show_hide_pswd() {
                var pswd = document.getElementById("pswd");
                if (pswd.type === "password") {
                    pswd.type = "text";
                } else {
                    pswd.type = "password";
                }
            }
    </script>
</body>

</html>