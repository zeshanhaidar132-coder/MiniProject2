<?php
require_once "../includes/auth.php";
requireLogin();

if (!isAdmin()) {
    header("Location: ../dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $credits = (int) $_POST['credits'];

    $stmt = $conn->prepare("UPDATE courses SET course_code = ?, course_name = ?, credits = ? WHERE id = ?");
    $stmt->bind_param("ssii", $course_code, $course_name, $credits, $id);
    $stmt->execute();
}

header("Location: ../dashboard.php");
exit();