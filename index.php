<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roomify</title>
    <!-- Bootstrap Grid -->
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <!-- Bootstrap Styling -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/animate.min.css">
</head>

<body>
<header class="cd-header">
    <div class="cd-logo">
        <a href="#"><img src="img/cd-logo.svg" width="110"></a>
    </div>


    <nav>
        <ul class="cd-secondary-nav">
            <li class="nav-item pull-xs-right signin-btn btn">
                <a id="loginButtonDiv" href="login.php">
                    <img class="person-icon" src="img/person-icon.svg" width="23">Log in
                </a>
            </li>

        </ul>
    </nav>

    <a class="cd-primary-nav-trigger" href="#0">
        <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#responsiveMenu">
                <span class="hamburger-box">
                <span class="hamburger-inner"></span>
                </span>
        </button>
    </a>
</header>

<nav>
    <ul class="cd-primary-nav">
        <li class="cd-label">Account</li>
        <li><a href="#0">Sign in</a></li>

        <li class="cd-label">Menu</li>
        <li><a href="#0">What is Roomify?</a></li>
        <li><a href="#0">Homeowners</a></li>
        <li><a href="#0">Designers</a></li>

        <li class="cd-label">Company</li>

        <li><a href="#0">Contact Us</a></li>
        <li><a href="#0">Team</a></li>
    </ul>
    <div class="primary-nav-fade"></div>
</nav>

<section class="container-fluid" id="section1">
    <div class="container intro">
        <div class="animated fadeInDown">
        <div class="hero-title">Embrace your Space</div>
        <div class="hero-para">Connecting <span class="highlight">homeowners</span> with professional and aspiring <span
                class="highlight">interior designers</span></div>
            </div>
        <div class="learn-more btn animated fadeInUp">
            <img src="img/play-icon.svg" width="40">Learn more
        </div>
    </div>
</section>

<div class="slant">
    <div class="col-lg-6 left-slant"></div>
    <div class="col-lg-6 right-slant"></div>
</div>

<section class="container-fluid" id="section2">
    <div class="col-md-12">
        <img src="img/room-icon.svg" alt="image">
        <h3 class="heading">What is Roomify?</h3>
        <!--            <hr>-->
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 brief">Roomify is a hub for interior design contests created by homeowners
            looking to improve their space — whether that’s by adding some modern furniture to their office, new
            textiles to their master bedroom, or better lighting throughout their home — professional and aspiring
            designers are eager to display their expertise.
        </div>
    </div>

</section>

<section class="container-fluid" id="section3">
    <div class="row">
        <div class="col-md-5">
            <h2>Roomify for homeowners.</h2>
            <p>Discover new ways to imagine your space while connecting 1-on-1 with designers from around the world.
                Host design contests and choose the best design for you and your home.</p>
        </div>
        <div class="col-md-6 col-md-offset-1">
            <img src="img/homeowner-img.svg" alt="image">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <img src="img/designer-img.svg" alt="image">
        </div>
        <div class="col-md-5 col-md-offset-1">
            <h2>Roomify for designers.</h2>
            <p>Begin your freelance career as an interior designer while improving your skills and building your
                portfolio. Compete against a trusted community of talented designers and watch your designs come to
                life.</p>
        </div>
    </div>
</section>

<section class="container-fluid" id="section4">
    <div class="row">
        <div class="col-md-12">
            <h2>Get notified when we launch.</h2>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <p>Leave your e-mail and we'll notifiy you when we're ready — or <a href="login.php">sign up</a> for beta
                and you can help us by becoming a tester.</p>
        </div>
    </div>
    <div class="row">
        <form>
            <input class="email" type="email" placeholder="Your E-mail" name="email" required="required">
            <input class="notify-btn" type="submit" name="notify" value="notify me">
        </form>
    </div>
</section>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img/footer-logo.svg" width="50">
            </div>
            <div class="col-md-6 footer-nav">
                <ul>
                    <li><a href="#0">Contact Us</a></li>
                    <li><a href="team.php">Team</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    // Look for .hamburger
    var hamburger = document.querySelector(".hamburger");
    // On click
    hamburger.addEventListener("click", function () {
        // Toggle class "is-active"
        hamburger.classList.toggle("is-active");
        // Do something else, like open/close menu
    });
</script>
<script src="js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/style.js"></script>
<script src="js/main.js"></script>
<script src="js/login.js"></script>

</body>

</html>