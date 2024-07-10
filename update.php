


<?php session_start(); ?>
<?php
    include("config/db.php");
    if(isset($_FILES['feat_image'])){
        $post_id = $_POST['id'];
        $title = $_POST['title'];
        $shortdes = $_POST['short-des'];
        $longdes = $_POST['long-des'];
        $category = $_POST['category'];
        $location = $_POST['location'];
        $upl_feat_image = $_POST['feat_image'];
        
        

        if($title != "" && $shortdes != "" && $longdes != "" && $category != "" && $location != ""){
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
                echo 'please choose the image which has the extention as jpeg, jpg, png';
                $msg = "please choose the image which has the extention as jpeg, jpg, png";
            }
            if(file_exists($target_file)){
                echo 'sorry file already exist!';
                $msg = "sorry file already exist!";
            }
            if($check == false){
                echo 'file is not an image';
                $msg = "file is not an image";
            }
            if(empty($msg) == true){
                move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
                $url = $_SERVER['HTTP_REFERER'];
                $seg = explode('/', $url); 
                $path = $seg[0].'/'.$seg['1'].'/'.$seg['2'].'/'.$seg[3];

                $image_path =explode('/', $upl_feat_image);

                $image = $image_path[6];

                $full_url = $path . '/' . 'assets/featuredimages/' . $file_name;
                $id = $_SESSION['id'];
                $sql = "UPDATE posts
                        SET title ='$title', s_des = '$shortdes', description = '$longdes', category = '$category', location = '$location', feat_image = '$full_url'
                        WHERE  id = '$post_id'";
                unlink("assets/featuredimages/" . $image);

                $query = $conn->query($sql);
                if($query){
                    $session_id=$_SESSION['id'];
                    header('Location:profile.php?id='.$session_id);
                }
                else{
                    echo 'faild to upload image!';
                }
            }
        }
        else{
            $errors = 'please fill all the detail';
        }
        
    }
?>
