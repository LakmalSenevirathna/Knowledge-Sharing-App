<?php 
session_start(); 
include('config/db.php'); 


if(isset($_FILES['feat_image'])){
  $title = $_POST['title'];
  $shortdes = $_POST['short-des'];
  $longdes = $_POST['long-des'];
  $category = $_POST['category'];
  $location = $_POST['location'];

  $id = $_SESSION['id'];

  if($title != "" && $shortdes != ""  && $longdes != "" && $category != "" && $location != ""){
       $uploadok = 1;
      $file_name = $_FILES['feat_image']['name'];
      $file_size = $_FILES['feat_image']['size'];
      $file_tmp = $_FILES['feat_image']['tmp_name'];
      $file_type = $_FILES['feat_image']['type'];
      $target_dir = "assets/featuredimages";
      $target_file = $target_dir . basename($_FILES['feat_image']['name']);
      $check = getimageSize($_FILES['feat_image']['tmp_name']);

      //$file_ext = strtolower(end(explode('.', $_FILES['avatar']['name']))); error
      $tmp = explode('.', $_FILES['feat_image']['name']); // couldnt use strtolower
      $file_ext = end($tmp);



      $extentions = array("jpeg", "jpg", "png");
      if(in_array($file_ext, $extentions) == false){

        $msg['msg'] = "please choose the image which has the extention as jpeg, jpg, png";
      }
      if(file_exists($target_file)){
         
          $msg['msg'] = "sorry file already exist!";
      }
      if($check == false){
         
        $msg['msg'] = "file is not an image";
      }
      if(empty($msg) == true){
          move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
          $url = $_SERVER['HTTP_REFERER'];
          $seg = explode('/', $url);
          $path = $seg[0].'/'.$seg['1'].'/'.$seg['2'].'/'.$seg[3];
          $full_url = $path . '/' . 'assets/featuredimages/' . $file_name;
          $id = $_SESSION['id'];
          $sql = "INSERT INTO posts(title, s_des, description, category, location, feat_image, user_id) VALUES 
        ('$title', '$shortdes', '$longdes', '$category', '$location' , '$full_url', '$id')";
          
          $query = $conn->query($sql);
          if($query){
              header('Location:index.php');
          }
          else{
              echo   'faild to upload image!';
          }
      }
  }
  else{
    echo  'please fill all the detail';
  }
  
}


?>

<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:index.php'); ?>
<?php else: ?>

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
    <div class="container-fluid">

    <?php include('inc/header.php'); ?>
        
        <div class="row" style="width:1300px; margin:0 auto;">

        <?php if(!isset($_SESSION['username'])): ?>
        <?php include('inc/sidebar-welcome.php'); ?>
        <?php else: ?>

            <?php include('inc/sidebar-left.php'); ?>

        <?php endif; ?>
      
     
      <div class="col-6 post" style="margin:20px 0px 20px 0px;">
     
      <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Title">
          </div>

          <div class="form-group">
          <textarea class="form-control" name="short-des" rows="4" placeholder="Short Description"></textarea>
          </div>

          <div class="form-group">
          <textarea class="form-control" name="long-des" rows="12" placeholder="Write Your Story"></textarea>
          </div>

          <div class="form-group">
          <select class="form-control" name="category">
            <option value="unset category">select category</option>
            <option value="Economics">Design</option>
            <option value="Economics">Technology</option>
            <option value="Economics">Animals</option>
            <option value="Economics">Nature</option>
            <option value="Economics">Food</option>
            <option value="Economics">Economics</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Sports">Sports</option>
            <option value="Politcs">Politcs</option>
            <option value="Economics">Economics</option>
            <option value="Others">Others</option>
          </select>
          </div>

          <div class="form-group">
          <select class="form-control" name="location">
          <option value="unset location">select location</option>
            <option value="colombo">colombo</option>
            <option value="kandy">kandy</option>
            <option value="galle">galle</option>
            <option value="kurunegala">kurunegala</option>
            <option value="jaffna">Ampara</option>
            <option value="jaffna">jaffna</option>
            <option value="jaffna">Anuradhapura</option>
            <option value="jaffna">Badulla</option>
            <option value="jaffna">Hambantota</option>
            <option value="jaffna">Nuwara Eliya</option>
          </select>
          </div>

          <div class="form-group">
            <label for="featuredimage">Upload Image:</label>
            <input type="file" id="featuredimage" name="feat_image" placeholder="featuredimage" /><br/>
          </div>

        <button type="submit" class="btn btn-success" name="submit" value="submit" style="float:right;">Post Story</button>

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
        

      </div>
      <?php include('inc/footer.php'); ?>

    </div>
</body>
</html>

<?php endif; ?>