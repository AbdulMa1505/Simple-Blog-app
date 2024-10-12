<?php
session_start();
include 'connect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$email=$_POST['email'];
$password=$_POST['password'];
$stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result=$stmt->get_result();
$user =$result->fetch_assoc();
if(password_verify($password,$user['password'])){
    $_SESSION['user_id']=$user['id'];
    $_SESSION['name']=$user['name'];
    header('Location:dashboard.php');

}
else{
    echo "invalid logins";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="input-group-text">
                                        <input type="checkbox" class="form-check-input" id="showPassword">
                                        <label for="showPassword" class="form-check-label"> Show Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordField = document.getElementById("password");
        const showPasswordBox = document.getElementById("showPassword");

        showPasswordBox.addEventListener('change', function () {
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>
</html>
