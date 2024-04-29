<?php
session_start();

if (isset($_SESSION['email'])) {
    $loggedin_email = $_SESSION['email'];
}

if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) && $_SESSION['email'] != $loggedin_email) {
    header("location: login.php");
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
    <link rel="stylesheet" href="css/slideshow_style.css">
    <title>Preparedness: Your shield against disasters!</title>
</head>

<body>
    <nav class="navigation max-width-1 m-auto">
        <div class="nav-left">
            <img src="logo.png" width="94px" alt="icon">

            <form>
                <a href="user-page.php?email=<?php echo $_SESSION['email']; ?>" style="text-decoration: none;">Home</a>
                <a href="forecast.php" style="text-decoration: none;">Forcast</a>
                <a href="blogging1.php?email=<?php echo $_SESSION['email']; ?>" style="text-decoration: none;">BLOG</a>
                <a href="users-contact.php?email=<?php echo $_SESSION['email']; ?>" style="text-decoration: none;">Contact</a>
                <a href="user-profile.php?email=<?php echo $_SESSION['email']; ?>" style="text-decoration: none;">Profile</a>
                <a href="logout.php" style="text-decoration: none;">Logout</a>
            </form>
        </div>
    </nav>

    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="max-width-1 m-auto">
                <hr>
            </div>
            <div class="m-auto content max-width-1 my-2">
                <div class="content-left">
                    <h1>Because Life Matters.</h1>
                    <p>CalamityCare is a website dedicated to disaster management and prediction. Our primary aims are
                        to provide early warnings for various disasters, offer essential resources and guidance, foster
                        community engagement, deliver data-driven insights, and promote education and training. Through
                        these initiatives, CalamityCare seeks to empower individuals and communities, enhancing
                        preparedness
                        and resilience in the face of emergencies.</p>
                </div>
            </div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 4</div>
            <img src="img/2.jpg" style="width:100%">
            <div class="text">
                <p></p>
            </div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 4</div>
            <img src="img/3.jpg" style="width:100%">
            <div class="text"></div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">4 / 4</div>
            <img src="img/4.jpg" style="width:100%">
            <div class="text"></div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";

            // Auto advance to the next slide every 3 seconds (adjust the delay as needed)
            setTimeout(function() {
                plusSlides(1);
            }, 4000); // 3000 milliseconds = 3 seconds
        }
    </script>

    <div class="max-width-1 m-auto">
        <hr>
    </div>
    <div class="home-articles max-width-1 m-auto font2">
        <h2>Featured Articles</h2>

        <?php

        include 'php_utils/_dbconnect.php';

        // Fetch the latest 7 blogs from the 'articles' table, ordered by article_time
        $query = "SELECT * FROM `articles` ORDER BY `article_time` DESC LIMIT 7";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="home-article">
            <div class="home-article-img">
                <img src="' . $row['article_photo'] . '" alt="article">
            </div>
            <div class="home-article-content font1">
                <a href="#">
                    <h3>' . $row['article_tagline'] . '</h3>
                </a>
    
                <div>' . $row['article_source'] . '</div>
                <span>' . $row['article_time'] . '</span>
            </div>
        </div>
            ';
        }
        ?>
    </div>

    <div class="footer">
        <p>Copyright &copy; iBlog.com </p>
        <a href="https://www.vecteezy.com/free-vector/typewriter">Vector Credits: Vecteezy</a>
    </div>
</body>

</html>