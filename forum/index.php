<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php 
// Lấy các phản hồi
$allPosts = $conn->prepare("SELECT 
    posts.id as id, 
    posts.title as title, 
    posts.created_at as created_at, 
    posts.post_author as post_author, 
    posts.category as category, 
    COUNT(replies.post_id) as num_replies  
FROM 
    posts 
LEFT JOIN 
    replies 
ON 
    posts.id = replies.post_id 
GROUP BY 
    posts.id;
");
$allPosts->execute();
$posts = $allPosts->fetchAll(PDO::FETCH_OBJ);
?>

 <div class="container">
  <div class="row">
    <!-- Main content -->
    <div style="margin-top: 43px" class="col-lg-9 mb-3">
      <!-- Post 1 -->
       <?php foreach($posts as $post): ?>
      <div class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
        <div class="row align-items-center">
          <div class="col-md-8 mb-3 mb-sm-0">
            <h5><a href="single.php?id=<?php echo $post->id;?>" class="text-primary"><?php echo $post->title;?></a></h5>
            <p class="text-sm"><span class="op-6">Posted</span> <a class="text-black" href="#"><?php echo $post->created_at;?></a> <a class="text-black" href="#"><?php echo $post->post_author;?></a></p>
            <div class="text-sm op-5"><a class="text-black mr-2" href="#"><?php echo $post->category;?></a></div>
          </div>
          <div class="col-md-4 op-7">
            <div class="row text-center op-7">
              <div class="col px-1"><i class="ion-ios-chatboxes-outline icon-1x"></i> <span class="d-block text-sm"><?php echo $post->num_replies?> Replies</span></div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Sidebar content -->
    <?php require "includes/footer.php"; ?>
  </div>
</div>
