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

        <!-- End Mobile Header -->


        <div class="row">


            <div class="large-12 columns">
                <form method="post" action="viewall.php" >
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >All Livestock View</legend>

                        <div class="row">
                            <div class="large-6 columns">
                                <label for="Code">Farm: </label>
                                <select name="Code" id="Code">
                                    <option>Please select</option>
<?php
$us = $session_user_id;
$sql = "SELECT `Reg_num`,`Name` FROM `farms` Where `Owners_id`='$us'";
$resultt = mysql_query($sql);
while ($row2 = mysql_fetch_array($resultt)) {
    echo $Username = "<option value='" . $row2['Reg_num'] . "'>" . $row2['Name'] . "</option>";
}
?>
                                </select>    
                            </div>
                            <div class="large-6 columns">
                                <label for="Type">Type: </label>
                                <select name="Type" id="Type">
                                    <option>Please select</option>
<?php
$query = "SELECT `Name` from `type`";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
    echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
}
?>
                                </select>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-4 columns">
                                <a href="#6y" ><button class="button tiny" name="View" type="submit" value="Submit">View</button></a> 
                            </div>
                        </div>
<?php
if (isset($_POST["Code"]) && isset($_POST["Type"])) {
    $Code = $_POST["Code"];
    $Type = $_POST["Type"];

    if ($Code != "Please select" && $Type != "Please select") {
        $sqll = "SELECT `Tag_code`, `Name`,`Breed_n`, `M_tag`,`F_tag`, `Farm_id`,`Sex`,`Body_pic`,`Tag_pic`,`D.O.B`,`Kraal_id`, `Reg_date`, `Vet_num`, `Status` from `livestock` Where Farm_id='$Code' and Type_n='$Type'";
        $ins = mysql_query($sqll);

        if (!$ins) {
            die("erro");
        } else {
            ?><div class="row">
                                        <div class="large-4 columns">
                                            <H4>Picture</H4>
                                        </div>
                                        <div class="large-8 columns" style="border-left: 3px solid black;">
                                            <H4>Details</H4>
                                        </div>

                                    </div>
            <?php
            while ($row3 = mysql_fetch_array($ins)) {
                ?>
                                        <div class="row" style="border-bottom: 3px solid black;border-top: 3px solid black;border-left: 3px solid black;border-right: 3px solid black;"> 
                                            <div class=" large-4 columns">  
                                                <img src="<?php echo $row3['Body_pic'] ?>" width="300" height="100"> 
                                                <br>
                                            </div> 
                                            <div class="large-8 columns" style="border-left: 3px solid black;">  
                                                <li><?php echo "Tag Code: " . $row3['Tag_code'] ?></li>
                                                <li><img src="<?php echo $row3['Tag_pic'] ?>" width="40" height="40"> </li>
                                                <li><?php echo "Name: " . $row3['Name'] ?></li>
                                                <li><?php echo "Breed: " . $row3['Breed_n'] ?></li>
                                                <li><?php echo "Gender: " . $row3['Sex'] ?></li>
                                                <li><?php echo "Mother's Tag: " . $row3['M_tag'] ?></li>
                                                <li><?php echo "Father's: " . $row3['F_tag'] ?></li>
                                                <li><?php echo "Farm regitsration number: " . $row3['Farm_id'] ?></li>
                                                <li><?php echo "Status: " . $row3['Status'] ?></li>
                                                <li><?php echo "DOB: " . $row3['D.O.B'] ?></li>  
                                            </div> 
                                        </div>
                                        <br>
                <?php
            }
        }
    } else {
        print "<font color='red'>All fields are required";
    }
}
?>
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
