<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   include 'php_utils/_dbconnect.php';

   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
   }

   $Name = $_POST['name'];
   $Email = $_POST['email'];
   $Password = $_POST['password'];
   $photo_path = 'ngo/' . basename($_FILES['photo']['name']);

   echo $Email;

   // Check whether the email exists in the database table
   $sql_checkusername = "SELECT * FROM `ngo` WHERE `email` ='$Email'";
   $result = mysqli_query($conn, $sql_checkusername);
   $numExistsRows = mysqli_num_rows($result);

   if ($numExistsRows > 0) {
      $duplicate_username_error = "The Email already exists!";
   } else {
      $sql_insertdetails = "INSERT INTO `ngo` (`name`, `email`, `password`, `photo`) VALUES (?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql_insertdetails);

      if ($stmt) {
         // Bind parameters
         mysqli_stmt_bind_param($stmt, "ssss", $Name, $Email, $Password, $photo_path);

         // Execute the statement
         $result_insertdetails = mysqli_stmt_execute($stmt);

         if ($result_insertdetails && move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
            $insertDetials_result = "Details entered successfully";
            header("Location: ngo-login.php");
            exit();
         } else {
            $insertDetails_error = "Error: " . mysqli_stmt_error($stmt);
         }

         // Close the statement
         mysqli_stmt_close($stmt);
      } else {
         $insertDetails_error = "Error: " . mysqli_error($conn);
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <link rel="icon" href="img/icon.png">
   <meta charset="utf-8">
   <title>Signup</title>
   <link rel="stylesheet" href="css/login.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
   <div class="bg-img">
      <div class="content">
         <header>NGO Signup</header>
         <form action="ngo-signup.php" method="POST" enctype="multipart/form-data">
            <div class="field space">
               <span class="fa fa-user"></span>
               <input type="text" name="name" required placeholder="Name">
            </div>
            <div class="field space">
               <span class="fa fa-user"></span>
               <input type="text" name="email" required placeholder="Email">
            </div>
            <div class="field space">
               <span class="fa fa-lock"></span>
               <input type="password" class="pass-key" required placeholder="Set Password" name="password">
               <span class="show">SHOW</span>
            </div>
            <div class="field space">
               <span class="fa fa-lock"></span>
               <label for="photo">Choose Photo:</label>
               <input type="file" name="photo">
            </div>
            <div class="field space">
               <input type="submit" value="SIGNUP">
            </div>
         </form>
         <div class="signup">
            Already have an account?
            <a href="ngo-login.php">Login Now</a>
         </div>
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