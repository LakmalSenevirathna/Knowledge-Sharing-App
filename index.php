<?php 
session_start(); 
include('config/db.php');
?>
     


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
.rate .hv {
  color: lightgray;
  display: inline-block;
  font-size: 18pt;
  margin: 0 -2px;
  transition: transform .15s ease;
}
.rate .hv:hover {
  transform: scale(1.35, 1.35);
  color: orange;
}

    </style>
  <title>Home</title>
</head>
<body style="background-color: #4a77a6; position:relative; ">
    <div class="container-fluid">   
        <?php include('inc/header.php'); ?>
        
        <div class="row" style="width:1300px; margin:0 auto;">

        <?php if(!isset($_SESSION['username'])): ?>
        <?php include('inc/sidebar-welcome.php'); ?>
        <?php else: ?>

            <?php include('inc/sidebar-left.php'); ?>

        <?php endif; ?>

        
        <div class="content col-lg-6" style="margin:20px 0px;">
        
            <div class="row">
            <?php 
          $output = '';
          if(isset($_POST['search'])) {
            $searchq = $_POST['search'];
            $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

            $search_query = "SELECT * FROM posts WHERE title LIKE '%$searchq%' OR location LIKE '%$searchq%'";
            $post_result = mysqli_query($conn, $search_query) or dei ("error");
            $count = mysqli_num_rows($post_result);
            if($count ==  0){
                  $output = 'There was no post results';
            }else{
              ?><div class="alert alert-success col-lg-12 text-center" role="alert">
              Search Rsults 
              </div><?php
              while($posts = mysqli_fetch_assoc($post_result)){
                $id = $posts['id'];
               $title = $posts['title'];
               $location = $posts['location'];
              
                ?>
                  <div class="col-12 content-top">
                      <div class="alert alert-dark" role="alert">
                        <h5><?php echo ucfirst($output);?></h5>
                        <h5 class="card-title"><a class="text-muted" href="view.php?id=<?php echo $id;?>"><?php echo ucfirst($title);?></a></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><a class="text-muted" href="view.php?id=<?php echo $id;?>"><?php echo ucfirst($location);?></a></h6>
                      </div>
                  </div>
                <?php
              }
            }

          }
      
        ?>
                <div class="col-12">
                <?php
                $post_query = "SELECT users.username, users.id, posts.id, posts.user_id, posts.title, posts.s_des, posts.description, posts.category, posts.time, posts.location, posts.feat_image
                FROM users, posts
                WHERE users.id = posts.user_id  ORDER BY posts.id DESC";
                $post_result = mysqli_query($conn, $post_query) or dei ("error");
                if(mysqli_num_rows($post_result) > 0){
                    while($posts = mysqli_fetch_assoc($post_result)){
                        $id = $posts['id'];
                        $user_id = $posts['user_id'];
                        $username = $posts['username'];
                        $title = $posts['title'];
                        $category = $posts['category'];
                        $short_description = $posts['s_des'];
                        $description = $posts['description'];
                        $feat_image = $posts['feat_image'];
                        $time = $posts['time'];
                        $location = $posts['location'];
                       
                        ?>
                    <div class="card content-top" >
                    <div class="card-body" style="padding-bottom: 0px;">

                        

                    <h5><a class="text-dark" href="profile.php?id=<?php echo $user_id;?>"><?php echo ucfirst($username) ;?></h5>
                    <h5 class="card-title"><a class="text-info" href="view.php?id=<?php echo $id;?>"><?php echo ucfirst($title);?></a></h5>
                    <h6><span class="card-subtitle mb-2 text-muted"><?php echo ucfirst($category); ?></span> |
                    <span class="card-subtitle mb-2 text-muted"> <?php echo ucfirst($location); ?></span> |
                    <span class="card-subtitle mb-2 text-muted"> <?php echo ucfirst($time); ?></span>
                    </h6>
                    <img style="height:300px; width:580px;" src= <?php echo $feat_image;?>>
                    <p class="card-text"><?php echo ucfirst($short_description); ?></p>
                    <div class="rate-results" style="float:right;"> 
                    <?php
                        $rate_query = "SELECT post_id='$id', (SUM(rate)) AS rate_sum 
                        FROM rates
                        WHERE post_id='$id'";
                     
                        $rate_result = mysqli_query($conn, $rate_query) or dei ("error");
                        if(mysqli_num_rows($rate_result) > 0){
                        while($posts = mysqli_fetch_assoc($rate_result)){
                            
                            $rate_sum = $posts['rate_sum'];
                        
                            ?>
    
                            <p style="padding:0px;margin-top: -13px;"><?php echo  ($rate_sum); ?><span style="color:orange;font-size:35px; ">&#9733;</span></p> 
                            
                            <?php
                            }
                        }

                        ?>
                    
                    </div>
                    </div>
                    </div>
                    <?php
                    }
                }
        ?>
                </div>
            </div>
        </div>

            <?php include('inc/sidebar-right.php'); ?>

        </div>

        
            <?php include('inc/footer.php'); ?>
    </div>

</body>
</html>





       