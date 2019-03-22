<?php
session_start();
error_reporting(0);
require 'db_connection.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/foundation.css" />
        <script src="../js/vendor/modernizr.js"></script>
        <script src="../js/foundation/foundation.slider.js"></script>
        <script scr="../js/foundation/foundation.orbit.js"></script>
        <title></title>
    </head>
    <body>

        <nav class="top-bar" data-topbar>
            <ul class="title-area">

                <li class="name">
                    <h1 id="top_bar_h1">

                        <img src="img/logo.jpg" width="40" height="40">NAM AGRI FARM
                        <?php
                        if (logged_in() === TRUE) {

                            $session_user_id = $_SESSION['user_id'];
                            $user_data = user_data($session_user_id, 'Pro_pic', 'F_name', 'L_name', 'D.O.R', 'Contact_num', 'Postal_add', 'Usern');
                            echo $user_data['Usern'];
                            header('location:profile.php');
                        }
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
                </li>
                </ul>
            </section>
        </nav>
        <!-- End Top Bar -->
        <br>
        <div class="row">


            <div class="large-8 columns ">
                <div style="alignment-adjust: central">
                    <form method="post" >
                        <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                            <legend >Login</legend>
                            <?php
                            include 'verify.php';
                            ?>
                            <label>User Name
                                <input name="usernam" type="text" placeholder="Enter your user name">
                            </label>
                            <label>Password
                                <input name="pass" type="password" placeholder="Enter your password">
                            </label>
                            <button name="login" type="submit">login</button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.write('<script src=js/vendor/' +
                ('__proto__' in {} ? 'zepto' : 'jquery') +
                '.js><\/script>')
        </script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
        <!-- End Footer -->    

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
