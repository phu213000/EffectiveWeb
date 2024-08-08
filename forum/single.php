<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Check if any input fields are empty
    if (empty($_POST['author_name']) || empty($_POST['reply'])) {
        echo '<script>alert("One or more inputs are empty")</script>';
    } else {
        $author_name = $_POST['author_name'];
        $reply = $_POST['reply'];
        $post_id = $_POST['post_id'];

        // Insert data into the replies table
        $insert = $conn->prepare("INSERT INTO replies (author_name, reply, post_id) VALUES (:author_name, :reply, :post_id)");
        $insert->execute([
            'author_name' => $author_name,
            'reply' => $reply,
            'post_id' => $post_id
        ]);

        // Redirect to the single post page with the corresponding ID
        header("location: single.php?id=" . $post_id);
        exit();
    }
}

// Check if the post ID is passed through the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch all replies related to the post
    $allReplies = $conn->prepare("SELECT * FROM replies WHERE post_id = :id");
    $allReplies->execute(['id' => $id]);
    $replies = $allReplies->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch the single post data
    // Fix the SQL query to fetch from the posts table instead of replies
    $singlePost = $conn->prepare("SELECT * FROM posts WHERE id = :id"); // Fix: change from replies to posts
    $singlePost->execute(['id' => $id]);
    $single = $singlePost->fetch(PDO::FETCH_OBJ); // Fix: use fetch(PDO::FETCH_OBJ) to get a single object
} 
?>

<div style="margin-top: 43px;" class="col-lg-9 mb-3">
    <!-- Display the main post -->
    <div class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
        <div class="row align-items-center">
            <div class="col-md-12 mb-3 mb-sm-0">
                <h5>
                    <a href="#" class="text-primary"><?php echo $single->title; ?></a>
                </h5>
                <p>
                   <?php echo $single->body; ?>
                </p>
                <p class="text-sm">
                    <span class="op-6">Posted</span>
                    <a class="text-black" href="#"><?php echo $single->created_at; ?> by</a>
                    <a class="text-black" href="#"><?php echo $single->post_author; ?></a>
                </p>
                <div class="text-sm op-5">
                    <a class="text-black mr-2" href="#"><?php echo $single->category; ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment form -->
    <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
        <div class="row align-items-center">
            <div class="col-md-12 mb-3 mb-sm-0">
                <h5>
                    <a href="#" class="text-primary">Write Comment</a>
                </h5>
                <form method="POST" action="single.php?id=<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Author Name</label>
                        <input type="text" name="author_name" class="form-control" id="exampleFormControlInput1" placeholder="author name">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Reply</label>
                        <textarea class="form-control" name="reply" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="post_id" value="<?php echo $id; ?>" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Add Reply</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Display replies -->
    <?php foreach ($replies as $singleReply) : ?>
        <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
            <div class="row align-items-center">
                <div class="col-md-12 mb-3 mb-sm-0">
                    <h5>
                        <a href="#" class="text-primary"><?php echo $singleReply['author_name']; ?></a>
                    </h5>
                    <p>
                        <?php echo $singleReply['reply']; ?>
                    </p>
                    <p class="text-sm">
                        <span class="op-6">Commented</span>
                        <a class="text-black" href="#"><?php echo $singleReply['created_at']; ?></a>
                        ago
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require "includes/footer.php"; ?>
