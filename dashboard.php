<?php

session_start();
require 'connect.php'; 


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC"; 
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            padding: 20px;
            background-color: #f0f0f0;
            border-right: 1px solid #ddd;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .list-group-item {
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .list-group-item:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h3 class="text-center mb-4">Simple Blog</h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="dashboard.php">Dashboard</a>
                    <i class="fa-solid fa-chart-line"></i>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="post.php">Create Post</a>
                    <i class="fa-solid fa-file-plus"></i>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="logout.php">Logout</a>
                    <i class="fa-solid fa-sign-out-alt"></i>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row mb-4">
                <div class="col-12">
                    <h1>Welcome, <strong><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?></strong>!</h1>
                    <p class="lead text-center">Manage your blog posts and activity here.</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <a href="post.php" class="btn btn-primary">Create New Post</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2>Your Posts</h2>
                    <?php if ($result->num_rows > 0): ?>
                        <div class="list-group">
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <div class="list-group-item mb-3">
                                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                    <p>Posted on: <?php echo date('F j, Y', strtotime($row['created_at'])); ?></p>
                                    <p><?php echo substr(htmlspecialchars($row['content']), 0, 150); ?>...</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="post.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info me-2">View Full Post</a>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>No posts found. <a href="create_post.php">Create a new post now!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>