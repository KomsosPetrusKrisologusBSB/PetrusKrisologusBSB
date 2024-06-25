<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

// Fetch news from database
$news_sql = "SELECT * FROM news";
$news_result = $conn->query($news_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>

    <h2>Manage News</h2>
    <form method="POST" action="add_news.php">
        <h3>Add News</h3>
        <div>
            <label>Title</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Content</label>
            <textarea name="content" required></textarea>
        </div>
        <button type="submit">Add</button>
    </form>

    <h3>Existing News</h3>
    <?php if ($news_result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $news_result->fetch_assoc()): ?>
                <li>
                    <h4><?php echo $row['title']; ?></h4>
                    <p><?php echo $row['content']; ?></p>
                    <a href="delete_news.php?id=<?php echo $row['id']; ?>">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No news found.</p>
    <?php endif; ?>
</body>
</html>
