<?php
session_start();

if (isset($_GET['email'])) {
    $loggedin_email = $_GET['email'];
}

if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)) {
    header("location: index.html");
}

include 'php_utils/_dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php
    $qry = "SELECT * FROM `users` WHERE `email` = '$loggedin_email'";
    $result = mysqli_query($conn, $qry);
    $row = mysqli_fetch_assoc($result);
    ?>

    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="col">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo $row['photo'];?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?php echo $row['name']; ?></h5>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="user-page.php?email=<?php echo $_SESSION['email']; ?>"><button type="button" class="btn btn-outline-primary ms-1 active">Back to homepage</button></a>
                                <a href="logout.php"><button type="button" class="btn btn-outline-primary ms-1 active">Logout</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $row['name']; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $row['email']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>