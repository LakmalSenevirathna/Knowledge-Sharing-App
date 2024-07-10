<?php session_start() ?>
<?php if(!isset($_SESSION['username'])): ?>
    <?php header('Location:dashboard.php') ?>
<?php else: ?>
    <?php
         include("config/db.php"); 
         $user_id = $_SESSION['id'];
         if(isset($_POST['vote'])){
             $post_id = $_POST['id'];
             $rate = $_POST['rate'];
             $sql = "INSERT INTO rates (user_id, post_id, rate) VALUES ('$user_id', '$post_id', '$rate')";
             if($conn->query($sql)){
                 header('Location:view.php?id=' . $post_id);
             }
         }
    ?>

<?php endif; ?>
