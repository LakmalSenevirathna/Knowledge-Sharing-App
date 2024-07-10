<?php
    session_start();
    include("config/db.php");
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM posts WHERE id = $id";
        $query = $conn->query($sql);
        if($query){
            if(!isset($_SESSION['username'])):
                header('Location:dashboard.php');
            else: 

            $session_id=$_SESSION['id'];
            header('Location:profile.php?id='.$session_id);
            endif;
        }
    }
?>