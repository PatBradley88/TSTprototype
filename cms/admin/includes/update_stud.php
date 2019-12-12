  
                           
                           
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="stud_name">Edit Stud</label>

      <?php

       if(isset($_GET['edit'])) {
           $the_stud_id = $_GET['edit'];


           $query = "SELECT * FROM Studs WHERE stud_id = $the_stud_id";
            $select_studs_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_studs_id)) {
            $stud_id = $row['stud_id'];
            $stud_name = $row['stud_name'];
            $stud_image = $row['stud_image'];



            ?>

            <input value="<?php if(isset($stud_name)){echo $stud_name;} ?>" type="text" class="form-control" name="stud_name">
            
            <div class="form-group">
                <img width="100" src="../images/<?php echo $stud_image; ?>" alt="">
                <input type="file" name="image">
            </div>

      <?php }} ?>

    <?php 

       //UPDATE QUERY

       if(isset($_POST['update_stud'])) {
                $the_stud_name = $_POST['stud_name'];
                
                $stud_image = $_FILES['image']['name'];
                $stud_image_temp = $_FILES['image']['tmp_name'];

                move_uploaded_file($stud_image_temp, "../images/$stud_image");

                $stud_name = mysqli_real_escape_string($connection, $stud_name);
           
           if(empty($stud_image)) {
            
            $query = "SELECT * FROM Studs WHERE stud_id = $the_stud_id ";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)) {
                
                $stud_image = $row['stud_image'];
                
           
                    }
            }
               
            
           $query = "UPDATE Studs SET "; 
           $query .= "stud_name = '{$the_stud_name}', "; 
           $query .= "stud_image = '{$stud_image}' ";
           $query .= "WHERE stud_id = {$the_stud_id} ";
            
            $update_query = mysqli_query($connection, $query);
                    if(!$update_query) {
                        die("QUERY FAILED update " . mysqli_error($connection));
                        
            $update_stud = mysqli_query($connection, $query);
        
        confirmQuery($update_stud);
        
        echo "Stud Updated: " . " " . "<a href='studs.php'>Return to View All Studs</a>";
            
                    }
       }

       ?>    




   </div>
    <div class="form-group">
       <input class="btn btn-primary" type="submit" name="update_stud" value="Update Stud">
    </div>  


</form> 