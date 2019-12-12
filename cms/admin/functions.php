<?php 
      
function confirmQuery($result) {
    
    global $connection;
    
    if(!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}




function insert_categories() {
    
    global $connection;
    
    if(isset($_POST['submit'])) {
                        $cat_title = $_POST['cat_title'];
                            
                            if($cat_title == "" || empty($cat_title)) {
                                echo "This field needs to be completed";
                            } else {
                                $query = "INSERT INTO categories(cat_title)";
                                $query .= "VALUE('{$cat_title}')";
                                
                                $create_category_query = mysqli_query($connection, $query);
                                
                                if(!$create_category_query) {
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }
                            }
                        
                        }  
    
    function findAllCategories() {
    global $connection;
        
        
                                    
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

        }

                                       
    }
    
    function deleteCategories() {
    global $connection;
    
        
        if(isset($_GET['delete'])) {
            $the_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
            $delete_query = mysqli_query($connection, $query);
            header("Location: categories.php");

        }
        
        
    }
    
    
}


function insert_studs() {
    
    global $connection;
    
    if(isset($_POST['submit'])) {
        $stud_name = $_POST['stud_name'];
        
        $stud_image = $_FILES['image']['name'];
        $stud_image_temp = $_FILES['image']['tmp_name'];
        
        move_uploaded_file($stud_image_temp, "../images/$stud_image");
        
        $stud_name = mysqli_real_escape_string($connection, $stud_name);
                            
            if($stud_name == "" || empty($stud_name)) {
                        echo "This field needs to be completed";
                    } else {
                        $query = "INSERT INTO Studs(stud_name, stud_image)";
                        $query .= "VALUE('{$stud_name}', '{$stud_image}')";

                        $create_stud_query = mysqli_query($connection, $query);

                        if(!$create_stud_query) {
                            die('QUERY FAILED' . mysqli_error($connection));
                        }
                    }

                }  

    function findAllStuds() {
    global $connection;
        
        
                                    
        $query = "SELECT * FROM Studs";
        $select_studs = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_studs)) {
        $stud_id = $row['stud_id'];
        $stud_name = $row['stud_name'];
        $stud_image = $row['stud_image'];

        echo "<tr>";
        echo "<td>{$stud_id}</td>";
        echo "<td><a href='../stud_farm.php?stud=$stud_id'>{$stud_name}</a></td>";
        echo "<td><img width='100' src='../images/$stud_image' alt='image'></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='studs.php?delete={$stud_id}'>Delete</a></td>";
        echo "<td><a href='studs.php?edit={$stud_id}'>Edit</a></td>";
        echo "</tr>";

        }

                                       
    }
    
    function deleteStuds() {
    global $connection;
    
        
        if(isset($_GET['delete'])) {
            $the_stud_id = $_GET['delete'];
            $query = "DELETE FROM Studs WHERE stud_id = {$the_stud_id}";
            $delete_query = mysqli_query($connection, $query);
            header("Location: studs.php");

        }
        
        
    }
    
    
}



?>