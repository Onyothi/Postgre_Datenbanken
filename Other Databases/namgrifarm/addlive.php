 <?php
require 'db_connection.php';
include 'functions.php';
session_start();
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
                    <li><a href="Register.php">Register</a></li>
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
            </div>
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
                <form method="post" action="addlive.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Adding Livestock</legend>
                        <?php
                        if (isset($_POST["Tagc"]) && isset($_POST["Name"]) && isset($_POST["Type"]) && isset($_POST["sex"]) && isset($_POST["fcode"]) && isset($_POST["farm"]) && isset($_POST["kraal"]) && isset($_POST["breed"]) && isset($_POST["status"]) && isset($_POST["dob"]) && isset($_POST["vet"])) {
                            $Tagc = $_POST["Tagc"];
                            $Cname = $_POST["Name"];
                            $Ctype = $_POST["Type"];
                            $Csex = $_POST["sex"];
                            $Cfcode = $_POST["fcode"];
                            $Cfarm = $_POST["farm"];
                            $Ckraal = $_POST["kraal"];
                            $Cbreed = $_POST["breed"];
                            $Cstatus = $_POST["status"];
                            $Cvet = $_POST["vet"];
                            $Cdob = $_POST["dob"];
                            $bname = $_FILES['photo']['name'];
                            $btemp = $_FILES['photo']['tmp_name'];
                            if ($bname === null) {
                                $bname = "pro_pic.jpg";
                            }
                            $tname = $_FILES['Tag']['name'];
                            $ttemp = $_FILES['Tag']['tmp_name'];
                            if ($tname === null) {
                                $tname = "pro_pic.jpg";
                            }
                            if (!empty($Tagc )  &&!empty($Cdob) &&!empty($Cname) && $Ctype != "Select" && $Cstatus != "Sellect" && $Csex != "Select" && Cfarm != "Select" && Ckraal!= "Select" && $Cbreed!= "Select") {
                                if (LiveSt_exists($Tagc,$session_user_id) === FALSE) {
                                    $uploadDir = "uploads/";
                                    $gen=generateKey();
                                    $gen2=generateKey();
                                    $burl = $uploadDir . $gen . $bname;
                                    $turl = $uploadDir . $gen2 . $tname;
                                    move_uploaded_file($btemp, $burl);
                                    move_uploaded_file($ttemp, $turl);
                                    $mtag=$_SESSION['Mtag'];
                                    
                                    $reg=date("Y.m.d");
                                    $ins = Add_Livestock($Tagc, $Cname, $Ctype, $Csex, $Cfcode, $Cfarm, $Ckraal, $Cbreed, $Cstatus, $Cvet, $session_user_id, $Cdob, $burl, $turl,$mtag,$reg );
                                    if (!$ins) {
                                        die('Could not enter data: ' . mysql_error());
                                    } else {
                                        echo "Livestock Successfully Added";
                                    }
                                } else {
                                    echo "That Livestock is already registerd";
                                }
                            } else {
                                echo"All fields are required";
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="large-6  columns">
                                <label>Tag Code
                                    <input name="Tagc" type="text">
                                </label>
                            </div>
                            <div class="large-3  columns">
                                <label>Body Picture
                                    <img src="img/pro_pic.png" width="40" height="40">
                                    <div class="custom_file_upload">
                                        <div class="file_upload">
                                            <input type="file" name="photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
                                        </div>
                                    </div>
                                </label>
                            </div>  
                            <div class="large-3  columns">
                                <label>Tag Picture
                                    <img src="img/pro_pic.png" width="40" height="40">
                                    <div class="custom_file_upload">
                                        <div class="file_upload">
                                            <input type="file" name="Tag" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
                                        </div>
                                    </div>
                                </label>
                            </div> 
                        </div>
                        <div class="row">  
                            <div class="large-6  columns">
                                <label>Name
                                    <input name="Name"type="text">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <div class="dropdown">
                                    <label>Type
                                        <select name="Type">
                                            <option>Select</option>
                                            <?php
                                            mysql_select_db("namagrifarm");
                                            $sql22 = "SELECT `Name` FROM `type`";
                                            $result22 = mysql_query($sql22);
                                            while ($row = mysql_fetch_array($result22)) {
                                                echo $Username = "<option value='" . $row['Name'] . "'>" . $row['Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-3  columns">
                                <div class="dropdown">
                                    <label>Sex
                                        <select name="sex">
                                            <option>Select</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="large-6  columns">
                                <label>Father's Tag Code
                                    <input name="fcode" type="text" value="">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Farm 
                                        <select name="farm">
                                            <option>Select</option>
                                            <?php
                                            mysql_select_db("namagrifarm");
                                            $sql = "SELECT `Reg_num`,`Name` FROM `farms` where `Owners_id`='$session_user_id'";
                                            $result = mysql_query($sql);
                                            while ($row = mysql_fetch_array($result)) {
                                                echo $Username = "<option value='" . $row['Reg_num'] . "'>" . $row['Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Kraal
                                        <select name="kraal">
                                            <option>Select</option>
                                            <?php
                                            mysql_select_db("namagrifarm");
                                            $sql4 = "SELECT `Kraal_id`,`Name` FROM `kraal`";
                                            $result4 = mysql_query($sql4);
                                            while ($row = mysql_fetch_array($result4)) {
                                                echo "<option value='" . $row['Kraal_id'] . "'>" . $row['Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Breed
                                        <select name="breed">
                                            <option>Select</option>
                                            <?php
                                            mysql_select_db("namagrifarm");
                                            $sql4 = "SELECT `Breed_id`,`Name` FROM `breed`";
                                            $result4 = mysql_query($sql4);
                                            while ($row = mysql_fetch_array($result4)) {
                                                echo "<option value='" . $row['Name'] . "'>" . $row['Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Status 
                                        <select name="status">
                                            <option>Select</option>
                                            <option>Sick</option>
                                            <option>Healthy</option>
                                            <option>Pregnant but Sick</option>
                                            <option>healthy & Ready to move</option>
                                            <option>Healthy & Pregnant</option>
                                            <option>Healthy Ready to move but Pregnant</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-4  columns">
                                <label>Date Of Birth 
                                    <input name="dob" type="Date">
                                </label>
                            </div>
                            <div class="large-4  columns">
                                <label>Vet Number 
                                    <input name="vet" type="text">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Add livestock</button>
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
