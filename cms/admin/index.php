<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
                
        

        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php" ?>
        
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Thoroughbreeder Admin
                            
                            <small><?php echo $_SESSION['user_stud'] ?></small>
                        </h1>
                                                    
                        
                    </div>
                </div>
                <!-- /.row -->
       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-horse fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                    $query = "SELECT * FROM posts";
                    $select_all_post = mysqli_query($connection, $query);

                    $post_counts = mysqli_num_rows($select_all_post);

                    echo "<div class='huge'>{$post_counts}</div>"

                    ?>
                        <div>Horses</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-horse-head fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       
                    <?php 
                    $query = "SELECT * FROM Studs";
                    $select_all_stud = mysqli_query($connection, $query);

                    $stud_counts = mysqli_num_rows($select_all_stud);

                    echo "<div class='huge'>{$stud_counts}</div>"

                    ?>                          
                         <div>Studs</div>
                    </div>
                </div>
            </div>
            <a href="studs.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                    $query = "SELECT * FROM comments";
                    $select_all_comment = mysqli_query($connection, $query);

                    $comment_counts = mysqli_num_rows($select_all_comment);

                    echo "<div class='huge'>{$comment_counts}</div>"

                    ?>
                    
                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                    $query = "SELECT * FROM users";
                    $select_all_user = mysqli_query($connection, $query);

                    $user_counts = mysqli_num_rows($select_all_user);

                    echo "<div class='huge'>{$user_counts}</div>"

                    ?>                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
     
</div>
                <!-- /.row -->
               
<?php 
                        
$query = "SELECT * FROM posts WHERE post_category_id = 1";
$select_stallion_cat = mysqli_query($connection, $query);
$cat_stallion_counts = mysqli_num_rows($select_stallion_cat);


$query = "SELECT * FROM posts WHERE post_category_id = 2";
$select_mare_cat = mysqli_query($connection, $query);
$cat_mare_counts = mysqli_num_rows($select_mare_cat);                      

$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_post = mysqli_query($connection, $query);
$post_draft_counts = mysqli_num_rows($select_all_draft_post);

$query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_publish_post = mysqli_query($connection, $query);
$post_publish_counts = mysqli_num_rows($select_all_publish_post);

$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$unapproved_comments_query = mysqli_query($connection, $query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

//$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
//$select_all_subscribers = mysqli_query($connection, $query);
//$subscriber_counts = mysqli_num_rows($select_all_subscribers);



?>
                
    <div class="row">
                    
      <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          
            <?php    
            
            $element_text = ['Horses', 'Stallions', 'Mares', 'Active Posts', 'Draft Posts', 'Studs', 'Comments', 'Pending', 'Users'];
            $element_count = [$post_counts, $cat_stallion_counts, $cat_mare_counts, $post_publish_counts, $post_draft_counts, $stud_counts, $comment_counts, $unapproved_comment_count, $user_counts];

            for($i = 0; $i < 9; $i++) {
                
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                
            }

            
            ?>    
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
        
<div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                    
                </div>                   
                   
               </div>
           
           
            </div>
            <!-- /.container-fluid -->

        </div>
        
        
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php" ?>