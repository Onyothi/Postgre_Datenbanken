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
<div class="fixed">
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
                          
                        }
                         else {
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
                                            <li><a href="choose3.php"> history</a></li>
                                           
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

        <!-- End Mobile Header -->


        <div class="row">


            <div class="large-12 columns">

                <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                    <legend >Status History</legend>
                    <div class="row">
                        <div class="large-12 columns">
                            
                             <?php
                            $us=$_SESSION['Code3'];
                            $sqlu = "Select Name FROM livestock Where Owners_id='$session_user_id' and Tag_code='$us'";
                            $resultut = mysql_query($sqlu);
                            $mmove = mysql_fetch_array($resultut);
                            echo "Livestock Name:  " . $mmove['Name'] .'     ' . "Tag Code:  " . $us?>
                        </div>
                    </div>
                   <br>
                    <div class="row">
                        <div class="large-4 columns" style="border: 3px solid black; background-color:  #43ac6a">
                            Previous status:
                        </div>
                        <div class="large-4 columns" style="border: 3px solid black; background-color:  #43ac6a">
                            Change Status:
                        </div>
                         <div class="large-4 columns" style="border: 3px solid black; background-color:  #43ac6a">
                             Change Date:
                        </div>
                       
                    </div>
                    <div class="row">
                        
                           <br>
                            <?php
                            mysql_select_db("namagrifarm");
                           
                            $sql = "SELECT Tag_code, C_status,C_date, Prev  FROM status Where Tag_code='$us'";
                            $resultt = mysql_query($sql);
                            while ($row2 = mysql_fetch_array($resultt)) {
                                ?> 
                        
                        <div class="large-4 columns" style="border: 3px solid black;">
                            <?php echo $row2['Prev'] ?>
                        </div>
                        <div class="large-4 columns" style="border: 3px solid black;">
                            <?php echo $row2['C_status'] ?>
                        </div>
                       
                        <div class="large-4 columns" style="border: 3px solid black;">
                            <?php echo $row2['C_date'] ?>
                        </div>
                        <?php
                        }
                            ?>
                    </div>
                </fieldset>

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