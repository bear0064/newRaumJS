<?php
session_start();
include ('api/authCheck.php');
include('api/homeownerCheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeowner Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <!-- Bootstrap Styling -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/progress-wizard.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <!-- Header Area -->
    <div class="header">
        <div class="navbar-inner">
            <div class="logo">
                <a href="index.php">
                    <i class="fa fa-connectdevelop"></i>
                </a>
            </div>
            <div class="inner-header">
                <ul class="nav">
                    <li class="divider-vertical"></li>
                    <li class="active"><a href="homeowner-dashboard.php"><i class="icon-home icon-white"></i> Dashboard</a></li>
                    <li class="browse"><a href="homeowner-browse.php"><i class="icon-home icon-white"></i> Browse</a></li>
                </ul>
                <ul class="comments">
                    <li><a href="#"><i class="fa fa-comments-o"></i></a></li>
                    <li><a href="#"><i class="fa fa-bell-o"></i></a></li>
                </ul>
            </div>
            <div class="pull-right">
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?echo $_SESSION["user_pic"]?>" class="avatar img-circle img-thumbnail img-thumbnail-custom" alt="avatar"><i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <a class="dropdown-item" href="homeowner-profile.php">Profile</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="api/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- /Header Area -->

    <!-- Tabs Container -->
    <div class="tabs">
        <div class="container">
            <ul class="pager item-right">
                <li><a href="#" data-toggle="modal" data-target="#contestModal" onclick="modalInit();">New Contest</a></li>
            </ul>
            <ul class="nav nav-pills item-left">
                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#active">Active</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#completed">Completed</a></li>
            </ul>
        </div>
    </div>
    <!-- End of Tabs Container -->

    <!-- Tab Content Container -->
    <div class="container">
        <div class="tab-content">

            <!-- Sort Dropdown -->
            <!-- <div class="dropdown-category cnt-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Newest <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a class="dropdown-item" href="#">Oldest</a>
                        <a class="dropdown-item active" href="#">Newest</a>
                        <a class="dropdown-item" href="#">Highest Prize</a>
                        <a class="dropdown-item" href="#">Lowest Prize</a>
                    </div>
                </div>
            </div> -->

            <!-- Active Tab w No Active Contests -->
            <!--
<div id="active" class="tab-pane fade in active cnt-center">
    <p>You have no active contests.</p>
    <p>Click New Contest above to get started!</p>
</div>
-->

            <!-- Active Tab w Active Contests -->
            <div id="active" class="tab-pane fade in active">
                
                <!-- Sort Dropdown -->
            <div class="dropdown-category cnt-right">
                <div class="btn-group">
                    <button type="button" id="dropDownName" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Newest <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a class="dropdown-item active" value="Newest" onclick="sortActive(event);">Newest</a>
                        <a class="dropdown-item" data-dropdown="Oldest" onclick="sortActive(event);">Oldest</a>
                        <a class="dropdown-item" data-dropdown="Highest Prize" onclick="sortActive(event);">Highest Prize</a>
                        <a class="dropdown-item" data-dropdown="Lowest Prize" onclick="sortActive(event);">Lowest Prize</a>
                    </div>
                </div>
            </div>

                <div id="activerow">

                </div>
            </div>

            <!-- Completed Tab w No Completed Contests -->
            <div id="completed" class="tab-pane fade cnt-center">
                <div id="completedrow"></div>
            </div>


        </div>
    </div>
    <!--End of Tab Content Container-->




    <!-- Modal -->
    <div class="modal fade" id="contestModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content row">
                <div class="col-sm-2 prog-bar nopadding" style="height:100%;">
                    <ul class="progress-indicator stepped stacked nocenter">
                        <li class="completed">
                            <span class="bubble"></span>
                            <span class="stacked-text">Room Type Selection</span>
                        </li>
                        <li>
                            <span class="bubble"></span>
                            <span class="stacked-text">Features &amp; Dimensions</span>
                        </li>
                        <li>
                            <span class="bubble"></span>
                            <span class="stacked-text">Upload Pictures</span>
                        </li>
                        <li>
                            <span class="bubble finalStep"></span>
                            <span class="stacked-text">Finalize Details</span>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-10 nopadding">
                    <div class="modal-header myHeader" id="contestHeader">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="closeModal();">&times;</button>
                        <h5 class="modal-title">Create Contest</h5>
                    </div>

                    <div id="step1" class="modal-body">
                        <h6 class="b3header">Select your room(s)</h6>
                        <ul id="roomList" class="nopadding">

                        </ul>
                    </div>
                    <div id="step2" class="modal-body row hidden">

                        <div class="col-sm-12">
                            <h6 id="modalLabel" class="b3header"></h6>
                            <ul id="features" class="nopadding"></ul>
                        </div>
                        <div class="divider col-sm-12">
                            <hr>
                        </div>
                        <div class="col-sm-12">
                            <h6 id="dxHeader" class="b3header">Dimensions</h6>
                        </div>

                        <div id="unitMeters" class="col-sm-9 pull-xs-left">
                            <input id="widthInput" type="number" class="input dxIn" placeholder="width" data-value="0" min="0" max="50"/>
                            <input id="lengthInput" type="number" class="input dxIn" placeholder="length" data-value="1" min="0" max="50"/>
                            <input id="heightInput" type="number" class="input dxIn" placeholder="height" data-value="2" min="0" max="50"/>
                            <p class="dxInLabel">width</p>
                            <p class="dxInLabel">length</p>
                            <p class="dxInLabel">height</p>
                        </div>
                        <div id="unitFeet" class="col-sm-9 pull-xs-left hidden">

                            <input id="widthFin" type="number" class="input dxInFeet" placeholder="ft" min="0" max="100"/>
                            <input id="widthIin" type="number" class="input dxInFeet" placeholder="in" min="0" max="100"/>

                            <input id="lengthFin" type="number" class="input dxInFeet" placeholder="ft" min="0" max="100"/>
                            <input id="lengthIin" type="number" class="input dxInFeet" placeholder="in" min="0" max="100"/>

                            <input id="heightFin" type="number" class="input dxInFeet" placeholder="ft" min="0" max="100"/>
                            <input id="heightIin" type="number" class="input dxInFeet" placeholder="in" min="0" max="100"/>

                            <p class="dxInLabel revealMe">width</p>
                            <p class="dxInLabel revealMe">length</p>
                            <p class="dxInLabel revealMe">height</p>
                        </div>

                        <div class="dropdown open col-sm-2 nopadding">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="metricBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Meters
                            </button>
                            <div id="metricMenu" class="dropdown-menu" aria-labelledby="metricBtn">
                                <a href="#" class="dropdown-item" data-name="Meters">Meters</a>
                                <a href="#" class="dropdown-item" data-name="Feet">Feet</a>
                            </div>
                        </div>
                    </div>
                    <div id="step3" class="modal-body row hidden">

                        <div class="col-sm-12">
                            <h6 id="imgLabel" class="b3header">Room Images</h6>
                            <!-- Drop Zone -->
                            <div class="col-sm-5 uploadWrapper">
                                <div class="upload-drop-zone" id="dropZone">
                                    Just drag and drop files here
                                </div>

                                <!-- Standar Form -->
                                <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
                                    <div class="form-inline">
                                        <div class="form-group inputWrapper">
                                            <input type="file" name="files[]" class="fileInput" onchange="subBtnActivate();" id="uploadFiles">OR BROWSE
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary hidden" id="uploadSubmit">Upload files</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-7 nopadding">

                                <!-- Upload Finished -->
                                <div id="uploadingQueue" class="list-group">

                                </div>
                            </div>
                        </div>
                        <!-- /container -->


                    </div>
                    <div id="step4" class="modal-body row hidden">
                        <div class="col-sm-12">
                            <h6 class="b3header">Contest Details</h6>
                            <input type="text" id="titleInput" class="form-control" placeholder="Title"/></br>
                            <textarea class="form-control" rows="5" id="descInput" placeholder="Description of overall contest."></textarea>
                        </div>
                        <div class="divider col-sm-12"><hr></div>
                        <div class="col-sm-3">
                            <h6 class="b3header">Contest Length</h6>

                            <div class="dropdown open nopadding">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="lengthBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select One
                                </button>
                                <div id="lengthMenu" class="dropdown-menu" aria-labelledby="lengthBtn">
                                    <a href="#" class="dropdown-item" data-value="2">2 Weeks</a>
                                    <a href="#" class="dropdown-item" data-value="3">3 Weeks</a>
                                    <a href="#" class="dropdown-item" data-value="4">4 Weeks</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-9">
                            <h6 class="b3header">Contest Prize</h6>
                            <span id="prizeVal" class="pull-xs-right">$500</span>
                            <input type="range" id="prizeSlider" class="" value="500" min="200" max="15000" step="50" oninput="showPrizeValue(this.value);">
                        </div>


                    </div>
                    <div class="modal-footer myFooter" id="contestFooter">
                        <button id="backBtn" type="button" class="btn btn-primary pull-xs-left hidden" onclick="backClick();">Back</button>
                        <span id="modalError" class="center"></span>
                        <button id="nextBtn" type="button" class="btn btn-primary pull-xs-right" onclick="nextClick();">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--Start of Footer-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-1 col-md-1">
                    <div class="logo">
                        <a href="#">
                            <i class="fa fa-connectdevelop"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2">
                    <div class="title-link">
                        Links
                    </div>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-md-2">
                    <div class="title-link">
                        About Us
                    </div>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Sign In</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-md-2">
                    <div class="title-link">
                        Social
                    </div>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
                <div class="col-sm-5 col-md-5 contact">
                    <p>info@newraum.com</p>
                    <p>1.123.456.7890</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 col-md-offset-1 copyright">
                    &copy;2016 NewRaum
                </div>
            </div>
        </div>
    </footer>
    <!--End of Footer-->

    <!-- JavaScript -->
    <script src="js/libs/jQuery/jquery-2.2.1.min.js"></script>
    <script src="js/libs/bootstrap/bootstrap.min.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/main.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/homeownerDashPage.js"></script>

</body>

</html>