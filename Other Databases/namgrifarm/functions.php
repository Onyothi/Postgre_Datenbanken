<?php

function Add_FarmOwner($usernam, $fname, $sname, $url, $password_hash, $userid, $dor) {
    $db_host = "localhost";
    $db_username = "root";
    $db_pass = "";
    $conn = mysql_connect("$db_host", "$db_username", "$db_pass");
    mysql_select_db("namagrifarm");
    $sqll = " INSERT INTO owners" . "(Usern, F_name, L_name,Pro_pic, Pass, Owners_id, `D.O.R`)" . "value" . "('$usernam','$fname','$sname','$url','$password_hash','$userid', '$dor')";
    $test = mysql_query($sqll, $conn);
    return $test;
}

function Add_Farm($fname, $Reg_Number, $location, $session_user_id) {
    $db_host = "localhost";
    $db_username = "root";
    $db_pass = "";
    $conn = mysql_connect("$db_host", "$db_username", "$db_pass");
    mysql_select_db("namagrifarm");
    $sqll = " INSERT INTO farms" . "(Owners_id,Name, Physical_address, Reg_num)" . "value" . "('$session_user_id','$fname','$location','$Reg_Number')";
    $test = mysql_query($sqll, $conn);
    return $test;
}
function Add_Livestock($Tagc, $Cname, $Ctype, $Csex, $Cfcode, $Cfarm, $Ckraal, $Cbreed, $Cstatus, $Cvet, $session_user_id,$Cdob, $burl, $turl,$mtag, $reg) {
    $db_host = "localhost";
    $db_username = "root";
    $db_pass = "";
    $conn = mysql_connect("$db_host", "$db_username", "$db_pass");
    mysql_select_db("namagrifarm");
    $sqll = " INSERT INTO livestock" . "(Tag_code,Name, Type_n, Breed_n, Sex, `D.O.B`, Status, Vet_num, M_tag, F_tag, Owners_id, Farm_id ,Tag_pic, Body_pic, Kraal_id,Reg_date)" . "value" . "('$Tagc','$Cname', '$Ctype', '$Cbreed','$Csex','$Cdob','$Cstatus', '$Cvet','$mtag', '$Cfcode','$session_user_id','$Cfarm','$turl','$burl', '$Ckraal','$reg')";
    $test = mysql_query($sqll, $conn);
    return $test;
}

function user_data($user_id) {

    $data = array();

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1) {
        unset($func_get_args[0]);

        $fields = '`' . implode('`,`', $func_get_args) . '`';
        $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `owners` WHERE `Owners_id`= $user_id"));
        return $data;
    }
}

function logged_in() {

    return (isset($_SESSION['user_id'])) ? true : false;
}
function redirect() {

    return header('location:regtwo.php');
}

function user_exists($Owners_id) {

    $query1 = mysql_query("SELECT COUNT(`Owners_id`) FROM `owners` WHERE `Owners_id` ='$Owners_id'");

    return(mysql_result($query1, 0) == 1) ? TRUE : FALSE;
}
function user_exists2($Owners_id) {

    $query1 = mysql_query("SELECT COUNT(`Usern`) FROM `owners` WHERE `Usern` ='$Owners_id'");

    return(mysql_result($query1, 0) == 1) ? TRUE : FALSE;
}

function farm_exists($Reg) {

    $query1 = mysql_query("SELECT COUNT(`Reg_num`) FROM `farms` WHERE `Reg_num` ='$Reg'");
    return(mysql_result($query1, 0) == 1) ? TRUE : FALSE;
}
function LiveSt_exists($Code, $user_id) {
 
    $query1 = mysql_query("SELECT COUNT(`Tag_code`) FROM `livestock` WHERE `Tag_code` ='$Code' and `Owners_id`='$user_id'");
    return(mysql_result($query1, 0) == 1) ? TRUE : FALSE;
}

function user_id_from_username($usernam) {

    return mysql_result(mysql_query("SELECT `Owners_id` FROM `owners` WHERE `Usern` ='$usernam'"), 0, 'Owners_id');
}

function login($usernam, $pass) {

    $user_id = user_id_from_username($usernam);
    $pass = md5($pass);
    return (mysql_result(mysql_query("SELECT COUNT(`Owners_id`) FROM `owners` WHERE `Usern` ='$usernam' AND `Pass`='$pass'"), 0) == 1) ? $user_id : FALSE;
}

function output_errors($errors) {
    $output = array();
    foreach ($errors as $error) {

        $output[] = '<li>' . $error . '</li>';
    }
    return'<ul>' . implode('', $output) . '</li>';
}

function Add_Kraal($Name, $Farm_id,$Kraal_id) {
    $db_host = "localhost";
    $db_username = "root";
    $db_pass = "";
    $conn = mysql_connect("$db_host", "$db_username", "$db_pass");
    mysql_select_db("namagrifarm");
    $sqll = " INSERT INTO kraal" . "(Name, Kraal_id, Farm_id)" . "value" . "('$Name','$Kraal_id','$Farm_id')";
    $test = mysql_query($sqll, $conn);
    return $test;
	}
        
function kraal_exists($Kraal_id) {

    $query1 = mysql_query("SELECT COUNT(`Kraal_id`) FROM `kraal` WHERE `Kraal_id` ='$Kraal_id'");
    return(mysql_result($query1, 0) == 1) ? TRUE : FALSE;
}

function generateKey($Len = 10) {     
	$AllChars = '01234ABCDEFGHIJKLNMOPQRSTUVWXYZabcdefghijklnmopqrstuvwxyz56789_'; 
	$String = ''; 
	mt_srand((double)microtime() * 1000000); 
	for ($i = 0; $i < $Len; $i++) { 
	  $String .= $AllChars{mt_rand(0, strlen($AllChars) - 1)}; 
	}
	return $String;    
}
?>
