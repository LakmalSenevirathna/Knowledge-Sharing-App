<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:index.php') ?>
<?php else: ?>

<?php include("config/db.php"); ?>
  <?php 
    if(isset($_POST['postcomment'])){
        $userid = $_SESSION['id'];
        $username = $_SESSION['username'];
        $postid = $_POST['id'];
        $comment = $_POST['comment'];
        if($comment != ''){
            $sql = "INSERT INTO comments (user_id, post_id, username, comment)
            VALUES ('$userid',' $postid',' $username',' $comment')";
            $query = $conn->query($sql);
            if($query){
              header('Location:view.php?id=' . $postid);
            }
        }
    }
  ?>

<?php endif; ?>