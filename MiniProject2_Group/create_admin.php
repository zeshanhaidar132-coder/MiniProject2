<?php
require_once "config/db.php";

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);
$role = "admin";

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);

if ($stmt->execute()) {
    echo "Admin created successfully";
} else {
    echo "Error: " . $conn->error;
}
?>