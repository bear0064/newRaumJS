<?php
session_start();
include('api/authCheck.php');
include('api/designerCheck.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homeowner viewing Designer Profile</title>
        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap-grid.css">
        <!-- Bootstrap Styling -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="css/styles.css" rel="stylesheet">
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,900' rel='stylesheet' type='text/css'>
    </head>

    <body>

        <!-- Header Area -->
        <header>
            <nav class="navbar">

                <!-- Brand -->
                <div class="navbar-brand logo">
                    <a href="index.php">
                        <img src="img/footer-logo.svg" width="50">
                    </a>
                </div>

                <!-- Links -->
                <ul class="nav navbar-nav">
                    <li class="nav-item primary-link">
                        <a class="nav-link" href="designer-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item primary-link">
                        <a class="nav-link" href="designer-browse.php">Browse</a>
                    </li>
                    <li class="nav-item dropdown pull-xs-right profile-pic">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                            src="<?php echo $_SESSION["user_pic"] ?>"
                            class="avatar img-circle img-thumbnail img-thumbnail-custom" alt="avatar"><i
                            class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu dropdown-profile" aria-labelledby="dropdownMenu">
                            <a class="dropdown-item" href="designer-profile.php">Profile</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="api/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </li>
                    <li class="primary-nav-icon nav-item pull-xs-right">
                        <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i></a>
                        <div class="dropdown-menu dropdown-notif">
                            <div class="dropdown-menu-header">Notifications <span class="label label-pill label-danger">0</span></div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">You have 0 notifications</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">View all</a>
                        </div>
                    </li>
                    <li class="primary-nav-icon nav-item pull-xs-right">
                        <a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-envelope-o"></i></a>
                        <div class="dropdown-menu dropdown-inbox">
                            <div class="dropdown-menu-header">Inbox <span class="label label-pill label-danger">0</span></div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">You have 0 messages</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">View all</a>
                        </div>
                    </li>
                    <!--TODO SWITCH VIEW BUTTON-->
                    <?php if($_SESSION['user_type'] == 1)
                    { echo "<li class='primary-nav-icon nav-item pull-xs-right'>
                        <a class='nav-link' data-userType='homeowner' onclick='changeUserType(this.dataset);'>
                            <img class='person-icon' src='img/person-icon.svg' width='23'>Switch to Homeowner
                        </a>
                    </li>";
                    }
                    ?>
                </ul>
            </nav>
        </header>
        <!-- End of Header Area -->

        <!-- Profile Info Container -->
        <div class="profile">
            <div class="container" style="padding-top: 50px">
                <div class="row">
                    <div class="col-xs-8">
                        <div id="designerProfile" class="media">

                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="row">
                            <div class="col-xs-4 mail-like">
                                <a href="#" class="item-left"><i class="fa fa-envelope-o"></i></a>
                                <a href="#" class="item-right"><i class="fa fa-thumbs-o-up"></i></a>
                                <div class="clear"></div>
                            </div>
                            <ul class="pager col-xs-8 item-right">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Profile Info Container -->

        <!-- Tabs Container -->
        <div class="tabs">
            <div class="container">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#portfolio">Showcase</a></li>
                    <!-- CHANGE - added Submissions Tab -->
                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#mySubmissions">Submissions</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#about">About</a></li>
                </ul>
            </div>
        </div>
        <!-- End of Tabs Container -->

        <!-- Content Container -->
        <div class="container">
            <div class="tab-content">

                <!-- Portfolio Tab -->
                <div id="portfolio" class="tab-pane fade in active">

                    <!-- Sort Dropdown -->
                    <div class="dropdown-category cnt-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Newest <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                <a class="dropdown-item active" href="#">Newest</a>
                                <a class="dropdown-item" href="#">Oldest</a>
                            </div>
                        </div>
                    </div>

                    <!-- portfolio submissions - row 1 -->
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="card designerCard">
                                <img class="card-img-top" src="images/1.png" width="100%" alt="Card image cap">
                                <div class="card-block">
                                    <div class="pull-xs-right">
                                        <a href="#" class="link-like"><span class="number-like">21</span><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="card designerCard">
                                <img class="card-img-top" src="images/1.png" width="100%" alt="Card image cap">
                                <div class="card-block">
                                    <div class="pull-xs-right">
                                        <a href="#" class="link-like"><span class="number-like">21</span><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- portfolio submissions - row 2 -->
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="card designerCard">
                                <img class="card-img-top" src="images/1.png" width="100%" alt="Card image cap">
                                <div class="card-block">
                                    <div class="pull-xs-right">
                                        <a href="#" class="link-like"><span class="number-like">21</span><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Portfolio Tab -->

                <!-- Submissions Tab -->
                <div id="mySubmissions" class="tab-pane fade">

                    <!-- Sort Dropdown -->
                    <div class="dropdown-category cnt-right">
                        <div class="btn-group">
                            <button type="button" id="dropDownName" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Newest <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                <a class="sort dropdown-item active" href="#" onclick="desSortDesignerSubmissions(event);">Newest</a>
                                <a class="sort dropdown-item" href="#" onclick="desSortDesignerSubmissions(event);">Oldest</a>
                            </div>
                        </div>
                    </div>

                    <!-- submissions - row 1 -->
                    <div id="outputSubmissions" class="row">

                    </div>
                </div>
                <!-- End of Submissions Tab -->

                <!-- About Tab -->
                <div id="about" class="tab-pane fade cnt-center">

                    <!-- Stats -->
                    <div class="count-number col-sm-10 col-md-10 col-md-offset-1">

                        <!-- Submitted -->
                        <div class="col-sm-3 col-md-3">
                            <div class="number">
                                3
                            </div>
                            <div class="caption">
                                Submitted
                            </div>
                        </div>

                        <!-- Won -->
                        <div class="col-sm-3 col-md-3">
                            <div class="number">
                                1
                            </div>
                            <div class="caption">
                                Won
                            </div>
                        </div>

                        <!-- Runner Up -->
                        <div class="col-sm-3 col-md-3">
                            <div class="number">
                                0
                            </div>
                            <div class="caption">
                                Runner up
                            </div>
                        </div>

                        <!-- Endorsements -->
                        <div class="col-sm-3 col-md-3">
                            <div class="number">
                                1
                            </div>
                            <div class="caption">
                                Endorsements
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- Reviews Section -->
                    <div class="review">
                        <div class="title">
                            <div class="text item-left">
                                <h5>Reviews</h5>
                            </div>

                            <!-- Sort Dropdown -->
                            <div class="btn-group item-right">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Newest <span class="caret"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <a class="dropdown-item active" href="#">Newest</a>
                                    <a class="dropdown-item" href="#">Oldest</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="item-review">
                            <div class="col-sm-3 col-md-3">
                                <div class="media">
                                    <div class="pull-left" href="#">
                                        <img class="media-object img-circle img-thumbnail img-thumbnail-custom" src="images/128.jpg" alt="avatar" style="width: 90px;height:90px;">
                                    </div>
                                    <div class="media-body cnt-left" style="padding-left: 20px">
                                        <div class="name">
                                            <a href="homeowner-profile.php">Mike Z</a>
                                        </div>
                                        <div class="day">
                                            Feb 26, 2016
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9">
                                <div class="stars cnt-left">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                                <div class="description cnt-left">
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>
                <!-- End of About Tab -->

            </div>
        </div>
        <!-- End of Content Container -->

        <!-- Footer -->
            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/footer-logo.svg" width="50">
                        </div>
                        <div class="col-md-6 footer-nav">
                            <ul>
                                <li><a href="#0">Contact Us</a></li>
                                <li><a href="#0">Team</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        <!-- End of Footer -->

        <!-- JavaScript -->
        <script src="js/libs/jQuery/jquery-2.2.1.min.js"></script>
        <script src="js/libs/bootstrap/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/displayDesignerProfile.js"></script>
    </body>

    </html>
