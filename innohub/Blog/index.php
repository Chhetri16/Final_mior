<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to My Blog</h1>
        <a href="write_post.php">Write a New Post</a>
        <div class="blog-posts">
            <?php include 'display_posts.php'; ?>
        </div>
    </div>
</body>
</html>
