<?php
session_start();

if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) && ($_SESSION['username'] != 'admin')) {
    header("location: index.html");
}

include 'php_utils/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $photo_path = 'articles/' . basename($_FILES['photo']['name']);
    $article_tagline = $_POST['tagline'];
    $article_link = $_POST['link'];
    $article_source = $_POST['source'];
    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y h:i A');

    $qry = "INSERT INTO `articles`(`article_photo`, `article_tagline`, `link`, `article_source`, `article_time`) VALUES (?, ?, ?, ?, ?)";
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path)) {
        $stmt = mysqli_prepare($conn, $qry);
        mysqli_stmt_bind_param($stmt, "sssss", $photo_path, $article_tagline, $article_link, $article_source, $currentDateTime);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_errno($stmt) !== 0) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            $stmt->close();
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Page</title>

    <style>
        input {
            padding: 8px;
            font-size: 20pxpx;
        }

        button {
            padding: 8px;
            font-size: 20pxpx;
            border: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <nav class="navigation max-width-1 m-auto">
        <div class="nav-left">
            <img src="logo.png" width="94px" alt="">
        </div>
        <div class="nav-left">
            <form>
                <button class="btn"><a href="logout.php" style="text-decoration: none;">Logout</a></button>
            </form>
        </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center">
        <form action="admin-page.php" method="post" enctype="multipart/form-data" style="display: flex; gap: 15px; flex-direction: column; width: 400px; margin: 10px; padding: 15px; border-radius: 8px; box-sizing: border-box; box-shadow: rgba(0, 0, 0, 0.24) 0px 14px 22px;">
            <h1>Add Article</h1>
            <label for="article-photo">Article photo</label>
            <input type="file" name="photo">
            <label for="article-tagline">Article tagline</label>
            <input type="text" name="tagline">
            <label for="article-link">Article link</label>
            <input type="text" name="link">
            <label for="article-newspapername">Source</label>
            <input type="text" name="source">

            <button type="submit">Add Article</button>
        </form>
    </div>

    <?php
    // Fetch messages from the 'msgs' table
    $query = "SELECT `name`, `phone`, `email`, `message`, `date` FROM `msgs` ORDER BY `date` DESC";
    $result = mysqli_query($conn, $query);

    // Check for errors
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    ?>

    <div class="container mt-4">
        <h2>Random Messages</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">Phone: <?php echo $row['phone']; ?></p>
                            <p class="card-text">Email: <?php echo $row['email']; ?></p>
                            <p class="card-text">Message: <?php echo $row['message']; ?></p>
                            <p class="card-text">Date: <?php echo $row['date']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    // Fetch messages from the 'msgs' table and order by date
    $query1 = "SELECT `name`, `email`, `msg`, `date` FROM `user-msgs` ORDER BY `date` DESC";
    $result1 = mysqli_query($conn, $query1);

    // Check for errors
    if (!$result1) {
        die("Error: " . mysqli_error($conn));
    }
    ?>


    <div class="container mt-4">
        <h2>Registered User Messages</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">Email: <?php echo $row['email']; ?></p>
                            <p class="card-text">Message: <?php echo $row['msg']; ?></p>
                            <p class="card-text">Date: <?php echo $row['date']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    // Fetch messages from the 'msgs' table and order by date
    $query2 = "SELECT `name`, `email`, `message`, `date` FROM `ngo-msgs` ORDER BY `date` DESC";
    $result2 = mysqli_query($conn, $query2);

    // Check for errors
    if (!$result2) {
        die("Error: " . mysqli_error($conn));
    }
    ?>


    <div class="container mt-4">
        <h2>Registered User Messages</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">Email: <?php echo $row['email']; ?></p>
                            <p class="card-text">Message: <?php echo $row['message']; ?></p>
                            <p class="card-text">Date: <?php echo $row['date']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>