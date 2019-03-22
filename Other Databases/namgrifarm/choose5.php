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
                            echo $user_data;
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
                                            <li><a href="choose3.php">history</a></li>

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
                                    <li><a href="choose4.php">farm</a></li>
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
                <form method="post" action="choose5.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Edit Kraal</legend>
                        <?php
                        if (isset($_POST["farm"])) {
                            $farm = $_POST["farm"];
                            $kraal = $_POST["kraal"];

                            if ($farm != "Select") {
                                $_SESSION['Reg_num3'] = $kraal;

                                $page = "editkraal.php";
                                //redirect($page);
                                echo "
                                            <script type='text/javascript'>
                                            window.location='$page';
                                            </script>

                                    ";
                            } else {
                                echo"All fields are required";
                            }
                        }
                        ?>

                        <div class="row">
                            <div class="large-6  columns">
                                <div class="dropdown">
                                    <label>Farm 
                                        <select name="farm" id="farm" >
                                            <option>Select</option>
<?php
mysql_select_db("namagrifarm");

$sql = mysql_query("SELECT `Reg_num`,`Name` FROM `farms` where Owners_id='$session_user_id'");
while ($row = mysql_fetch_array($sql)) {

    echo '<option value="' . $row['Reg_num'] . '">' . $row['Name'] . '</option>';
}
?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-6 columns">
                                <div class="dropdown">
                                    <label>Kraal
                                        <select name="kraal"  id="kraal">
                                            <option>Select</option>   
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Edit</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>






        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            $("#farm").on("change", function(){

                var id =$(this).val();
                $.post('getkraals.php',{name:id},function(data){
           
                    $("#kraal").html(data);
            
                });
 
            })
        </script>
        <script>
            $("#type").on("change", function(){

                var id =$(this).val();
                $.post('getbreeds.php',{name:id},function(data){
           
                    $("#breed").html(data);
            
                });
 
            })
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