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
                            $user_data = user_data($session_user_id, 'Pro_pic', 'F_name', 'L_name', 'D.O.R', 'Contact_num', 'Postal_add', 'Physical_add', 'Usern', 'Pass');
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
                <form method="post" action="Editprofile.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Edit Profile</legend>
<?php
if (isset($_POST["fnam"])) {

    $fname = $_POST["fnam"];
    $lname = $_POST["lnam"];

    $cnum = $_POST["cnu"];
    $padd = $_POST["pad"];
    $phadd = $_POST["phad"];

    $use = $_POST["usernam"];
    $pass = $_POST["pas"];
    $password_hash = md5($pass);
    $confpass = $_POST["confpas"];
    $name = $_FILES['pro_pi']['name'];
    $temp = $_FILES['pro_pi']['tmp_name'];


    if ($pass == $confpass) {
        $us = $user_data['Usern'];
        $uploadDir = "uploads/";
        $url = $uploadDir . $name;
        move_uploaded_file($temp, $url);
        mysql_select_db("sen");
        if ($pass == null && $name == null) {
            $sqll = " UPDATE  `owners` SET  `F_name`='$fname', `L_name`='$lname',`Contact_num`='$cnum',`Postal_add`='$padd',`Physical_add`='$phadd', `Usern`='$use' WHERE `Owners_id`='$session_user_id' and `Usern`='$us'";
        } elseif ($pass == null && $name != null) {
            $sqll = " UPDATE  `owners` SET  `F_name`='$fname', `L_name`='$lname',`Contact_num`='$cnum', `Postal_add`='$padd', `Physical_add`='$phadd', `Usern`='$use', `Pro_Pic`='$url' WHERE `Owners_id`='$session_user_id' and `Usern`='$us'";
        } elseif ($name == null && $pass != null) {
            $sqll = " UPDATE  `owners` SET  `F_name`='$fname', `L_name`='$lname',`Contact_num`='$cnum', `Postal_add`='$padd', `Physical_add`='$phadd', `Usern`='$use', `Pass`='$pass', `Pass`='$password_hash' WHERE `Owners_id`='$session_user_id' and `Usern`='$us'";
        } else {
            $sqll = " UPDATE  `owners` SET  `F_name`='$fname', `L_name`='$lname',`Contact_num`='$cnum', `Postal_add`='$padd', `Physical_add`='$phadd', `Usern`='$use',`Pass`='$pass', `Pro_Pic`='$url', `Pass`='$password_hash' WHERE `Owners_id`='$session_user_id' and `Usern`='$us'";
        }
        $ins = mysql_query($sqll);
        if (!$ins) {
            die('Could not enter data: ' . mysql_error());
        } else {
            echo "The profile was edited successfully";
        }
    } else {
        print "<font color='red'>Passwords should be the same";
    }
}
?>
                        <div class="row">
                            <div class="large-6  columns">
                                <label>First Name
                                    Name <input style="border-color: greenyellow" name="fnam" type="text" value="<?php echo $user_data['F_name']; ?>"> 
                                </label>
                            </div>
                            <div class="large-3  columns">
                                <label>Last Name
                                    Name <input style="border-color: greenyellow" name="lnam" type="text" value="<?php echo $user_data['L_name']; ?>">   
                                </label>
                            </div>  
                            <div class="large-3  columns">
                                <label>Profile Pic
                                    <img src="img/pro_pic.png" width="40" height="40">
                                    <div class="custom_file_upload">
                                        <div class="file_upload">
                                            <input type="file" name="pro_pi" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26" value="<?php echo $user_data['Pro_pic']; ?>">
                                        </div>
                                    </div>
                                </label>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="large-6  columns">
                                <label>Physical Address
                                    <input style="border-color: greenyellow" name="phad" type="text" value="<?php echo $user_data ['Physical_add'] ?>">
                                </label>
                            </div>
                            <div class="large-6  columns">
                                <label>Contact Number
                                    <input style="border-color: greenyellow" name="cnu" type="text" value="<?php echo $user_data ['Contact_num'] ?>">
                                </label>
                            </div>
                        </div>
                        <div class="row">  

                            <div class="large-6 columns">
                                <label>Postal address
                                    <input style="border-color: greenyellow" name="pad" type="text" value="<?php echo $user_data ['Postal_add'] ?>">
                                </label>



                            </div>
                            <div class="large-6  columns">

                                <label>Username
                                    <input style="border-color: greenyellow" name="usernam" type="text" value="<?php echo $user_data ['Usern'] ?>">
                                </label>       

                            </div>
                        </div> 

                        <div class="row">
                            <div class="large-6  columns">
                                <div class="dropdown">
                                    <label>Password
                                        <input style="border-color: greenyellow" name="pas" type="text">
                                    </label>
                                </div>
                            </div>
                            <div class="large-6  columns">
                                <div class="dropdown">
                                    <label>Confirm Password
                                        <input style="border-color: greenyellow" name="confpas" type="text">
                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Edit Profile</button>
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