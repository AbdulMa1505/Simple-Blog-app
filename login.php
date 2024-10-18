<?php
require 'include/header.php';
require 'include/connect.php';
if(isset($_POST['login'])){
   
    if(empty($_POST['email']) || empty($_POST['password'])){
        echo "<script> alert('all entries must be filled');</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

       
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindParam(':email', $email);

       
        if($stmt->execute()){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if user exists and verify password
            if($user && password_verify($password, $user['password'])){
                $_SESSION['email']=$user['email'];
                header('Location:index.php');
                exit();
            } else {
                echo "<script> alert('Invalid email or password');</script>"; 
            }
        } else {
            echo "<script> alert('Query execution failed');</script>";
        }
    }
}
?>

<main class="w-50 m-auto">
  <form action="login.php" method="post">
    <div class="card mt-3">
      <div class="card-header text-center">
        Login
      </div>
      <div class="card-body">
        <div class="row justify-content-center">
          <div class="col-md-6">
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
              <button name="login" class="btn btn-primary">Sign in</button>
            </div>
            <p class="text-center mt-2">Don't  have an account? <a href="register.php">register</a></p>
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
<?php require 'include/footer.php';?>
