<?php 
session_start(); 
include('config/db.php');

?>
     
<?php if(isset($_SESSION['admin_name']) OR isset($_SESSION['username'])): ?>
   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile</title>
</head>
<body style="background-color: #4a77a6; position:relative; ">
    <div class="container-fluid ">
    <?php include('inc/header.php'); ?>
        
        <div class="row" style="width:1300px; margin:0 auto; margin-bottom:50px;">

        <?php if(isset($_SESSION['admin_name']) OR isset($_SESSION['username'])): ?>
            <?php include('inc/sidebar-left.php'); ?>
        <?php else: ?>

            <?php include('inc/sidebar-welcome.php'); ?>

        <?php endif; ?>
        
       
        <div class="content col-6" style="margin:20px 0px;">
        <div class="row">
            <div class="col-12">
            <?php $id = $_GET['id']; ?>
        <?php
                $post_query = "SELECT * FROM posts WHERE user_id = '$id' ORDER BY id DESC";
                $post_result = mysqli_query($conn, $post_query) or dei ("error");
                if(mysqli_num_rows($post_result) > 0){
                    while($posts = mysqli_fetch_assoc($post_result)){
                        $id = $posts['id'];
                        $user_id = $posts['user_id'];
                       
                        $title = $posts['title'];
                        $category = $posts['category'];
                        $short_description = $posts['s_des'];
                        $description = $posts['description'];
                        $feat_image = $posts['feat_image'];
                        $time = $posts['time'];
                        $location = $posts['location'];
                       

                        $userid = $_GET['id'];
                        ?>
                    <div class="card content-top" >
                    <div class="card-body">
                    <h5 class="card-title"><a href="view.php?id=<?php echo $id;?>"><?php echo ucfirst($title);?></a></h5>
                    <h6><span class="card-subtitle mb-2 text-muted"><?php echo ucfirst($category); ?></span> |
                    <span class="card-subtitle mb-2 text-muted"> <?php echo ucfirst($location); ?></span> |
                    <span class="card-subtitle mb-2 text-muted"> <?php echo ucfirst($time); ?></span>
                    </h6>
                    <img style="height:300px; width:580px;" src= <?php echo $feat_image;?>>
                    <p class="card-text"><?php echo ucfirst($short_description); ?></p>
                    <?php if(isset($_SESSION['admin_name'])): ?>
                        <div class="edit-delete" style="float:right;">
                            <div style="display:inline-block; margin-left:5px;">
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id" value=<?php echo $id ?>>
                                    <input type="submit" name="delete" value="DELETE" style="background: none; border: none; color: #008bff;">
                                </form>
                            </div>
                        </div> 
                        <?php else: ?>
                          
                        <?php endif; ?>
                        <?php if(($_SESSION['id'] == $userid  ) AND isset($_SESSION['username'])): ?>
                        <div class="edit-delete" style="float:right;">
                            <div style="display:inline-block;"><a href="edit.php?id=<?php echo $id;?>">EDIT</a></div>
                            <div style="display:inline-block; margin-left:5px;">
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id" value=<?php echo $id ?>>
                                    <input type="submit" name="delete" value="DELETE" style="background: none; border: none; color: #008bff;">
                                </form>
                            </div>
                            
                        </div>
                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                    </div>
                    <?php
                    }
                }
        ?>
            </div>
        </div>
        </div>

        <?php include('inc/sidebar-profile.php'); ?>

        </div>
        <?php include('inc/footer.php'); ?>

    </div>
</body>
</html>


<?php else: ?>
    <?php header('Location:logout.php'); ?>
<?php endif; ?>



       