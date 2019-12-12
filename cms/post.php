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
                
    if(isset($_GET['p_id'])) {
        
        $the_post_id = $_GET['p_id'];
        
    }            
                
                
                
                
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                
                $select_all_posts_query = mysqli_query($connection, $query);
                    
                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_stud_id = $row['post_stud_id'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                
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
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    Standing at <a href="stud_farm.php?stud=<?php echo $post_stud_id ?>&p_id=<?php echo $post_title ?>">
<!--        Converting stud_id to stud_name. Relating             db's Posts to Studs.-->
            
            <?php 
                
            $query = "SELECT * FROM Studs WHERE stud_id = $post_stud_id";
            $select_studs_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_studs_id)) {
            $stud_id = $row['stud_id'];
            $stud_name = $row['stud_name'];
                
            echo $stud_name;
            
            }     ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

               
                
                
                
                <?php }?>
                
                
                
                
                <!-- Blog Comments -->

               <?php
               
               if(isset($_POST['create_comment'])) {
                   
                  $the_post_id = $_GET['p_id'];
                   
                  $comment_author = $_POST['comment_author'];     $comment_email = $_POST['comment_email'];
                  $comment_content = $_POST['comment_content'];
                   
                   if(!empty($comment_author) || !empty($comment_email) || !empty($comment_content)) {
                       
                       
                       $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                   
                $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                $create_comment_query = mysqli_query($connection, $query);
                   
                   if(!$create_comment_query){
                       die('QUERY FAILED' . mysqli_query($connection));
                   }
               
//$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
//$query .= "WHERE post_id = $the_post_id";
//$update_comment_count = mysqli_query($connection, $query);       
$query = "UPDATE posts SET post_comment_count = (SELECT COUNT * FROM comments WHERE comment_post_id = $post_id) WHERE post_id = $post_id";
       
       $result = mysqli_query($connection, $query);

               
               
               } else {
                       
                       echo "<script>alert('Fields cannot be empty')</script>";
                       
                       
                   }
                       
                       
                   }
                   
                   
                  
                   
                   
                
                
               
               
               
               ?>
               
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                           <label for="Comment Author">Comment Author</label>
                            <input type="text" class="form-control" name="comment_author">                        
                       </div>
                       <div class="form-group">
                           <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="comment_email">                       
                       </div>
                        <div class="form-group">
                           <label for="comment">Comment</label>
                            <textarea name="comment_content" class="form-control" id="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

        <?php       
        $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query) {
                    die('QUERY FAILED' . mysqli_query($connection));
                }
                while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                    
                ?>
                
                 <!-- Comment -->
                <div class="media">
                   
                   
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        
                    <?php 
                    echo $comment_content; 
                    ?>
                        
                    </div>
                </div>
                
                <?php } 
                ?>       
               
               
               
               
                </div>

               
              

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php 
include "includes/footer.php";
        
?>
 