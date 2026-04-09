<?php require_once __DIR__ . "/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Polytechnic Course Registration System (PCRS)</a>
        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-sm btn-light">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mt-4">