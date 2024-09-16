<?php include('header.php') ?>

<?php

include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location: index.php');
  exit;
}

if(isset($_POST['login_btn'])){

  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare('SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_name = ? AND admin_password = ? LIMIT 1');

  $stmt->bind_param('ss',$username,$password);
  if($stmt->execute()){
    $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
    $stmt->store_result();
    
    if($stmt->num_rows() == 1){
      $stmt->fetch();

      $_SESSION['admin_id'] = $admin_id;
      $_SESSION['admin_name'] = $admin_name;
      $_SESSION['admin_email'] = $admin_email;
      $_SESSION['admin_logged_in'] = true;

      header('location: index.php?login_success=Login successful!');
    }else{
      header('location: login.php?error=No account found or you have entered wrong email or password.');
    }
  }else{
    header('location: login.php?error=Something went wrong. Please try again.');
  }
}

?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h1 class="text-center">Login</h1>
      <form method="POST" action="login.php">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="username" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password">
        </div>
        <input type="submit" class="btn btn-submit btn-block" name="login_btn" value="Submit">
      </form>
    </div>
  </div>
</div>

</body>
</html>
