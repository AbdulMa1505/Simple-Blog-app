<?php
// Start session and include database connection
session_start();
require 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}


if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $user_id = $_SESSION['user_id']; // Logged-in user's ID

    // Prepare a SQL query to check if the post belongs to the logged-in user
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id); // "ii" for two integers (post ID and user ID)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // The post exists and belongs to the user, proceed to delete it
        $stmt_delete = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt_delete->bind_param("i", $post_id);
        $stmt_delete->execute();

        if ($stmt_delete->affected_rows > 0) {
            // Post was successfully deleted
            $_SESSION['message'] = "Post successfully deleted.";
        } else {
            // Failed to delete the post
            $_SESSION['message'] = "Failed to delete the post.";
        }
    } else {
        // Post does not exist or doesn't belong to the user
        $_SESSION['message'] = "You are not authorized to delete this post.";
    }

    // Close the statement and redirect to dashboard
    $stmt->close();
    $stmt_delete->close();
    header("Location: dashboard.php");
    exit();
} else {
    // No post ID provided, redirect to dashboard
    $_SESSION['message'] = "No post ID specified.";
    header("Location: dashboard.php");
    exit();
}
?>
