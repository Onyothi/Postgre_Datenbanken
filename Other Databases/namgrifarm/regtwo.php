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

                        <?php
                        /*

                          if (logged_in() === TRUE) {

                          $session_user_id = $_SESSION['user_id'];
                          $user_data = user_data($session_user_id, 'Name', 'Surname', 'Username', 'Gender', 'Contact_Number', 'Email_Address', 'Profile_Pic');
                          echo $user_data['Username'];
                          } else {
                          header('location:login.php');
                          } */
                        ?>

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
                <form method="post" action="regtwo.php">
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Registration Part 2</legend>
                        <?php
                        if (isset($_POST["regn"]) && isset($_POST["faname"]) && isset($_POST["Physical"])) {
                            $regn = $_POST["regn"];
                            $faname = $_POST["faname"];
                            $Physical = $_POST["Physical"];
                            if (!empty($faname) && !empty($regn) && !empty($Physical)) {
                                if (farm_exists($regn) === TRUE) {
                                    die('Already registerd');
                                } else {

                                    $_SESSION['regn'] = $regn;
                                    $_SESSION['faname'] = $faname;
                                    $_SESSION['Physical'] = $Physical;
                                    $page = "regthree.php";
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
                                <label>Farm Registration Number
                                    <input name="regn" type="text">
                                </label>
                            </div>

                            <div class="large-6  columns">
                                <label>Farm name
                                    <input name="faname"type="text">
                                </label>
                            </div>

                        </div>
                        <div class="row">  
                            <div class="large-6  columns">
                                <label>Physical Address
                                    <input name="Physical"type="text">
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
