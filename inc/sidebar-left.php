

<?php 
$id = $_SESSION['id'];

?>


  
    <div class="sidebar-left col-lg-2 " style="height:500px;background-color:none; margin-top:20px;">
        <div class="" >
            <div class="list-group list-group-flush">
            <?php if(!isset($_SESSION['username'])): ?>
                <a href="dashboard.php" class="list-group-item list-group-item-action " style="margin-bottom:20px; border-radius: 5px;">Dashboard</a>
                <a href="logout.php" class="list-group-item list-group-item-action "style="margin-bottom:20px;border-radius: 5px;">Logout</a>
                <?php else: ?>
                      
                <a href="index.php" class="list-group-item list-group-item-action " style="margin-bottom:20px; border-radius: 5px;">Home</a>
                <a href="profile.php?id=<?php echo $id;?>" class="list-group-item list-group-item-action "style="margin-bottom:20px;border-radius: 5px;">Profile</a>
                <a href="post.php" class=" list-group-item list-group-item-action "style="margin-bottom:20px;border-radius: 5px;">Write Now</a>
                <a href="logout.php" class="list-group-item list-group-item-action "style="margin-bottom:20px;border-radius: 5px;">Logout</a>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
