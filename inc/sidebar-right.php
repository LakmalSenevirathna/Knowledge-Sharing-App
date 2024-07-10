                
                <div class="sidebar-right col-lg-4 top">
                    <div class="alert alert-warning text-center" role="alert">
                    &#9733;&#9733;&#9733; Most Recent    &#9733;&#9733;&#9733;
                    </div>
                    <div class="row">
                   
               


                    
                

</div>




<?php
                $post_query = "SELECT users.username, users.id, posts.id, posts.user_id, posts.title, posts.description, posts.category, posts.feat_image
                FROM users, posts
                WHERE users.id = posts.user_id  ORDER BY posts.id DESC LIMIT 5";
                $post_result = mysqli_query($conn, $post_query) or dei ("error");
                if(mysqli_num_rows($post_result) > 0){
                    while($posts = mysqli_fetch_assoc($post_result)){
                        $post_id = $posts['id'];
                        $id = $posts['user_id'];
                        $username = $posts['username'];
                        $title = $posts['title'];
                        $category = $posts['category'];
                        $description = $posts['description'];
                        $feat_image = $posts['feat_image'];
                       
                        ?>

                                <div class="col-12 content-top">
                                <div class="card" >
                                    <div class="card-body">
                                        <p style="margin:0px;padding:0px;"><a href="view.php?id=<?php echo $post_id;?>"><?php echo ucfirst($title);?></a></p> 
                                        <p class="card-subtitle mb-2 text-muted" style="font-size:15px; padding-left: 0;"><?php echo ucfirst($category); ?></p>
                                    </div>
                                </div>
                                </div>
                          
                       
                       

                    <?php
                    }
                }
        ?>


                        </div>