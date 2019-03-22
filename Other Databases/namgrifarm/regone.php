<?php
session_start();
require 'db_connection.php';
include 'functions.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/orbit.css">
        <script src="js/vendor/modernizr.js"></script>
        <script src="js/foundation/foundation.slider.js"></script>
        <script scr="js/foundation/foundation.orbit.js"></script>
        <script src="js/foundation.min.js"></script>
        <title></title>
    </head>
    <body>

        <nav class="top-bar" data-topbar>
            <ul class="title-area">

                <li class="name">
                    <h1 id="top_bar_h1">

                        <img src="img/logo.jpg" width="40" height="40">NAM AGRI FARM


                    </h1>
                </li>
                <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
            </ul>
            <section class="top-bar-section">
                <!-- Right Nav Section -->
                <ul class="right">
                    <li class="divider"></li>
                    <li><a href="index.php">Home</a></li>
                    <li class="divider"></li>
                    <li class="divider"></li>
                    <li><a href="regone.php">Register</a></li>
                    <li class="divider"></li>
                    <li><a href="login.php">Login</a></li>
                    <li class="divider"></li>
                    <li class="divider"></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="Contact_Us.php">Contact_Us</a></li>


                </ul>
            </section>
        </nav>
        <!-- End Top Bar -->
        <br> 

        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="regone.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Registration Part1</legend>
                        <?php
                        if (isset($_POST["IDd"]) && isset($_POST["fname"]) && isset($_POST["lname"])) {
                            $IDd = $_POST["IDd"];
                            $ffname = $_POST["fname"];
                            $lname = $_POST["lname"];
                            $bname = $_FILES['photo']['name'];
                            $btemp = $_FILES['photo']['tmp_name'];
                            if ($bname === null) {
                                $bname = "pro_pic.jpg";
                            }
                            if (!empty($ffname) && !empty($IDd) && !empty($lname)) {
                                if (user_exists($IDd) === TRUE) {
                                    die('Already registerd');
                                } else {
                                    $uploadDir = "uploads/";
                                    $gen = generateKey();
                                    $burl = $uploadDir . $bname . gen;
                                    move_uploaded_file($btemp, $burl);
                                    $reg = date("Y.m.d");
                                    $_SESSION['IDd'] = $IDd;
                                    $_SESSION['ffname'] = $ffname;
                                    $_SESSION['lname'] = $lname;
                                    $_SESSION['burl'] = $burl;
                                    $_SESSION['reg'] = $reg;
                                    $page = "regtwo.php";
                                    //redirect($page);
                                    echo "
                                            <script type='text/javascript'>
                                            window.location='$page';
                                            </script>

                                    ";
                                }
                            } else {
                                echo"All fields are required";
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="large-6  columns">
                                <label>ID Number
                                    <input name="IDd" type="number">
                                </label>
                            </div>
                            <div class="large-6  columns">
                                <label>Profile Picture
                                    <img src="img/pro_pic.png" width="40" height="40">
                                    <div class="custom_file_upload">
                                        <div class="file_upload">
                                            <input type="file" name="photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
                                        </div>
                                    </div>
                                </label>
                            </div>  
                        </div>
                        <div class="row">  
                            <div class="large-6  columns">
                                <label>First name
                                    <input name="fname"type="text">
                                </label>
                            </div>
                            <div class="large-6  columns">
                                <label>Last name
                                    <input name="lname"type="text">
                                </label>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Next</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>






        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <script>
            $("#Subject").on("change", function(){

                var id = $(this).val();
 

     

                $("#element_5_1").html(id);
            })
        </script>
    </script>
    <script>
        document.write('<script src=js/vendor/' +
            ('__proto__' in {} ? 'zepto' : 'jquery') +
            '.js><\/script>')
    </script>

    <!-- End Footer -->    

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation({
            orbit: {
                animation: 'slide',
                timer_speed: 1000,
                pause_on_hover: true,
                animation_speed: 500,
                navigation_arrows: true,
                bullets: false
            }
        });
    </script>

</body>
</html>
