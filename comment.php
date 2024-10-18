<?php
require 'include/header.php';
require 'include/connect.php';
if(isset($_POST('comment'))){
if(empty($_POST['comment'])){
    echo "<script>alert('fill in all entries')</script>";
}
else{
    $comment =$_POST['comment'];
    $stmt=$conn->prepare("INSERT INTO comments (comment) VALUES(:comment)");
    $stmt->bindParam(':comment',$comment);
    if($stmt->execute()){
        $_SESSION['post_id'];
        echo "<script>alert('comment posted successfully')</script>";
        header('Location:index.php');
    }
    else{
        echo "<script>alert('unable to post')</script>";
    }
}
}
?>
<main class="w-50 m-auto">
    <form action="comment.php" method="post">
    <div class="form-group mb-3">
        <label for="content" class="form-label">comment</label>
         <textarea name="comment" id="content" class="form-control" rows="5" placeholder="Enter the main content here" required></textarea>
    </div>
    <button type="comment" class="btn btn-primary d-inline">comment</button>
    </form>
</main>
<?php require 'include/footer.php';?>

