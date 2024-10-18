<?php
require 'include/header.php';
require 'include/connect.php';
if(isset($_POST['post'])){
    if(empty($_POST('title')) || empty($_POST['content'])){
        echo "<script>alert('all entries must be filled')</script>";
    }
    else{
        $title=$_POST['title'];
        $content=$_POST['content'];
        $stmt=$conn->prepare("INSERT INTO posts (title,content) VALUES(:title,:content)");
        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':title',$title);
        if($stmt->execute()){
            header('Location:index.php');
        }
        else{
            echo "<script>alert('unable to post')</script>";
    }
        }
    }

?>
<main class="w-50 m-auto">
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
                    <div class="d-grid col-6 g-2 mx-auto">
                    <button type="submit" name="post" class="btn btn-primary d-inline">Submit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</main>
 

   <?php require 'include/footer.php';?>