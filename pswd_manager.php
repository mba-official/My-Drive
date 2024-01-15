<?php

session_start();
if(!isset($_SESSION["login"]) || ($_SESSION["login"]) != true){
    header("location: /projects/MyDrive/login/login.php");
    exit();
}

$delete = false;
$update = false;
$add    = false;

// Database Connection
$server = "localhost";
$username = "root";
$password = "";
$database = "mydrive";

$con = mysqli_connect($server, $username, $password, $database);

// Check Database Connection
if(!$con){
    die("Database connection failed due to ". mysqli_connect_error());
}
// Delete Query
if(isset($_GET["delete"])){
    $srno = $_GET["delete"];
    $delete = true;
    $delete = "DELETE FROM passwords WHERE pswd_id = $srno";
    $final = mysqli_query($con, $delete);
}
// Update Query
if(isset($_POST["sr_edit"])){
    $edit_site_name = $_POST['site_name'];
    $edit_email = $_POST['email'];
    $edit_pswd = $_POST['pswd'];
    $pswd_id = $_POST['sr_edit'];

    $update = "UPDATE passwords SET site_name = '$edit_site_name', email = '$edit_email', pswd = '$edit_pswd' WHERE pswd_id = '$pswd_id'";
    $run = mysqli_query($con,$update);
    if($run){
        $update = true;
    }else{
        echo "Failed! Something Went Wrong";
    }
}
// Insert Query
else{
if(isset($_POST['add_note'])){
    $site_name = $_POST['site_name'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $save = "INSERT INTO `passwords` (`site_name`, `email`, `pswd`) VALUES ('$site_name','$email', '$pswd')";
    $result = mysqli_query($con, $save);
    $add = true;
    if($result){
        header("location: pswd_manager.php");
    }else{
        echo "Failed! Something Went Wrong";
    }
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Passwords - Safe Private Drive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <!-- Insert Bootstrap Modal for Edit Note -->
    <!-- Set Button For Trigger Modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
    Edit (This is for check that modal is working or not.)
    </button> -->

    <!-- Edit-Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                    <input type="hidden" name="sr_edit" id="sr_edit">
                    <label for="site_name" class="form-label">Site Name</label>
                    <input type="text" class="form-control" id="site_name_Edit" name="site_name">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_Edit" name="email">
                    <label for="pswd" class="form-label">Password</label>
                    <input type="password" class="pswd form-control" id="pswd_Edit" name="pswd">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" onclick="show_hide_pswd_2()">
                    <label class="form-check-label" for="show_pswd">
                        Show Password
                    </label>
                    </div>
                    <form method="post">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Insert Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="mydrive.php"><b>MY Drive</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="mydrive.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="todo_list.php">TODO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="pswd_manager.php">PASSWORDS</a>
                    </li>
                </ul>
                    <a class="btn btn-success" type="submit" href="/projects/MyDrive/login/logout.php">Logout</a>
                </form>
            </div>
        </div>
    </nav>

    <!-- Show Success or Error Messege -->
    <?php
    if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Record has been delete successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    ?>
    <?php
    if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Record has been update successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    ?>
    <?php
    if($add){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Record has been add successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    ?>

    <!-- Insert Form for submit data -->
    <div class="container my-3">
        <form method="post" class="form-control" id="todo_form">
            <h3 class="text-center mb-0">ADD DETAILS</h3>
            <div class="mb-3">
                <label for="site_name" class="form-label">Site Name</label>
                <input type="text" class="form-control" id="site_name" name="site_name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="pswd form-control" id="pswd" name="pswd">
            <div>    
                <input class="form-check-input show_pswd" type="checkbox" onclick="show_hide_pswd()">
                    <label class="form-check-label" for="show_pswd">
                        Show Password
                    </label>
            </div>
                <button type="submit" class="add_note btn btn-primary my-3 mb-0" id="add_note"
                    name="add_note">Add</button>
        </form>
    </div>

    <!-- Insert Table for show data -->
    <div class="container my-3">
        <h3>DETAIL LIST</h3>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr. No</th>
                    <th scope="col">Site Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Passwords</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
    $sql = "SELECT * FROM passwords";
    $result = mysqli_query($con, $sql);
    $srno = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $srno = $srno + 1;
        echo "<tr>
        <th scope='row'>$srno</th>
        <td>" . $row['site_name'] . "</td>
        <td>" . $row['email'] . "</td>
        <td> <input class='bg-success form-check-input' type='checkbox' role='switch' style='margin-right: 20px' checked>" . $row['pswd'] . "</td>
        <td><button type='submit' class='edit_details btn btn-primary' id=". $row['pswd_id'] . ">Edit</button> <button type='submit' class='delete btn btn-danger' id=d". $row['pswd_id'] . ">Delete</button></td>
      </tr>";
    }
    ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- This Fuction is for JQuery DataTable -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        // For Edit The Note
        edits = document.getElementsByClassName("edit_details");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log('edit');
                tr = e.target.parentNode.parentNode;
                site_name = tr.getElementsByTagName('td')[0].innerText;
                email = tr.getElementsByTagName('td')[1].innerText;
                pswd = tr.getElementsByTagName('td')[2].innerText;
                // console.log(site_name, email, pswd);
                site_name_Edit.value = site_name;
                email_Edit.value = email;
                pswd_Edit.value = pswd;
                sr_edit.value = e.target.id;
                // console.log(sr_edit.value)
                $('#editModal').modal('toggle');
            })
        })
        // For Delete The Note
        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element1) => {
            element1.addEventListener("click", (e1) => {
                console.log('delete');
                serialno = e1.target.id.substr(1,);
                if(confirm("Are You Sure?")){
                    console.log('Yes');
                    window.location = `pswd_manager.php?delete=${serialno}`;
                }else{
                    console.log('No');
                }
            })
        })
        // Function For Show & Hide Password
        function show_hide_pswd() {
            var pswd = document.getElementById("pswd");
            if (pswd.type === "password") {
                pswd.type = "text";
            } else {
                pswd.type = "password";
            }
            }
        function show_hide_pswd_2() {
            var pswd = document.getElementById("pswd_Edit");
            if (pswd.type === "password") {
                pswd.type = "text";
            } else {
                pswd.type = "password";
            }
            }
        function show_hide_pswd_3() {
            var pswd = document.getElementById("pswd_Edit");
            if (pswd.type === "password") {
                pswd.type = "text";
            } else {
                pswd.type = "password";
            }
            }
    </script>

</body>

</html>

