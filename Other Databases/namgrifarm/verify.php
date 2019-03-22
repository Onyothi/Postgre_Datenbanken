<?php
session_start();

if (empty($_POST)=== FALSE){
    $usernam=$_POST['usernam'];
    $pass=$_POST['pass'];
  
   if (empty($usernam)=== true||empty($pass)=== true){
      
    $errors[]='Enter username and password';  
       
   } elseif (user_exists2($usernam)===false) {
    $errors[]='There username you enterd does not exist';
  }else {
      $login=login($usernam, $pass);
      if($login===false){
          $errors[]='Incorrect username OR Password';
      }
      
      else{
         $_SESSION['user_id']=$login;
         $_SESSION['usern']=$usernam;
         header("Location: profile.php");
      }
  }

    if(!empty($errors )){
        print "<font color='red'>".output_errors($errors);}
}
?>
