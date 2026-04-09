<?php
require_once "../includes/auth.php";
requireLogin();

if (!isAdmin()) {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../dashboard.php");
exit();