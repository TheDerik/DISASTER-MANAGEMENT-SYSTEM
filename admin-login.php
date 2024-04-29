<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($username === 'admin' && $password === 'admin') { //If Yes then
        session_start(); //Start the session
        $_SESSION['loggedin'] = true; //Setting loggedin variable as true
        $_SESSION['username'] = $username; //Storing the variable
        header("Location: admin-page.php"); //On successfull login the page gets redirected to user-page.php
        exit;
    } else { //If No then
        $success_status = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" href="img/icon.png">
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>Admin Login Form</header>
            <form action="admin-login.php" method="POST">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" required placeholder="Email" name="username">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" class="pass-key" required placeholder="Password" name="password">
                    <span class="show">SHOW</span>
                </div>
                <div class="pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="field">
                    <input type="submit" value="LOGIN">
                </div>
            </form>
        </div>
    </div>
    <script>
        const pass_field = document.querySelector('.pass-key');
        const showBtn = document.querySelector('.show');
        showBtn.addEventListener('click', function() {
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db";
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222";
            }
        });
    </script>
</body>

</html>