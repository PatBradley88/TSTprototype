<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 
 
<?php 

if(isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $user_stud = $_POST['user_stud'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_lastname = $_POST['user_lastname'];
    $user_firstname = $_POST['user_firstname'];
    
    
    if(!empty($username) && !empty($user_stud) && !empty($user_email) && !empty($user_password) && !empty($user_lastname) && !empty($user_firstname)) {
        
        //removes special characters for db entry. does not affect display.   
    $username = mysqli_real_escape_string($connection, $username);
    $user_stud = mysqli_real_escape_string($connection, $user_stud);
    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $user_password = mysqli_real_escape_string($connection, $user_password);
    
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    
    if(!$select_randsalt_query) {
        
        die("QUERY FAILED" . mysqli_error($connection));
        
    }
    
    $row = mysqli_fetch_array($select_randsalt_query);
    
    $salt = $row['randSalt'];
       //hash the password 
    $user_password = crypt($user_password, $salt);
    
    
    $query = "INSERT INTO users (username, user_stud, user_email, user_firstname, user_lastname, user_password, user_role ) ";
    $query .= "VALUES('{$username}', '{$user_stud}', '{$user_email}', '{$user_firstname}', '{$user_lastname}', '{$user_password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query) {       
        die("QUERY FAILED" . mysqli_error($connection) . ' ' . mysqli_errno($connection));       
    }


    $message = "Your registration has been submitted";
        
    
} else {
    
    $message = "All fields need to be completed";
    
} 


} else {
    
    $message = "";

}


?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="user_stud" class="sr-only">Stud</label>
                            <input type="text" name="user_stud" id="stud" class="form-control" placeholder="Stud">
                        </div>
                        <div class="form-group">
                            <label for="user_stud" class="sr-only">Firstname</label>
                            <input type="text" name="user_firstname" id="firstname" class="form-control" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname" class="sr-only">Lastname</label>
                            <input type="text" name="user_lastname" id="lastname" class="form-control" placeholder="Lastname">
                        </div>
                         <div class="form-group">
                            <label for="user_email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="user_password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
