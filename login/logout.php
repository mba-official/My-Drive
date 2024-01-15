<?php

    include("/projects/MyDrive/mydrive.php");
    
    session_start();

    if(!isset($_SESSION["login"]) || ($_SESSION["login"]) != true){
        header("location: /projects/MyDrive/login/login.php");
        exit();
    }
    
    session_unset();
    
    session_destroy();
    
    header("location: /projects/MyDrive/login/login.php");
?>