<?php session_start() ?>


<?php include("config/db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Post View</title>
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
</head>
<body style="background-color: #4a77a6; position:relative;">
    <div class="container-fluid">
       
    <?php include('inc/header.php'); ?>
        
        <div class="row" style="width:1300px; margin:0 auto; margin-bottom:50px;">

      

        <?php if(isset($_SESSION['admin_name']) OR isset($_SESSION['username'])): ?>
            <?php include('inc/sidebar-left.php'); ?>
        <?php else: ?>

            <?php include('inc/sidebar-welcome.php'); ?>

        <?php endif; ?>

       
        <div class="content col-6" style="margin-top:20px;">
        <?php  $id = $_GET['id']; ?>
        <?php
                $post_query = "SELECT * FROM posts WHERE id = '$id'";
                $post_result = mysqli_query($conn, $post_query) or dei ("error");
                if(mysqli_num_rows($post_result) > 0){
                    while($posts = mysqli_fetch_assoc($post_result)){
                        $id = $posts['id'];
                        $user_id = $posts['user_id'];
                       
                        $title = $posts['title'];
                        $category = $posts['category'];
                        $description = $posts['description'];
                        $feat_image = $posts['feat_image'];
                        $time = $posts['time'];
                        $location = $posts['location'];
                       
                        ?>
                    <div class="card content-top" >
                    <div class="card-body">

                        

                   
                   
                    <h5 class="card-title"><a href="view.php?id=<?php echo $id;?>"><?php echo ucfirst($title);?></a></h5>
                    <h6><span class="card-subtitle mb-2 text-muted"><?php echo ucfirst($category); ?></span> |
                    <span class="card-subtitle mb-2 text-muted"> <?php echo ucfirst($location); ?></span> |
                    <span class="card-subtitle mb-2 text-muted"> <?php echo ucfirst($time); ?></span>
                    </h6>
                    <img style="height:300px; width:580px;" src= <?php echo $feat_image;?>>
                    <p class="card-text"><?php echo ucfirst($description); ?></p>
                    <div class="rate" style="display:inline-block;">
                    <span class="text-info" style="text-align:center; font-size: 20px;margin-left: 20px;"> Rate Me |</span> 
                    <form style="display: inline-block;" action="rates.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="hidden" name="rate" value="1">
                        <input class="hv" style="background: white;border:none; font-size:25px;padding: 0;" type="submit" name="vote" value="&#9733;">
                    </form>
                    <form style="display: inline-block;" action="rates.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="hidden" name="rate" value="2">
                        <input class="hv" style="background: white;border:none; font-size:25px;padding: 0;" type="submit" name="vote" value="&#9733;">
                    </form>
                    <form style="display: inline-block;" action="rates.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="hidden" name="rate" value="3">
                        <input class="hv" style="background: white;border:none; font-size:25px;padding: 0;" type="submit" name="vote" value="&#9733;">
                    </form>
                    <form style="display: inline-block;" action="rates.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="hidden" name="rate" value="4">
                        <input class="hv" style="background: white;border:none; font-size:25px;padding: 0;" type="submit" name="vote" value="&#9733;">
                    </form>
                    <form style="display: inline-block;" action="rates.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="hidden" name="rate" value="5">
                        <input class="hv" style="background: white;border:none; font-size:25px;padding: 0; " type="submit" name="vote" value="&#9733;">
                    </form>
               
                    </div>
                    <div class="rate-results" style="float:right;"> 
                    <?php
                        $post_query = "SELECT post_id='$id', (SUM(rate)) AS rate_sum 
                        FROM rates
                        WHERE post_id='$id'";
                     
                        $post_result = mysqli_query($conn, $post_query) or dei ("error");
                        if(mysqli_num_rows($post_result) > 0){
                        while($posts = mysqli_fetch_assoc($post_result)){
                            
                            $rate_sum = $posts['rate_sum'];
                        
                            ?>
    
                            <p style="padding:0px;margin-top: -13px;"><?php echo  ($rate_sum); ?><span style="color:orange;font-size:35px; ">&#9733;</span></p> 
                            
                            <?php
                            }
                        }

                        ?>
                    
                    </div>
                    <?php if(!isset($_SESSION['username'])): ?>
                       
                    <?php else: ?>
                        <form class="comment" style="padding:0px 20px 0px 20px; margin-top:40px; margin-bottom:80px;" action="comment.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <div class="form-group">
                        <textarea class="form-control" name="comment" rows="1"  placeholder="Comment Here"></textarea>
                        </div>
                        <button class="btn btn-outline-success my-2 my-sm-0 float-right" name="postcomment" type="submit">Comment</button>
                        </form>
                    <?php endif; ?>
                  
                    <div>
                    <?php
                        $com_query = "SELECT * FROM comments WHERE post_id = '$id' ORDER BY id DESC";
                        $coms_result = mysqli_query($conn, $com_query) or die ("error");
                        if(mysqli_num_rows($coms_result) > 0){
                            while($com = mysqli_fetch_assoc($coms_result)){
                                $username = $com['username'];
                                $comment = $com['comment'];
                                ?>
                                <div class="alert-success" style="border:1px solid #a3a3ad; border-radius: 5px;margin: 20px; padding: 10px;">
                                <p style="padding:0px; margin:0px 0px 3px 0px;" >Posted by | <?php echo $username;?></p>
                                <p style="padding:0px; margin:0px;" class="text-dark"><?php echo $comment;?></p>
                                </div>
                               
                               
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

        <div class="sidebar-right col-lg-3 top">
            <div class="card" >
                <div class="card-body text-center" >
                    
                    <p >Knowledge Share is a Sri Lankan knowledge sharing service on which users post 
                        and interact with messages known as "posts". Registered users can post, rate and read posts,
                        but unregistered users can only read them.</p>
                           
                </div>
            </div>
        </div>

        </div>
        
        <?php include('inc/footer.php'); ?>


    </div>
</body>
</html>



