<?php
require 'include/header.php';
require 'include/connect.php';
$stmt=$conn->prepare("SELECT *  FROM posts");
$stmt->execute();
$posts =$stmt->fetchAll(PDO::FETCH_OBJ);
?>
<main class="w-50 m-auto mt-5">
    <?php foreach ($posts as $post): ?>
<div class="card ">
  <!-- <h5 class="card-header">Featured</h5> -->
  <div class="card-body">
    <h5 class="card-title"><? echo $post->title;?></h5>
    <p class="card-text"><?php echo $post->content; ?></p>
    <a href="comment.php>id=<?php echo $post->id;?>" class="btn btn-primary">comment</a>
  </div>
</div>
<?php endforeach;?>
</main>


<?php require 'include/footer.php';?>