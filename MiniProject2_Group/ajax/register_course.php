<?php
require_once "../includes/auth.php";
requireLogin();

if (isAdmin()) {
    echo "Admins cannot register courses.";
    exit();
}

$course_id = (int) $_POST['course_id'];
$user_id = $_SESSION['user_id'];

$check = $conn->prepare("SELECT id FROM registrations WHERE user_id = ? AND course_id = ?");
$check->bind_param("ii", $user_id, $course_id);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    echo "You already registered this course.";
    exit();
}

$stmt = $conn->prepare("INSERT INTO registrations (user_id, course_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $course_id);

if ($stmt->execute()) {
    echo "Course registered successfully.";
} else {
    echo "Registration failed.";
}