<?php
session_start();
include 'connect.php';
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
    exit(0);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
$user_id=$_SESSION['user_id'];
$title=$_POST['title'];
$content=$_POST['content'];

$stmt=$conn->prepare("INSERT INTO posts(user_id,title,content)  VALUES(?,?,?)");
$stmt->bind_param("iss", $user_id,$title,$content);
if($stmt->execute()){
    header('Location:dashboard.php');
}
else{
    echo "Error: ".$conn->error;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Create a New Post</h2>

               

                <form action="post.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter the topic here" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5" placeholder="Enter the main content here" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary d-inline">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</html>