<?php
include 'db.php';

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='blog-post'><h2>" . $row["title"] . "</h2><p>" . $row["content"] . "</p></div>";
    }
} else {
    echo "<p>No posts yet.</p>";
}

$conn->close();
?>
