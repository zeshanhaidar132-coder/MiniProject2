<?php
require_once "../includes/auth.php";
requireLogin();

if (!isAdmin()) {
    header("Location: ../dashboard.php");
    exit();
}

$course_code = trim($_POST['course_code']);
$course_name = trim($_POST['course_name']);
$credits = (int) $_POST['credits'];

if ($course_code !== '' && $course_name !== '' && $credits > 0) {
    $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, credits) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $course_code, $course_name, $credits);
    $stmt->execute();
}

header("Location: ../dashboard.php");
exit();