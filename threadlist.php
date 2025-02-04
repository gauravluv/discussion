<!-- starter template-->

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>welcome to idiscuss-coding forum</title>
        <style>
        #ques {
            min-height: 433px;
        }

        </style>

    </head>


    <body>

        <!--nav bar -->

        <?php include "partials/header.php"; ?>

    
        <!--db connect -->
        <?php include "partials/dbconnect.php"; ?>


        <!-- fetching categories by dyanamic-->

        <?php
                    $id=$_GET['catid'];
                    $sql="SELECT * FROM `categories` WHERE category_id=$id";
                    $result=mysqli_query($conn,$sql);

                    while($row=mysqli_fetch_assoc($result)){
                        $catname=$row['category_name'];
                        $catdesc=$row['category_description'];

                    }

                ?>

        <?php

             $showalert=false;
             $method=$_SERVER['REQUEST_METHOD'];
             if ($method=='POST'){
                 // insert into thread into db

                 $th_title=$_POST['title'];
                 $th_desc=$_POST['desc'];

                 $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `thread_time`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp());";
                 $result=mysqli_query($conn,$sql);
                 $showalert=true;

             }

             if($showalert){

                echo '<div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">SUCCESS!</h4>
                            <p>Your Thread has been added!Please Wait for Community to Respond</p>
                     </div>';
                }
           

           ?>


        <!-- jumbotron -->

        <div class="container">

            <div class="jumbotron">
                <h1 class="display-4">Welcome To <?php echo $catname;?> Forum</h1>
                <p class="lead"> <?php echo $catdesc;?></p>

                <!-- forum rule -->

                <hr class="my-4">
                <p>
                    This is peer to peer is for sharing knowledge each other.
                    No Spam / Advertising / Self-promote in the forums not allowed.
                    Do not post copyright-infringing material.
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                    Do not PM users asking for help.
                    Remain respectful of other members at all times.

                </p>
                <a class="btn btn-success btn-lg" href="https://ctl.wiley.com/sample-discussion-board-ground-rules/"
                    role="button">Learn more</a>
            </div>


            <!-- ask question -->
   
            <?php


       
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

            echo '<div class="container">

                <h1 class="py-2">START DISCUSSION</h1>

                <!-- form REQUEST URI DOCUMENTATION -->
                <form action= " ' .$_SERVER["REQUEST_URI"] . '"  method="post">
                     

                    <div class="form-group">
                        <label for="title">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Keep your Title short and crisp as
                            possible.</small>
                    </div>

                    <!-- textarea -->

                    <div class="form-group">
                        <label for="desc">Ellaborate your concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>';
            }else{

                echo '<div><h3>START DISCUSSION </h3> </div>';

                echo  '<div class="alert alert-danger" role="alert">
                   <h1>you are not loggedin!</h1>
                    <p>please loggedin to start discussion.</p>
                 </div>';
            }

            ?>



            <!-- browse question asked by student -->

            <div class="container" id="ques">

                <h1 class="py-2">Browse Question </h1>

                <!--  fetching question in dynamically -->

                <?php
                    $id=$_GET['catid'];
                    $sql=" SELECT * FROM `threads` WHERE thread_cat_id=$id";
                    $result=mysqli_query($conn,$sql);
                    $noresult=true;

                    while($row=mysqli_fetch_assoc($result)){
                        $noresult=false;
                        $id=$row['thread_id'];
                        $title=$row['thread_title'];
                        $desc=$row['thread_desc'];
                        $thread_time=$row['thread_time'];
                        $thread_user_id=$row['thread_user_id'];

                     $sql2="SELECT user_email FROM `users` WHERE user_id='$thread_user_id'";
                     $result2=mysqli_query($conn,$sql2);
                     $row2=mysqli_fetch_assoc($result2);
                     

                     
                    
              // media object

                   echo '<div class="media my-3">
                         <img src="img/userdefault.png" width="34px" class="mr-3" alt="...">
                            <div class="media-body">
                            <p class="font-weight-bold my-0">' .$row2['user_email']. ' at ' .$thread_time. '</p>
                                <h5 class="mt-0"><a   href="thread.php?threadid=' .$id. '" > ' .$title. '</a></h5>
                               ' .$desc. '
                             </div>
                        </div>';

                    }
                    // echo var_dump($noresult);

                    if($noresult){
            
                       echo '<div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <p class="display-4">No Threads found  </p>
                                    <p class="lead">Be the first person to ask a question</p>
                                </div>
                     </div>';

                    }


                ?>

                <!--  media object
                
                <div class="media my-3">
                <img src="img/userdefault.png" width="34px" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0">Unable to install pyaudio error in window</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
                 </div> -->

            </div>




            <!-- footer -->

            <?php 
          include "partials/footer.php";
     ?>



            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
                integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                crossorigin="anonymous"></script>


    </body>

</html>
