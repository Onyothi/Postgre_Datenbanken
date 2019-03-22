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
                <form method="post" action="editlive.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Edit Livestock</legend>
                        <?php
                        if (isset($_POST["Tagc"])) {
                            $Tagc = $_POST["Tagc"];
                            $Cname = $_POST["Name"];
                            $Ctype = $_POST["Type"];
                            $Csex = $_POST["sex"];
                            $Cfcode = $_POST["fcode"];
                            $Cmcode = $_POST["mcode"];
                            $Cbreed = $_POST["breed"];
                            $Cstatus = $_POST["status"];
                            $Cvet = $_POST["vet"];
                            $Cdob = $_POST["dob"];
                            $bname = $_FILES['photo']['name'];
                            $btemp = $_FILES['photo']['tmp_name'];
                            $tname = $_FILES['Tag']['name'];
                            $ttemp = $_FILES['Tag']['tmp_name'];

                            if (!empty($Tagc) && !empty($Cdob) && !empty($Cname) && !empty($Ctype) && !empty($Cstatus) && !empty($Csex) && !empty($Cbreed)) {
                                $us = $_SESSION['Code'];
                                if (!empty($bname) && !empty($tname)) {

                                    $uploadDir = "uploads/";
                                    $gen = generateKey();
                                    $gen2 = generateKey();
                                    $burl = $uploadDir . $gen . $bname;
                                    $turl = $uploadDir . $gen2 . $tname;
                                    move_uploaded_file($btemp, $burl);
                                    move_uploaded_file($ttemp, $turl);
                                    $ins = mysql_query(" UPDATE  `livestock` SET  `Tag_code`='$Tagc', `Name`='$Cname', `Type_n`='$Ctype',`Breed_n`='$Cbreed',`Sex`='$Csex',`D.O.B`='$Cdob', `Status`='$Cstatus', `Vet_num`='$Cvet',`M_tag`='$Cmcode',`F_tag`='$Cfcode',`Tag_pic`='$turl', `Body_pic`='$burl' WHERE `Owners_id`='$session_user_id' and `Tag_code`='$us'");
                                } else if (empty($bname) && empty($tname)) {

                                    $ins = mysql_query(" UPDATE  `livestock` SET  `Tag_code`='$Tagc', `Name`='$Cname', `Type_n`='$Ctype',`Breed_n`='$Cbreed',`Sex`='$Csex',`D.O.B`='$Cdob', `Status`='$Cstatus', `Vet_num`='$Cvet',`M_tag`='$Cmcode',`F_tag`='$Cfcode' WHERE `Owners_id`='$session_user_id' and `Tag_code`='$us'");
                                } else if (!empty($bname) && empty($tname)) {
                                    $uploadDir = "uploads/";
                                    $gen2 = generateKey();
                                    $burl = $uploadDir . $gen2 . $bname;
                                    move_uploaded_file($btemp, $burl);

                                    $ins = mysql_query(" UPDATE  `livestock` SET  `Tag_code`='$Tagc', `Name`='$Cname', `Type_n`='$Ctype',`Breed_n`='$Cbreed',`Sex`='$Csex',`D.O.B`='$Cdob', `Status`='$Cstatus', `Vet_num`='$Cvet',`M_tag`='$Cmcode',`F_tag`='$Cfcode',`Body_pic`='$burl' WHERE `Owners_id`='$session_user_id' and `Tag_code`='$us'");
                                } else if (empty($bname) && !empty($tname)) {
                                    $uploadDir = "uploads/";
                                    $gen2 = generateKey();
                                    $turl = $uploadDir . $gen2 . $bname;
                                    move_uploaded_file($ttemp, $turl);
                                    $ins = mysql_query(" UPDATE  `livestock` SET  `Tag_code`='$Tagc', `Name`='$Cname', `Type_n`='$Ctype',`Breed_n`='$Cbreed',`Sex`='$Csex',`D.O.B`='$Cdob', `Status`='$Cstatus', `Vet_num`='$Cvet',`M_tag`='$Cmcode',`F_tag`='$Cfcode',`Tag_pic`='$turl' WHERE `Owners_id`='$session_user_id' and `Tag_code`='$us'");
                                }

                                if (!$ins) {
                                    die('Could not edit data: ' . mysql_error());
                                } else {
                                    echo "Livestock Successfully edited";
                                }
                            } else {
                                echo"* fields can not be empty";
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="large-6  columns">
                                <label>Tag Code*
                                    <input style="border-color: greenyellow" name="Tagc" type="text" value="<?PHP
                        $id = $_SESSION['Code'];
                        $sql51 = "Select Tag_code,Body_pic,Tag_pic from livestock where Tag_code='$id'";
                        $result51 = mysql_query($sql51);
                        $row = mysql_fetch_array($result51);

                        echo $row['Tag_code']
                        ?>">
                                </label>
                            </div>
                            <div class="large-3  columns">
                                <label>Body Picture
                                    <img src="<?PHP echo $row['Body_pic'] ?>" width="100">
                                    <div class="custom_file_upload">
                                        <div class="file_upload">
                                            <input type="file" name="photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
                                        </div>
                                    </div>
                                </label>
                            </div>  
                            <div class="large-3  columns">
                                <label>Tag Picture
                                    <img src="<?PHP echo $row['Tag_pic'] ?>" width="100">
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
                                <label>Name*
                                    <input style="border-color: greenyellow" name="Name"type="text" value="<?PHP
                                           $id = $_SESSION['Code'];
                                           $sql51 = "Select Name from livestock where Tag_code='$id'";
                                           $result51 = mysql_query($sql51);
                                           $row = mysql_fetch_array($result51);

                                           echo $row['Name']
                        ?>">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <div class="dropdown">
                                    <label>Type*
                                        <select style="border-color: greenyellow" name="Type" >
                                            <option><?PHP
                                           $id = $_SESSION['Code'];
                                           $sql51 = "Select Type_n from livestock where Tag_code='$id'";
                                           $result51 = mysql_query($sql51);
                                           $row = mysql_fetch_array($result51);

                                           echo $row['Type_n']
                        ?></option>
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
                                    <label >Breed*
                                        <select style="border-color: greenyellow" name="breed">
                                            <option><?PHP
                                            $id = $_SESSION['Code'];
                                            $sql51 = "Select Breed_n from livestock where Tag_code='$id'";
                                            $result51 = mysql_query($sql51);
                                            $row = mysql_fetch_array($result51);

                                            echo $row['Breed_n']
                                            ?></option>
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
                            <div class="large-3 columns">
                                <label>Father's Tag Code
                                    <input style="border-color: greenyellow" name="fcode" type="text" value="<?PHP
                                            $id = $_SESSION['Code'];
                                            $sql51 = "Select F_tag from livestock where Tag_code='$id'";
                                            $result51 = mysql_query($sql51);
                                            $row = mysql_fetch_array($result51);

                                            echo $row['F_tag']
                                            ?>">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <label>Mother's Tag Code
                                    <input style="border-color: greenyellow" name="mcode" type="text" value="<?PHP
                                           $id = $_SESSION['Code'];
                                           $sql51 = "Select M_tag from livestock where Tag_code='$id'";
                                           $result51 = mysql_query($sql51);
                                           $row = mysql_fetch_array($result51);

                                           echo $row['M_tag']
                                            ?>">
                                </label>
                            </div>
                            <div class="large-6  columns">
                                <label>Date Of Birth*
                                    <input style="border-color: greenyellow" name="dob" type="Date" value="<?PHP
                                           $id = $_SESSION['Code'];
                                           $sql51 = "Select `D.O.B` from livestock where Tag_code='$id'";
                                           $result51 = mysql_query($sql51);
                                           $row = mysql_fetch_array($result51);

                                           echo $row['D.O.B']
                                            ?>">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Farm 
                                        <select style="background-color:  #aaa" name="farmm" disabled>
                                            <option>  <?PHP
                                           $id = $_SESSION['Code'];
                                           $sql51 = "Select Farm_id from livestock where Tag_code='$id'";
                                           $result51 = mysql_query($sql51);
                                           $row = mysql_fetch_array($result51);

                                           echo $row['Farm_id']
                                            ?></option></select>

                                    </label>
                                </div>
                            </div>
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Kraal:
                                        <select style="background-color:  #aaa" name="kraall" disabled><option> <?PHP
                                                $id = $_SESSION['Code'];
                                                $sql51 = "Select Kraal_id from livestock where Tag_code='$id'";
                                                $result51 = mysql_query($sql51);
                                                $row = mysql_fetch_array($result51);

                                                echo $row['Kraal_id']
                                            ?></option></select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-4  columns">
                                <div class="dropdown">
                                    <label>Sex*
                                        <select style="border-color: greenyellow" name="sex">
                                            <option><?PHP
                                                $id = $_SESSION['Code'];
                                                $sql51 = "Select Sex from livestock where Tag_code='$id'";
                                                $result51 = mysql_query($sql51);
                                                $row = mysql_fetch_array($result51);

                                                echo $row['Sex']
                                            ?></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </label>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="large-6  columns">
                                <div class="dropdown">
                                    <label>Status*
                                        <select style="border-color: greenyellow" name="status">
                                            <option><?PHP
                                                $idd = $_SESSION['Code'];
                                                $sql5 = "Select Status  from livestock where Tag_code='$idd'";
                                                $result5 = mysql_query($sql5);
                                                $row5 = mysql_fetch_array($result5);

                                                echo $row5['Status']
                                            ?></option>
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
                            <div class="large-6  columns">
                                <label>Vet Number* 
                                    <input style="border-color: greenyellow"  name="vet" type="text" value="<?PHP
                                                $id = $_SESSION['Code'];
                                                $sql51 = "Select Vet_num from livestock where Tag_code='$id'";
                                                $result51 = mysql_query($sql51);
                                                $row = mysql_fetch_array($result51);

                                                echo $row['Vet_num']
                                            ?>">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Edit livestock</button>
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
