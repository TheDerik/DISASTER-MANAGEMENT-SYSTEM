<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="icon" href="img/icon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobile.css">
    <title>Preparedness: Your shield against disasters!</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box
        }

        body {
            font-family: Verdana, sans-serif;
            margin: 0
        }

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 6px 6px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {

            .prev,
            .next,
            .text {
                font-size: 11px
            }
        }
    </style>
</head>

<body>
    <nav class="navigation max-width-1 m-auto">
        <div class="nav-left">
            <img src="logo.png" width="94px" alt="">
            <ul>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="nav-left">
            <form>
                <button class="btn"><a href="user-signup.php" style="text-decoration: none;">User Sign Up</a></button>
                <button class="btn" style="margin-left: 10px;"><a href="user-login.php" style="text-decoration: none;">User Login</a>
                </button>
            </form>
            <div class="nav-right">
                <form>
                    <button class="btn"><a href="ngo-signup.php" style="text-decoration: none;">NGO Sign Up</a></button>
                    <button class="btn" style="margin-left: 10px;"><a href="ngo-login.php" style="text-decoration: none;">NGO Login</a>
                    </button>
                    <button class="btn" style="margin-left: 10px;"><a href="admin-login.php" style="text-decoration: none;">Admin Login</a>
                    </button>
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
                <!--<div class="content-right">`
            <img src="img/home.svg" alt="iBlog">
        </div>-->
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
        $query = "SELECT * FROM `articles` ORDER BY `article_time` DESC LIMIT 4";
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
                <a href="' . $row['link'] . '" target="_blank">
                    <h3>' . $row['article_tagline'] . '</h3>
                </a>
    
                <div>' . $row['article_source'] . '</div>
                <span>' . $row['article_time'] . '</span>
            </div>
        </div>
            ';
        }
        ?>

        <div class="footer">
            <p>Copyright &copy; Dr. B.C. Roy Engineering College </p>
            <a href="https://bcrec.ac.in/">BCREC</a>
        </div>
    </div>
</body>

</html>