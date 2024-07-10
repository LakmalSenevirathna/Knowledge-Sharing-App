<?php
               
                $id = $_GET['id']; 

                $post_query = "SELECT * FROM users WHERE id = '$id'";
                $post_result = mysqli_query($conn, $post_query) or dei ("error");
                if(mysqli_num_rows($post_result) > 0){
                    while($posts = mysqli_fetch_assoc($post_result)){
                        $id = $posts['id'];
                        $username = $posts['username'];
                        $email = $posts['email'];
                       
                        ?>
                        <div class="sidebar-right col-lg-3 top">
                        <div class="card" >
                        <div class="card-body text-center" >
                            <p style="" class="text-success"><?php echo ucfirst($username);?></p>
                            <img style="height:150px; width:150px; border-radius:80px;" src="assets/img/logo.png">
                            <p style="margin: 0;"><?php echo $email;?></p>
                            <p >Knowledge Share is a Sri Lankan knowledge sharing service on which users post 
                            and interact with messages known as "posts". Registered users can post, rate and read posts,
                             but unregistered users can only read them.</p>
                           
                        </div>
                        </div>
                        </div>
                        
                    <?php
                    }
                }
        ?>
