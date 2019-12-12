<?php
     $query = "SELECT * FROM Studs";
        $select_studs_sidebar = mysqli_query($connection, $query);

?>
                   

                   
<div class="well">
    <h4>Stud Farms</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php
                while($row = mysqli_fetch_assoc($select_studs_sidebar)) {
                $stud_name = $row['stud_name'];
                $stud_id = $row['stud_id'];

                echo "<li><a href='stud_farm.php?stud=$stud_id'>{$stud_name}</a></li>";

                }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->

        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>