<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
}

if (isset($_GET['email'])) {
    $loggedin_email = $_GET['email'];
}

include 'php_utils/_dbconnect.php';

$stmt1 = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
$stmt1->bind_param("s", $loggedin_email);
$stmt1->execute();
$rs1 = $stmt1->get_result();

if ($row1 = $rs1->fetch_assoc()) {
    $stmt1->free_result();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt2 = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $stmt2->bind_param("s", $_POST['email']);
    $stmt2->execute();
    $rs2 = $stmt2->get_result();

    if ($row2 = $rs2->fetch_assoc()) {
        $stmt2->free_result();
    }

    $Name = $row2['name'];
    $Message = $_POST['msg'];

    $stmt_insertdetails = $conn->prepare("INSERT INTO `user-msgs` (`name`, `email`, `msg`) VALUES (?, ?, ?)");
    $stmt_insertdetails->bind_param("sss", $Name, $_POST['email'], $Message);
    $stmt_insertdetails->execute();

    if ($stmt_insertdetails->affected_rows > 0) {
        $insertDetials_result = "Details entered successfully";
        echo "
        <script>
        alert('Message sent!');
    </script>
        ";
    } else {
        $insertDetails_error = "Error: " . $stmt_insertdetails->error;

        echo "
        <script>
        alert('There were some errors, please try back later!');
    </script>
        ";
    }

    $stmt_insertdetails->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/mobile.css">
    <title>Contact us</title>


</head>

<body>
    <nav class="navigation max-width-1 m-auto">
        <div class="nav-left">
            <img src="logo.png" width="94px" alt="icon">
            <ul>
                <a href="user-page.php?email=<?php echo $loggedin_email; ?>" style="text-decoration: none; text-align: center;">Home</a>
            </ul>
        </div>
    </nav>

    <div class="max-width-1 m-auto">
        <hr>
    </div>
    <div class="contact-content font1 max-width-1 m-auto">
        <div class="max-width-1 m-auto mx-1">
            <h2>Hii <?php echo $row1['name'] ?>, Feel Free to Contact Us</h2>

            <form action="users-contact.php?email=<?php echo $_SESSION['email']; ?>" method="post" enctype="multipart/form-data">
                <div class="contact-form">
                    <div class="form-box">
                        <textarea name="msg" id="" cols="30" rows="10" placeholder="How may we help you?"></textarea>
                        <input type="hidden" name="email" value="<?php echo $loggedin_email; ?>">
                    </div>
                    <div class="form-box">
                        <button class="btn">Submit</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <div class="footer">
        <p>Copyright &copy; Dr. B.C. Roy Engineering College </p>
        <a href="https://bcrec.ac.in/">BCREC</a>
    </div>
</body>

</html>