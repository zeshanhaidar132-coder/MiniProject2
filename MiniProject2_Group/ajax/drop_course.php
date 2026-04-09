<?php
require_once "../includes/auth.php";
requireLogin();

if (isAdmin()) {
    echo "Admins cannot drop courses.";
    exit();
}

$course_id = (int) $_POST['course_id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM registrations WHERE user_id = ? AND course_id = ?");
$stmt->bind_param("ii", $user_id, $course_id);

if ($stmt->execute()) {
    echo "Course dropped successfully.";
} else {
    echo "Drop failed.";
}