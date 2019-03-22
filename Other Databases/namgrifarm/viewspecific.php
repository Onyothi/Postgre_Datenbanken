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
        <script src="js/jquery.js"></script>

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
                <form method="post" action="ViewSpecific.php">
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Livestock View</legend>

                        <div class="row">
                            <div class="large-6 columns">
                                <label>Tag Code: </label>
                                <input name="Code" type="text">
                            </div>
                            <div class="large-6 columns">
                                <label for="Type">Type: </label>
                                <select name="Type" id="Type">
                                    <option>Please select</option>
                                    <?php
                                    mysql_select_db("namagrifarm");
                                    $query = "SELECT `Name` from `type`";
                                    $result5 = mysql_query($query);
                                    while ($row = mysql_fetch_assoc($result5)) {
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

                            if (!empty($Code) && $Type != "Please select") {
                                if (LiveSt_exists($Code, $session_user_id) === TRUE) {
                                    $sqll = "SELECT `Tag_code`,`Name`,`Type_n`,`Breed_n`,`Sex`,`D.O.B`,`Status`,`Vet_num`, `M_tag`,`F_tag`, `Owners_id`, `Farm_id`, `Tag_pic`, `Body_pic`, `Kraal_id`, `Reg_date`,`R.O.T`,`D.O.T` FROM `livestock` Where `Tag_code`='$Code' and `Type_n`='$Type'";
                                    $ins = mysql_query($sqll);
                                    $row = mysql_fetch_assoc($ins);
                                    $_SESSION['Mtag'] = $row['M_tag'];
                                    if (!$ins) {
                                        die("erro");
                                    } else {
                                        ?>
                                        <div class="row"> 
                                            <div class="large-1 columns">  

                                            </div>
                                            <div class="large-8 columns" style="border-right: 3px solid black;">  
                                                <img id="img1" src="<?php echo $row['Body_pic'] ?>" width="700" > 
                                                <br>
                                            </div>
                                            <div class="large-3 columns"  style="alignment-adjust: central ">  
                                                <li><?php echo "Tag Code: " . $row['Tag_code'] ?></li>
                                                <li><img src="<?php echo $row['Tag_pic'] ?>" width="40" height="40"> </li>
                                                <li><?php echo "Name: " . $row['Name'] ?></li>
                                                <li><?php echo "Breed: " . $row['Breed_n'] ?></li>
                                                <li><?php echo "Gender: " . $row['Sex'] ?></li>
                                                <li><?php echo "Mother's Tag: " . $row['M_tag'] ?></li>
                                                <li><?php echo "Father's Tag: " . $row['F_tag'] ?></li>
                                                <li><?php echo "Farm regitsration number: " . $row['Farm_id'] ?></li>
                                                <li><?php echo "Status: " . $row['Status'] ?></li>
                                                <li><?php echo "DOB: " . $row['D.O.B'] ?></li>  

                                            </div> 
                                        </div>
                                        <br>
                                        <div class="large-2 columns">

                                        </div> 
                                        <div class="large-10 columns">
                                            <div class="row">
                                                <div class="small-3 columns">
                                                    <a href="#" data-reveal-id="MotherModal" class="radius button tiny">View Mother</a>
                                                    <div id="MotherModal" class="reveal-modal" data-reveal>
                                                        <div class="large-12 columns" style="alignment-adjust: central">
                                                            <?php
                                                            $mum1 = $row['M_tag'];
                                                            $sqll2 = "SELECT `Tag_code`,`Name`,`Type_n`,`Breed_n`,`Sex`,`D.O.B`,`Status`,`Vet_num`, `M_tag`,`F_tag`, `Owners_id`, `Farm_id`, `Tag_pic`, `Body_pic`, `Kraal_id`, `Reg_date`,`R.O.T`,`D.O.T` FROM `livestock` Where `Tag_code`='$mum1'";
                                                            $ins2 = mysql_query($sqll2);
                                                            $row2 = mysql_fetch_assoc($ins2);
                                                            if (!$ins2) {
                                                                die("erro");
                                                            }
                                                            ?>
                                                            <img src="<?php echo $row2['Body_pic']; ?>" width="300" height="80"> 
                                                            <br>
                                                            <?php echo"Tag Code: " . $row2['Tag_code'] . '  |  ' . "Name: " . $row2['Name'] . '  |  ' . "Farm ID: " . $row2['Farm_id'] . '  |  ' . "Status: " . $row2['Status'] . '  |  ' . "D.O.B: " . $row2['D.O.B'] . '  ' ?>  
                                                        </div> 
                                                    </div>
                                                </div> 
                                                <div class="small-3 columns">
                                                    <a href="#" data-reveal-id="FatherModal" class="radius button tiny">View Father</a>
                                                    <div id="FatherModal" class="reveal-modal" data-reveal>
                                                        <div class="large-12 columns" style="alignment-adjust: central">
                                                            <?php
                                                            $Fath = $row['F_tag'];
                                                            $sqll22 = "SELECT `Tag_code`,`Name`,`Type_n`,`Breed_n`,`Sex`,`D.O.B`,`Status`,`Vet_num`, `M_tag`,`F_tag`, `Owners_id`, `Farm_id`, `Tag_pic`, `Body_pic`, `Kraal_id`, `Reg_date`,`R.O.T`,`D.O.T` FROM `livestock` Where `Tag_code`='$Fath'";
                                                            $ins22 = mysql_query($sqll22);
                                                            $row22 = mysql_fetch_assoc($ins22);
                                                            if (!$ins22) {
                                                                die("erro");
                                                            }
                                                            ?>
                                                            <img src="<?php echo $row22['Body_pic']; ?>" width="300" height="80"> 
                                                            <br>
                                                            <?php echo"Tag Code: " . $row22['Tag_code'] . '  |  ' . "Name: " . $row22['Name'] . '  |  ' . "Farm ID: " . $row22['Farm_id'] . '  |  ' . "Status: " . $row22['Status'] . '  |  ' . "D.O.B: " . $row22['D.O.B'] . '  ' ?>  
                                                        </div> 
                                                    </div>
                                                </div> 
                                                <div class="small-3 columns">
                                                    <a href="#" data-reveal-id="VFTModal" class="radius button tiny">View Family Tree</a>
                                                    <div id="VFTModal" class="reveal-modal" data-reveal  >
                                                        <div class="large-12 columns">

                                                            <?php
                                                            $mum = $row['M_tag'];
                                                            While (!empty($mum)) {
                                                                ?>
                                                                <br>
                                                                <img src="img/arrows.png" width="10" height="10">
                                                                <br>
                                                                <?php
                                                                $sqll23 = "SELECT `Tag_code`,`Name`,`Type_n`,`Breed_n`,`Sex`,`D.O.B`,`Status`,`Vet_num`, `M_tag`,`F_tag`, `Owners_id`, `Farm_id`, `Tag_pic`, `Body_pic`, `Kraal_id`, `Reg_date`,`R.O.T`,`D.O.T` FROM `livestock` Where `Tag_code`='$mum'";
                                                                $ins23 = mysql_query($sqll23);
                                                                $row23 = mysql_fetch_assoc($ins23);
                                                                if (!$ins23) {
                                                                    die("erro");
                                                                }
                                                                ?>
                                                                <img src="<?php echo $row2['Body_pic']; ?>" width="100" height="80"> 
                                                                <br>
                                                                <?php
                                                                echo"Tag Code: " . $row23['Tag_code'] . '  |  ' . "Name: " . $row23['Name'] . '  |  ' . "Farm ID: " . $row23['Farm_id'] . '  |  ' . "Status: " . $row23['Status'] . '  |  ' . "D.O.B: " . $row23['D.O.B'];
                                                                $mum = $row23['MCode_ID'];
                                                            }
                                                            ?>  
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="small-3 columns">
                                                    <a href="addlive.php"class="radius button tiny">Add Young One</a>

                                                </div>
                                            </div>

                                            <?php
                                        }
                                    } else {
                                        die("<font color='red'>livestocks with that code does not exists");
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
