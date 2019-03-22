<?PHP
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
        <script src="../js/vendor/modernizr.js"></script>
        <script src="js/foundation/foundation.slider.js"></script>
        <title></title>
    </head>

    <body>
        <nav class="top-bar" data-topbar="">
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
                </li>
                </ul>
            </section>
        </nav>
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
                                            <li><a href="move_history.php">move history</a></li>
                                            <li><a href="status_history.php">status history</a></li>
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
                <form method="post" action="addkraal.php">
                    <fieldset style="background-color: #f4f4f4 ; box-shadow:  #aaa">
                        <legend >Add Kraal</legend>
                        <?php
                        if (isset($_POST["name"]) && isset($_POST["farmn"]) && isset($_POST["k_id"])) {
                            $Name = $_POST["name"];
                            $Farm_id = $_POST["farmn"];
                            $Kraal_id = $_POST["k_id"];

                            if (!empty($Name) && $Farm_id != "Select" && !empty($Kraal_id)) {
                                if (kraal_exists($Kraal_id) === FALSE) {

                                    $ins = Add_kraal($Name, $Farm_id, $Kraal_id);

                                    if (!$ins) {
                                        die('Could not enter data: ' . mysql_error());
                                    } else {
                                        echo "Kraal Successfully Added";
                                    }
                                } else {
                                    echo "That Kraal is already registerd";
                                }
                            } else {
                                echo"All fields are required";
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="large-6  columns">
                                <label>Kraal ID
                                    <input name="k_id" type="text">
                                </label>
                            </div>

                        </div>
                        <div class="row">  
                            <div class="large-6  columns">
                                <label>Name
                                    <input name="name"type="text">
                                </label>
                            </div>

                        </div> 
                        <div class="row">

                            <div class="large-6  columns">
                                <label>Farm Name
                                    <select name="farmn">
                                        <option>Select</option>
                                        <?php
                                        mysql_select_db("namagrifarm");
                                        $sql22 = "SELECT `Reg_num`, `Name` FROM `farms` where Owners_id='$session_user_id'";
                                        $result22 = mysql_query($sql22);
                                        while ($row = mysql_fetch_array($result22)) {
                                            echo $Username = "<option value='" . $row['Reg_num'] . "'>" . $row['Name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="large-4  columns">
                                <button name="Submit" type="submit" value="Submit">Add kraal</button>
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
        </script><script src="js/vendor/zepto.js"></script>
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
