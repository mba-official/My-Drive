<?php 
session_start();
if(!isset($_SESSION["login"]) || ($_SESSION["login"]) != true){
    header("location: /projects/MyDrive/login/login.php");
    exit();
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Drive <?php echo $_SESSION['Logged_In']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
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
                    <a class="btn btn-success" href="/projects/MyDrive/login/logout.php" type="submit">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <h1>Welcome <?php echo $_SESSION['Logged_In']?></h1>
        <h4 class="text-center">This is Home Page.</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio corporis, earum dicta corrupti aliquid officia
            incidunt sit, natus sed ipsa quae minus? Deleniti magni expedita, id odit earum minima deserunt nostrum ex,
            fuga asperiores dicta ullam voluptate et eos ipsum nihil, porro autem maxime illum nisi ipsa accusantium.
            Deleniti ipsum dolores impedit architecto provident labore veniam ipsa eos nobis dicta tempora, magnam culpa
            eveniet at saepe quas reprehenderit ea voluptatum! Nulla illo adipisci officiis modi? Ducimus, excepturi
            magni? At magnam ipsa mollitia, suscipit hic labore. Asperiores doloremque, et non cumque quo, cum nemo
            natus aperiam aliquam nisi explicabo similique veritatis.</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>