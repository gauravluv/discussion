<?php
$showerror='false';
 

$method=$_SERVER['REQUEST_METHOD'];
if($method=="POST"){
    include "dbconnect.php";
    $email=$_POST['signupemail'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    // check whether this email exist

    $existsql="SELECT * FROM `users` WHERE user_email='$email' ";
    $result=mysqli_query($conn,$existsql);

    $numrow=mysqli_num_rows($result);
    if($numrow >0){
        $showerror="email in already use";
        // $showerror=true;
    }else{
                if($pass==$cpass){
                    // using password hash for strong password 
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                 $sql="INSERT INTO `users` ( `user_email`, `user_password`, `timestamp`) VALUES ( '$email', '$hash', current_timestamp());";
                 $result=mysqli_query($conn,$sql);
                            if($result){
                                $showalert=true;

                            // redirect home page

                              header("Location:/onlineforum/index.php?signupsuccess=true");
                              exit();
                            }

                    }else{
                        $showerror="password does not match";
                        // $showerror=true;
                         
                    }
          }
 

           header("Location:/onlineforum/index.php?singupsuccess=false$error=$showerror");
          

}
 









?>