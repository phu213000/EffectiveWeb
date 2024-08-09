<?php require './config/config.php'; ?>

<?php 
try {
    // Fetch all posts
    $posts = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC");
    $posts->execute(); 
    $allPosts = $posts->fetchAll(PDO::FETCH_OBJ);

    // Count categories
    $categories = $conn->prepare("SELECT COUNT(id) as num_categories FROM categories");
    $categories->execute();
    $num_cats = $categories->fetch(PDO::FETCH_OBJ);

    // Count posts
    $posts_count = $conn->prepare("SELECT COUNT(id) as num_posts FROM posts");
    $posts_count->execute();
    $num_posts = $posts_count->fetch(PDO::FETCH_OBJ);

    // Count replies
    $replies = $conn->prepare("SELECT COUNT(id) as num_replies FROM replies");
    $replies->execute();
    $num_replies = $replies->fetch(PDO::FETCH_OBJ);
    
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>

<!-- Sidebar Content -->
<div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
    <div class="sticky" style="top: 85px">
        <div class="sticky-inner">
            <a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="create-post.php">
                <i class="fas fa-question-circle"></i> Ask Question
            </a>
            <div class="bg-white mb-3">
                <h4 class="px-3 py-4 op-5 m-0"><a href="./index.php">Latest Posts</a></h4>
                <?php foreach ($allPosts as $post): ?>
                <hr class="m-0" />
                <div class="pos-relative px-3 py-3">
                    <h6 class="text-primary text-sm">
                      <a href="single.php?id=<?php echo $post->id; ?>" class="text-primary">
                          <i class="fas fa-file-alt"></i> <?php echo $post->title; ?>
                      </a>
                    </h6>
                    <p class="mb-0 text-sm"><span class="op-6"><i class="fas fa-calendar-alt"></i> Posted</span> <?php echo $post->created_at; ?></p>
                </div>
                <hr class="m-0" />
                <?php endforeach; ?>
            </div>
            
            <!-- Add statistics section -->
            <div class="bg-white mb-3">
                <h4 class="px-3 py-4 op-5 m-0">Statistics</h4>
                <hr class="m-0" />
                <div class="d-flex justify-content-around text-center py-3">
                    <div>
                        <h6 class="text-primary text-sm m-0"><?php echo $num_cats->num_categories; ?></h6>
                        <i class="fas fa-th-large"></i>
                        <span class="d-block">Total Categories</span>
                    </div>
                    <div>
                        <h6 class="text-primary text-sm m-0"><?php echo $num_posts->num_posts; ?></h6>
                        <i class="fas fa-file-alt"></i>
                        <span class="d-block">Total Posts</span>
                    </div>
                </div>
                <div class="d-flex justify-content-center text-center py-3">
                    <div>
                        <h6 class="text-primary text-sm m-0"><?php echo $num_replies->num_replies; ?></h6>
                        <i class="fas fa-comments"></i>
                        <span class="d-block">Total Replies</span>
                    </div>
                </div>
                <hr class="m-0" />
            </div>
            <!-- End of statistics section -->
        </div>
    </div>
</div>
<!-- /Sidebar Content -->

<!-- Closing body and html tags -->
</body>
</html>
