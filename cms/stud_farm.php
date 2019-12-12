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
                
        if(isset($_GET['stud'])) {
            
            $post_stud_id = $_GET['stud'];
            
        }
                
                
                $query = "SELECT * FROM posts WHERE post_stud_id = $post_stud_id";
                
                $select_all_posts_query = mysqli_query($connection, $query);
                    
                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_stud_id = $row['post_stud_id'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,200);
                
                ?>    
                
                <h1 class="page-header">
                    <?php 
                    $query = "SELECT * FROM Studs WHERE stud_id = $post_stud_id";
                    $select_studs_id = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_studs_id)) {
                    $stud_id = $row['stud_id'];
                    $stud_name = $row['stud_name'];
                    $stud_image = $row['stud_image'];

                    echo "<td><img width='200' src='images/$stud_image' alt='image'></td>";

                        
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
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?>....</p>
                <br />
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               
                
                
                
                <?php }?>
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php 
include "includes/footer.php";
        
?>
 