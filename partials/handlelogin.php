<?php
 
 $method=$_SERVER['REQUEST_METHOD'];
//  echo $method;

if($method=="POST"){

    include "dbconnect.php";

    $email=$_POST['loginemail'];
    $pass=$_POST['loginpass']; 

    $sql="SELECT * FROM users WHERE user_email='$email'";
    $result=mysqli_query($conn,$sql);

    $numrow=mysqli_num_rows($result);
    if($numrow==1){
      $row=mysqli_fetch_assoc($result);

                        if(password_verify($pass,$row['user_password'])){
                            session_start();
                            $_SESSION['loggedin']=true;
                            $_SESSION['useremail']=$email;
                            // echo 'logged in:' .$email;
                            header("Location:/onlineforum/index.php?loginsuccess=true");
                            exit();
                            


                        }
                         header("Location:/onlineforum/index.php");
                            // echo 'unable to login';
       }

       

       header("Location:/onlineforum/index.php");


}


?>