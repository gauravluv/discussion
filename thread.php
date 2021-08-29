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
        #dis {
            min-height: 433px;
        }

        </style>

    </head>


    <body>

        <!--nav bar -->

        <?php include "partials/header.php"; ?>

        <!--db connect -->
        <?php include "partials/dbconnect.php"; ?>


        <!-- fetching thread question by dyanamic unique id-->

            <?php
                    $id=$_GET['threadid'];
                    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
                    $result=mysqli_query($conn,$sql);
 
                    while($row=mysqli_fetch_assoc($result)){ 
                        $title=$row['thread_title'];
                        $desc=$row['thread_desc'];

                    }
                     

                ?>
  
  <!-- store comment in databse -->

          <?php 
           
             $showalert=false;
             $method=$_SERVER['REQUEST_METHOD'];
            //  echo $method;
             if($method=='POST'){
               $content=$_POST['comment'];

               $sql="INSERT INTO `comments` ( `comment_content`, `comment_th_id`, `comment_time`) VALUES ( '$content', '$id', current_timestamp());";
               $result=mysqli_query($conn,$sql);
               $showalert=true;

             }
             
             if($showalert){

              echo '<div class="alert alert-success" role="alert">
                          <h4 class="alert-heading">SUCCESS!</h4>
                          <p>You have successfully post a comment.</p>
                   </div>';
              }
          
          ?>

      <!-- jumbotron -->

    <div class="container">
      <div class="jumbotron">
    <h1 class="display-4"> <?php echo $title;?> </h1>
    <p class="lead"> <?php echo $desc;?></p>
    <p> posted by:<b>gaurav <b></p>

    </div>

     
       <?php
            //  answer to the question 

            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
           echo  '<div class="container" >

                <!-- form REQUEST URI DOCUMENTATION -->
                <form action= ' .$_SERVER[ 'REQUEST_URI'] . ' method="post">


                    <div class="form-group">
                        <label for="comment"><b> POST A COMMENT</b></label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>';
            }else{
                echo '<div><h3>POST A COMMENT </h3> </div>';

                echo  '<div class="alert alert-danger" role="alert">
                   <h1>you are not loggedin!</h1>
                    <p>please loggedin to post a comment.</p>
                 </div>';
            }


            ?>



            <div class="container" id="dis">
                   
                <h1 class="py-2">DISCUSSION </h1>
                <!--  fetching post to  database in  dynamically -->

                    <?php
                              $id=$_GET['threadid'];
                              $sql=" SELECT * FROM `comments` WHERE comment_th_id=$id";
                              $result=mysqli_query($conn,$sql);
                              $noresult=true;

                              while($row=mysqli_fetch_assoc($result)){
                                  $noresult=false;
                                  $id=$row['comment_id'];
                                  $content=$row['comment_content'];
                                  $time=$row['comment_time'];
                                //   $comment_thread_id=$row['$comment_th_id'];
                                $comment_th_id=$row['comment_th_id'];

                                  
                     $sql2="SELECT user_email FROM `users` WHERE  user_id='comment_th_id'";
                     $result2=mysqli_query($conn,$sql2);
                     $row2=mysqli_fetch_assoc($result2);
                                  
                              
                          

                   echo '<div class="media my-3">
                   <img src="img/userdefault.png" width="34px" class="mr-3" alt="...">
                      <div class="media-body">
                     <p class="font-weight-bold my-0">' .$row['user_email']. ' at ' .$time. '</p>
                       ' .$content. '
                                                      
                        </div>
                   </div>';

                              }
                                          // echo var_dump($noresult);
                        // if no post available in database in particular question shown  
                                          if($noresult){

                                            echo '<div class="jumbotron jumbotron-fluid">
                                                      <div class="container">
                                                          <p class="display-4">No Post found  </p>
                                                          <p class="lead">Be the first person to Post a comment</p>
                                                      </div>
                                          </div>';

                                          }


                                   ?>
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
