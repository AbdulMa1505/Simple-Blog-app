<?php
require 'include/header.php';
require 'include/connect.php';
if(isset($_POST['register'])){
    if(empty($_POST('name'))||empty($_POST('email')||empty($_POST['password']))){
        echo "<script>alert('all entries must be filled')</script>";
    }
    else{
      $name=$_POST('name');
      $email=$_POST('email');
      $password=password_hash($_POST('password'),PASSWORD_BCRYPT);
      $stmt=$conn->$prepare("INSERT INTO users(name,email,password) VALUES (:name,:email:password)");
      $stmt->bindParam(':name',$name);
      $stmt->bindParam(':email',$email);
      $stmt->bindParam(':password',$password);
      if($stmt->execute()){
        $_SESSION['name']=$name;
        $_SESSION['email']=$email;
        header('Location:login.php');
      }
      else{
        echo "<script>alert('unable to register')</script>";
      }
    }
}
?>


<main class="w-50 m-auto">
  <form action="register.php" method="post">
    <div class="card mt-3">
      <div class="card-header text-center">
        Register
      </div>
      <div class="card-body">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="" class="form-label">Username</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" id="password" class="form-control">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="passwordToggleIcon"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button name="register" class="btn btn-primary">Register</button>
            </div>
            <p class="text-center mt-2">Already have an account? <a href="login.php">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
<script>
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const passwordToggleIcon = document.getElementById("passwordToggleIcon");   


    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordToggleIcon.classList.remove("fa-eye");
      passwordToggleIcon.classList.add("fa-eye-slash");   

    } else {
      passwordInput.type = "password";
      passwordToggleIcon.classList.remove("fa-eye-slash");
      passwordToggleIcon.classList.add("fa-eye");   

    }
  }
</script>

    <?php require 'include/footer.php'; ?>
    

