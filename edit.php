<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:index.php'); ?>
<?php else: ?>

<?php 
    include('config/db.php');
    $id = $_GET['id']; 
    $post_query = "SELECT * FROM posts WHERE id = '$id'";
    $post_result = mysqli_query($conn, $post_query) or dei ("error");
    if(mysqli_num_rows($post_result) > 0){
        while($posts = mysqli_fetch_assoc($post_result)){
            $id = $posts['id'];
            $title = $posts['title'];
            $short_description = $posts['s_des'];
            $description = $posts['description'];
            $category = $posts['category'];
            $location = $posts['location'];
        }
    }                    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Post</title>
</head>
<body style="background-color: #4a77a6;position:relative; ">
    <div class="container-fluid ">

    <?php include('inc/header.php'); ?>
        
        <div class="row" style="width:1300px; margin:0 auto;">

        <?php if(!isset($_SESSION['username'])): ?>
        <?php include('inc/sidebar-welcome.php'); ?>
        <?php else: ?>

            <?php include('inc/sidebar-left.php'); ?>

        <?php endif; ?>
     
      
      <div class="col-6 post" style="margin:20px 0px 20px 0px;">
    
      <form method="POST" action="update.php" enctype="multipart/form-data">
        <?php $id = $_GET['id'];  ?>  
        <input type="hidden" name="id" value=<?php echo $id; ?>>

          <div class="form-group">
          <textarea class="form-control" name="title" rows="1" placeholder="Title"><?php echo $title ?></textarea>
          </div>

          <div class="form-group">
          <textarea class="form-control" name="short-des" rows="4" placeholder="Short Description"><?php echo $short_description ?></textarea>
          </div>


          <div class="form-group">
          <textarea class="form-control" name="long-des" rows="12" placeholder="Write your story"><?php echo $description ?></textarea>
          </div>

          <div class="form-group">
          <select class="form-control" name="category" >
            <option value=<?php echo $category ?>><?php echo $category ?></option>
            <option value="Design">Design</option>
            <option value="Technology">Technology</option>
            <option value="Animals">Animals</option>
            <option value="Nature">Nature</option>
            <option value="Food">Food</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Sports">Sports</option>
            <option value="Politcs">Politcs</option>
            <option value="Economics">Economics</option>
            <option value="Health">Health</option>
            <option value="Others">Others</option>
          </select>
          </div>

          <div class="form-group">
          <select class="form-control" name="location">
          <option value=<?php echo $location ?>><?php echo $location ?></option>
            <option value="colombo">colombo</option>
            <option value="kandy">kandy</option>
            <option value="galle">galle</option>
            <option value="kurunegala">kurunegala</option>
            <option value="jaffna">jaffna</option>
            <option value="Ampara">Ampara</option>
            <option value="Anuradhapura">Anuradhapura</option>
            <option value="Badulla">Badulla</option>
            <option value="Hambantota">Hambantota</option>
            <option value="Nuwara Eliya">Nuwara Eliya</option>
          </select>
          </div>

          <div class="form-group">
            <label for="featuredimage">Upload Image:</label>
            <input type="file" id="featuredimage" name="feat_image" placeholder="featuredimage" /><br/>
          </div>

        <button type="submit" class="btn btn-success" name="update" value="update" style="float:right;">UPDATE</button>

      </form>
      </div>

      <div class="sidebar-right col-lg-3 top">
          <div class="card" >
              <div class="card-body text-center" >         
                  <img style="height:150px; width:150px; border-radius:80px;" src="assets/img/logo.png">     
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

<?php endif; ?>