i
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
                        error_reporting(0);
                        session_start();
                        require 'db_connect.php';
                        include 'Functions.php';
                        if (logged_in() === TRUE) {

                            $session_user_id = $_SESSION['user_id'];
                            $user_data = user_data($session_user_id, 'Name', 'Surname', 'Username', 'Gender', 'Contact_Number', 'Email_Address', 'Profile_Pic');
                            echo $user_data['Username'];
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
                    <li><a href="Home.php">Home</a></li>
                    <li class="divider"></li>
                    <li class="divider"></li>
                    <li><a href="Register.php">Register</a></li>
                    <li class="divider"></li>
                    <li><a href="login.php">Login</a></li>
                    <li class="divider"></li>
                    <li class="divider"></li>
                    <li><a href="Profile.php">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="Contact_Us.php">Contact_Us</a></li>


                </ul>
                </li>
                </ul>
            </section>
        </nav>
        <br>
        <div class="row"><div class="large-12 columns">                    
                <ul class="breadcrumbs right">
                    <li><a href="AddLivestock.php">View All Livestock</a></li>
                    
                    <li><a href="ViewSpecific.php">View Specific Livestock</a></li>
                    
                    <li><a href="AddLivestock.php">Add Livestock</a></li>

                    <li><a href="EditLivestock.php">Edit LiveStock</a></li>

                    <li><a href="ViewFarm.php">View Farm</a></li>

                    <li><a href="AddFarm.php">Add Farm</a></li>

                    <li><a href="EditFarm.php">Edit Farm</a></li>

                </ul> </div></div>
        <div class="row">
            <div class="large-12 columns">
                <form method="post" action="AddLivestock.php" enctype="multipart/form-data" id="899762552" >
                    <fieldset>
                        <legend >Adding Livestock</legend>
                        <?php
                        if (isset($_POST["code"]) && isset($_POST["lname"]) && isset($_POST["ltyp"]) && isset($_POST["slect2"]) && isset($_POST["Descrip"]) && isset($_POST["dob"])) {
                            $code = $_POST["code"];
                            $lname = $_POST["lname"];
                            $ltyp= $_POST["ltyp"];
                            $slect2 = $_POST["slect2"];
                            $Desc = $_POST["Descrip"];
                            $dat = $_POST["dob"];
                            $name = $_FILES['photo']['name'];
                            $temp = $_FILES['photo']['tmp_name'];
                            if ($name === null) {
                                $name = "pro_pic.jpg";
                            }
                            if (!empty($code) && !empty($lname) && $ltyp != "Select" && $slect2 != "Select" && !empty($Desc) && !empty($dat)) {
                                if (LiveSt_exists($code) === FALSE) {
                                    $uploadDir = "uploads/";
                                    $url = $uploadDir . $name;
                                    move_uploaded_file($temp, $url);
                                    $ins = Add_Livestock($code, $slect2, $url, $Desc,  $ltyp, $lname, $dat);
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
                                <label>Code_ID
                                    <input name="code" type="text">
                                </label>
                            </div>
                            <div class="large-6  columns">
                                <img src="img/pro_pic.png" width="40" height="40">
                                <div class="custom_file_upload">
                                    <div class="file_upload">
                                        <input type="file" name="photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row">  
                            <div class="large-6  columns">
                                <label>Name
                                    <input name="lname"type="text">
                                </label>
                            </div>
                            <div class="large-6  columns">
                                <div class="dropdown">
                                    <label>Type
                                        <select name="ltyp">
                                            <option>Select</option>
                                            <?php
                                            mysql_select_db("agrifarm");
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
                        </div> <div class="row">
                            <div class="large-6  columns">
                                <div class="dropdown">
                                    <label>Farm ID
                                        <select name="slect2">
                                            <option>Select</option>
                                            <?php
                                            mysql_select_db("agrifarm");
                                            $sql = "SELECT `ID`,`Farm_Name` FROM `farm`";
                                            $result = mysql_query($sql);
                                            while ($row = mysql_fetch_array($result)) {
                                                echo $Username = "<option value='" . $row['ID'] . "'>" . $row['Farm_Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="large-6  columns">
                                <label>Date Of Birth 
                                    <input name="dob" type="Date">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12  columns">
                                <label>Description
                                    <textarea name="Descrip" ></textarea> 
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
