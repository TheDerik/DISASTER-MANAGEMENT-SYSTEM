<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'php_utils/_dbconnect.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $Name = $_POST['name'];
    $Phone = $_POST['phone'];
    $Email = $_POST['email'];
    $Message = $_POST['msg'];


    $sql_insertdetails = "INSERT INTO `msgs` (`name`, `phone`, `email`, `message`) VALUES ('$Name', '$Phone','$Email', '$Message')";
    $result_insertdetails = mysqli_query($conn, $sql_insertdetails);

    if ($result_insertdetails) {
        $insertDetials_result = "Details entered successfully";
    } else {
        $insertDetails_error =  "Error: " . mysqli_connect_errno();
    }
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
            <a href="index.html">
                <span><img src="logo.png" width="94px" alt=""></span>
            </a>
            <ul>
                <li><a href="index.html">Home</a></li>
            </ul>
        </div>
    </nav>
    <div class="max-width-1 m-auto">
        <hr>
    </div>
    <div class="contact-content font1 max-width-1 m-auto">
        <div class="max-width-1 m-auto mx-1">
            <h2>Feel Free to Contact Us</h2>

            <form action="contact.php" method="post">
                <div class="contact-form">
                    <div class="form-box">
                        <input type="text" placeholder="Enter Your Name" name="name">
                    </div>
                    <div class="form-box">
                        <input type="text" placeholder="Enter Your Phone Number" name="phone">
                    </div>
                    <div class="form-box">
                        <input type="text" placeholder="Enter Your Email Id" name="email">
                    </div>
                    <div class="form-box">
                        <textarea name="msg" id="" cols="30" rows="10" placeholder="How may we help you?"></textarea>
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