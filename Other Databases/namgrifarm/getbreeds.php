<?php
session_start();
include 'db_connection.php';
if($_POST['name'])
{
mysql_select_db("namagrifarm");
$id=$_POST['name'];

$sql=mysql_query("Select `Breed_id`,`Name` FROM `breed` where `Type_n`='$id'");
while($row=  mysql_fetch_array($sql))
{
$id=$row['Breed_id'];
$data=$row['Name'];
echo '<option value="' . $data . '">' . $data . '</option>';


}
} 
?>