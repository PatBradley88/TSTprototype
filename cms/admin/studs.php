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

        <div class="col-xs-6"> 

        <?php insert_studs(); ?>                         

        <form action="" method="post" enctype="multipart/form-data">
           <div class="form-group">
              <label for="stud_name">Add Stud</label>
               <input class="form-control" type="text" name="stud_name">
           </div>
           <div class="form-group">
            <label for="stud_image">Stud Logo</label>
            <input type="file" name="image">
            </div>
            <div class="form-group">
               <input class="btn btn-primary" type="submit" name="submit" value="Add Stud">
            </div>  


        </form> 

        <?php 

        if(isset($_GET['edit'])) {

            $stud_id = $_GET['edit'];

            include "includes/update_stud.php";

        }

        ?>


</div>  

            <div class="col-xs-6">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Stud</th>
                        <th>Stud Logo</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>

                    <?php findAllStuds(); ?>

                    <?php deleteStuds(); ?>

                </tbody>
            </table>



            </div>

                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        
        
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php" ?>