<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

 <!-- Navigation -->
<?php 

    include "includes/navigation.php";

?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }
                
                if($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * 10) - 10;
                }
                
                
                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);
                
                $count = ceil($count / 10);
                
                
                $query = "SELECT * FROM posts LIMIT $page_1, 10";
                
                $select_all_posts_query = mysqli_query($connection, $query);
                    
                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_stud_id = $row['post_stud_id']; 
                $post_category_id = $row['post_category_id'];  
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,300);
                $post_status = $row['post_status'];
          
                if($post_status !== 'published') {
                    echo "<h1 class='text-center'>Post Pending</h1>";
                }  else {
                       
                    
                ?>   
                
                <h1 class="page-header">
                    <?php 
                    $query = "SELECT * FROM Studs WHERE stud_id = $post_stud_id";
                    $select_studs_id = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_studs_id)) {
                    $stud_id = $row['stud_id'];
                    $stud_name = $row['stud_name'];
                    $stud_image = $row['stud_image'];

                    echo "<td><img width='100' src='images/$stud_image' alt='image'></td>";

                        
                    }  
                    ?>
                    <small>
                    
                    <?php 
                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                    $select_categories_id = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<td>{$cat_title}</td>";
                    }
                    ?>
                    
                    </small>
                </h1>

                <!-- First Blog Post -->                
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                   
<!--Converting the stud_id to the relating Stud name. -->
                   
                    Standing at <a href="stud_farm.php?stud=<?php echo $post_stud_id ?>&p_id=<?php echo $post_id ?>">
                    <?php 
                
                    $query = "SELECT * FROM Studs WHERE stud_id = $post_stud_id";
                    $select_studs_id = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_studs_id)) {
                    $stud_id = $row['stud_id'];
                    $stud_name = $row['stud_name'];

                    echo "<td>{$stud_name}</td>";

                    }    
                    
                    
                    
                    ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?>....</p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               
                
                
                
                <?php } } ?>
                
                
                
                

                
             
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
            
            <?php 
            
            for($i = 1; $i <= $count; $i++) {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
            
            ?>
            
        </ul>
        
        
        
<?php 
include "includes/footer.php";
        
?>
 