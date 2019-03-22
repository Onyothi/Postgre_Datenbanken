<?php
session_start();
require 'db_connection.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/foundation.css" />
        <script src="../js/vendor/modernizr.js"></script>
        <script src="js/foundation/foundation.slider.js"></script>
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
        <br>
        <div class="row">
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
                <form method="post" action="editkraal.php" enctype="multipart/form-data" id="899762552">
                    <fieldset>
                        <legend >Edit Kraal</legend>
                        <?php
                        if (isset($_POST["Name"]) && isset($_POST["Kraal_id"]) && isset($_POST["slect2"])) {

                            $Name = $_POST["Name"];
                            $Kraal_id = $_POST["Kraal_id"];
                            $Farm_id = $_POST["slect2"];
                            $kid = $_SESSION['Reg_num3'];


                            if (!empty($Name) && !empty($Kraal_id) && !empty($Farm_id)) {
                                mysql_select_db("namagrifarm");
                                $sqll = " UPDATE  `kraal` SET  `Name`='$Name', `Kraal_id`='$Kraal_id', `Farm_id`='$Farm_id' WHERE `kraal_id`='$kid '";
                                $ins = mysql_query($sqll);


                                if (!$ins) {
                                    die('Could not enter data: ' . mysql_error());
                                } else {
                                    echo "Kraal Successfully Edited";
                                }
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="large-4  columns">
                                <label>Name*

                                    <input name="Name" type="text" value="<?php
                        $kid = $_SESSION['Reg_num3'];
                        $sql = mysql_query("select Farm_id,Kraal_id,Name from kraal where Kraal_id ='$kid'");
                        $row = mysql_fetch_array($sql);
                        echo $row['Name']
                        ?>">
                                </label>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="large-4  columns">
                                <label>Farm Name*

                                    <select name="slect2"> 
                                        <?php
                                        $kid = $_SESSION['Reg_num3'];
                                        $sql = mysql_query("select Farm_id,Kraal_id,Name from kraal where Kraal_id ='$kid'");
                                        $row = mysql_fetch_array($sql);
                                        $kid2 = $row['Farm_id'];
                                        $sql2 = mysql_query("SELECT Name, Reg_num from farms where Reg_num ='$kid2'");
                                        $row2 = mysql_fetch_array($sql2);
                                        echo "<option value='" . $row2['Reg_num'] . "'>" . $row2['Name'] . "</option>";
                                        ?>
                                        <?php
                                        mysql_select_db("namagrifarm");
                                        $sql = "SELECT `Reg_num`,`Name` FROM `farms` WHERE `Owners_id`='$session_user_id'";
                                        $result = mysql_query($sql);
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['Reg_num'] . "'>" . $row['Name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </label>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="large-4  columns">
                                <label>Kraal_id*
                                    <input name="Kraal_id" type="text" value="<?php
                                        $kid = $_SESSION['Reg_num3'];
                                        $sql = mysql_query("SELECT Farm_id,Kraal_id,Name from kraal where Kraal_id ='$kid'");
                                        $row = mysql_fetch_array($sql);
                                        echo $row['Kraal_id']
                                        ?>" >
                                </label>
                            </div>
                        </div>



                        <div class="row">
                            <div class="large-4  columns">
                                <button name="submit" type="submit" value="Submit">Save Changes</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
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
