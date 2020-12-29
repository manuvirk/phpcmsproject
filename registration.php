<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>
<?php 
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if(!empty($username) && !empty($password) &&!empty($email)){

     $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    $email = mysqli_real_escape_string($connection,$email);
    
    $query = "SELECT user_randsalt FROM users ";
    $select_randsalt_query = mysqli_query($connection, $query);

    if(!$select_randsalt_query){
        die("QUERY FAILED". mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($select_randsalt_query);
    $salt = $row['user_randsalt'];

    $password=crypt($password,$salt);


     
 $query = "INSERT INTO users(user_name, user_password, user_email, user_role) ";

$query .= 
"VALUES('{$username}','{$password}','{$email}','subscriber') ";

$add_reg_user_query = mysqli_query($connection,$query);

      if(!$add_reg_user_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }

 $message = "Your Registration has been Submitted";

    } else{
         $message = "Fields cannot be empty!!";
    }



}else{
    $message = "";
}






?>

    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <h6 class = "text-center"><?php echo $message;?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
