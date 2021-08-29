<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>welcome to idiscuss-coding forum</title>


    <style>

      #cat{
        min-height:500px;
        }

    </style>
    
  </head>


  <body>

         <!--nav bar -->

    <?php include "partials/header.php"; ?>
    <?php include "partials/dbconnect.php"; ?>

  

<!--    slider

       <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                 <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x1200/?coding,apple" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x1200/?coding,microsoft" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x1200/?coding,google" class="d-block w-100" alt="...">
                </div>
               </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
       </div> -->


         <!-- category container start-->

    <div class="container my-4" >
           <h2 class="text-center">  idiscuss- Browse Catogories</h2> 

       <div class="row" id="cat">


         <!-- fetch all the categories using  while loop -->
        
          <?php  

                $sql="SELECT * FROM `categories`"; 
                $result=mysqli_query($conn,$sql);
               
                // fetching table row from table

                while($row=mysqli_fetch_assoc($result)){
                    $id = $row['category_id'];
                    $cat = $row['category_name'];
                    $desc = $row['category_description'];

                        // cards

                    echo '<div class="col-md-4 my-4">
                              <div class="card" style="width: 18rem;">
                                   <img src="https://source.unsplash.com/200x100/?'.$cat. ',coding" class="card-img-top" alt="image for this category">
                                      <div class="card-body">
                                            <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
                                            <p class="card-text">' . substr($desc, 0, 90). '... </p>
                                            <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
                                        </div>
                              </div>
                         </div>';
                                
                            }               
           ?>

             </div>
      </div> 

     
 
 

    <!-- footer -->

    
      <?php

      include'partials/footer.php';

      ?>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


  </body>
</html>