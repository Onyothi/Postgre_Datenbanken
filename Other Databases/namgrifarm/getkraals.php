<?php
session_start();
include 'db_connection.php';
if($_POST['name'])
{
mysql_select_db("namagrifarm");
$id=$_POST['name'];

$sql=mysql_query("Select `Kraal_id`,`Name` FROM `kraal` where `Farm_id`='$id'");
while($row=  mysql_fetch_array($sql))
{
$id=$row['Kraal_id'];
$data=$row['Name'];
echo '<option value="' . $id . '">' . $data . '</option>';


}
} 
?>