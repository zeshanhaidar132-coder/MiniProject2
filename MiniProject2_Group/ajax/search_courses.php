<?php
require_once "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    exit("Please login first");
}

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

$like = "%" . $search . "%";

$stmt = $conn->prepare("SELECT * FROM courses WHERE course_code LIKE ? OR course_name LIKE ? ORDER BY id DESC");
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                    <td>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <a href="admin/delete_course.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <?php else: ?>
                            <button class="btn btn-primary btn-sm register-course" data-id="<?php echo $row['id']; ?>">Register</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No courses found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>