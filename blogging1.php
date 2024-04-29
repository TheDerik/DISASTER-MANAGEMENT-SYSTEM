<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
}

if (isset($_GET['email'])) {
  $loggedin_email = $_GET['email'];
}

include 'php_utils/_dbconnect.php';

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Posted_by_email = $_POST['posted_by_email'];

  $stmt1 = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
  $stmt1->bind_param("s", $Posted_by_email);
  $stmt1->execute();
  $rs1 = $stmt1->get_result();

  if ($row1 = $rs1->fetch_assoc()) {
    $stmt1->free_result();
  }

  // Check if 'featured' key is set in $_POST
  $featured = isset($_POST['featured']) && $_POST['featured'] === 'Yes' ? 'Yes' : 'No';

  $posted_by_name = $row1['name'];
  $Post_text = isset($_POST['post_text']) ? $_POST['post_text'] : '';
  $filename = isset($_FILES["post_photo"]["name"]) ? $_FILES["post_photo"]["name"] : '';
  $tempname = isset($_FILES["post_photo"]["tmp_name"]) ? $_FILES["post_photo"]["tmp_name"] : '';
  $post_photo = "upload/" . $filename;

  if (!empty($tempname)) {
    move_uploaded_file($tempname, $post_photo);
  }

  $stmt_insertdetails = $conn->prepare("INSERT INTO `blog` (`posted_by`, `post_text`, `post_photo`, `featured`) VALUES (?, ?, ?, ?)");
  $stmt_insertdetails->bind_param("ssss", $posted_by_name, $Post_text, $post_photo, $featured);
  $stmt_insertdetails->execute();

  if ($stmt_insertdetails->affected_rows > 0) {
    $insertDetials_result = "Details entered successfully";
  } else {
    $insertDetails_error = "Error: " . $stmt_insertdetails->error;
  }

  $stmt_insertdetails->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="img/icon.png">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forums</title>
  <link rel="stylesheet" href="css/blogging1.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <!-- sidebar starts -->

  <div class="sidebar">
    <a href="index3.html">
      <span>
        <img src="logo.png" width="94px" alt="logo">
      </span>
    </a>
    <i class="fab fa-twitter"></i>

    <a href="blogging1.php?email=<?php echo htmlspecialchars($_SESSION['email']); ?>" style="text-decoration: none;">
      <div class="sidebarOption active">
        <span class="material-icons"> home </span>
        <h2>Home</h2>
      </div>
    </a>

    <a href="logout.php" style="text-decoration: none;">
      <div class="sidebarOption">
        <span class="material-icons"> home </span>
        <h2>Logout</h2>
      </div>
    </a>

    <a href="user-page.php?email=<?php echo htmlspecialchars($_SESSION['email']); ?>" style="text-decoration: none;">
      <div class="sidebarOption">
        <span class="material-icons"> home </span>
        <h2>Back to homepage</h2>
      </div>
    </a>
  </div>
  <!-- sidebar ends -->

  <!-- feed starts -->
  <div class="feed">

    <!-- tweetbox starts -->
    <div class="tweetBox">
      <form action="blogging1.php" method="POST" enctype="multipart/form-data">
        <div class="tweetbox__input">
          <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="profile">
          <input type="hidden" name="posted_by_email" value="<?php echo htmlspecialchars($loggedin_email); ?>">
          <input type="text" placeholder="What's happening?" name="post_text">
        </div>
        <input type="file" name="post_photo" accept="image/jpg, image/jpeg, image/png" style="margin: 0px auto 0px 45px;">
        <button class="tweetBox__tweetButton" type="submit">POST</button>
      </form>
    </div>
    <!-- tweetbox ends -->

    <?php
    $qr = "SELECT * FROM `blog` ORDER BY RAND() LIMIT 10";
    if ($result = mysqli_query($conn, $qr)) {
      while ($row = mysqli_fetch_assoc($result)) {
        $stmt2 = $conn->prepare("SELECT * FROM `users` WHERE `name` = ?");
        $stmt2->bind_param("s", $row['posted_by']);
        $stmt2->execute();
        $res = $stmt2->get_result();
        $usr = $res->fetch_assoc();
        $stmt2->close();

        echo '
        <!-- post starts -->
        <div class="post">
          <div class="post__avatar">
            <img src="' . htmlspecialchars($usr['photo']) . '" alt="avatar" />
          </div>
    
          <div class="post__body">
            <div class="post__header">
              <div class="post__headerText">
                <h3>
                  ' . htmlspecialchars($row['posted_by']) . '
                  <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                </h3>
              </div>
              <div class="post__headerDescription">
                <p>' . htmlspecialchars($row['post_text']) . '</p>
              </div>
            </div>
            <img src="' . htmlspecialchars($row['post_photo']) . '" alt="post">
          </div>
        </div>
        <!-- post ends -->
        ';
      }
    }
    ?>

    <!-- feed ends -->

    <!-- widgets starts -->
    <div class="widgets">
      <div class="widgets__input">
        <span class="material-icons widgets__searchIcon"> search </span>
        <input type="text" placeholder="Search CalamityCare" />
      </div>

      <div class="widgets__widgetContainer">
        <h2>What's happening in X ?</h2>
        <blockquote class="twitter-tweet">
          <p lang="en" dir="ltr">
            Sunsets don&#39;t get much better than this one over
            <a href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>.
            <a href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw">#nature</a>
            <a href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw">#sunset</a>
            <a href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a>
          </p>
          &mdash; US Department of the Interior (@Interior)
          <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw">May 5, 2014</a>
        </blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
    </div>
    <!-- widgets ends -->
  </div>
</body>

</html>