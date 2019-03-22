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
                      if (logged_in() === TRUE) {

                            $session_user_id = $_SESSION['user_id'];
                            $user_data = user_data($session_user_id, 'Pro_pic', 'F_name', 'L_name', 'D.O.R', 'Contact_num', 'Postal_add', 'Usern');
                            echo $user_data['Usern'];
                        } else {
                            header('location:login.php');
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
            </section>
        </nav>
        <!-- End Top Bar -->
        <br>  <div class="row">
            <div class="large-12 columns">    
                <nav class="top-bar" style="background-color: transparent" data-topbar>
                    <ul class="title-area">

                        <li class="name">

                        </li>
                        <li class="toggle-topbar menu-icon"><a href="#"><span>sub menu</span></a></li>
                    </ul>
                    <section class="top-bar-section"  >
                        <!-- Right Nav Section -->
                        <ul class="right" >

                            <li class="divider" ></li>
                            <li class="has-dropdown">
                                <a href="#">add</a>
                                <ul class="dropdown">
                                    <li><a href="addlivestock.php">livestock</a></li>
                                    <li><a href="addfarm.php">farm</a></li>
                                    <li><a href="addkraal.php">kraal</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <a href="#" >view</a>
                                <ul class="dropdown">
                                    <li class="has-dropdown"> <a href="#">livestock</a>
                                        <ul class="dropdown">
                                            <li><a href="viewall.php">all</a></li>
                                            <li><a href="decadence.php">decadence</a></li>
                                            <li><a href="viewspecific.php">specific</a></li>
                                            <li><a href="choose3.php">move history</a></li>
                                           
                                        </ul>
                                    </li>
                                    <li><a href="viewfarm.php">farm</a></li>
                                    <li><a href="#">kraal</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="has-dropdown" ><a href="#" >edit</a>
                                <ul class="dropdown">
                                    <li class="has-dropdown" ><a href="#" >livestock</a>
                                        <ul class="dropdown">
                                            <li><a href="choose.php">profile</a></li>
                                            <li><a href="choose2.php">move</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="editfarm.php">farm</a></li>
                                    <li><a href="choose5.php">kraal</a></li>
                                    <li><a href="profileedit.php">profile</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                        </ul>
                    </section>
                </nav></div></div>

        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="addfarm.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Adding Farm</legend>
                        <?php
                        if (isset($_POST["Reg_num"]) && isset($_POST["Name"]) && isset($_POST["Physical_address"])) {
                            
                            $CReg_num = $_POST["Reg_num"];
                            $CName = $_POST["Name"];                
                            $CPhysical_address = $_POST["Physical_address"];
                            $COwners_id = $_POST["Owners_id"];
        
                            if (!empty($CReg_num) &&!empty($CName) && !empty($CPhysical_address)) {
                                if (Farm_exists($CReg_num) === FALSE) {
                                    
                                    $session_user_id=1;
                                    $reg=date("Y.m.d");
                                    $ins = Add_Farm($CReg_num, $CName, $CPhysical_address, $session_user_id);
                                    
                                    if (!$ins) {
                                        die('Could not enter data: ' . mysql_error());
                                    } else {
                                        echo "Farm Successfully Added";
                                    }
                                } else {
                                    echo "That farm is already registerd";
                                }
                            } else {
                                echo"All fields are required";
                            }
                        }
                        ?>
                        
                        <div class="row"> 
                            <div class="large-6  columns">
                                <label>Farm name
                                    <input name="Name"type="text">
                                </label>
                            </div>
                            
                           </div>
                        
                        <div class="row">  
                           <div class="large-6  columns">
                                    <label>Registration Number
                                        <input name="Reg_num"type="text">
                                    </label>
                            </div>
                            <div class="large-6  columns">
                                    <label>Physical_address
                                        <input name="Physical_address"type="text">
                                    </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Add Farm</button>
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