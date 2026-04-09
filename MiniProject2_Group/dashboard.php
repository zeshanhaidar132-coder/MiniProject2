<?php
require_once "includes/auth.php";
requireLogin();
include "includes/header.php";
?>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4>Welcome, <?php echo e($_SESSION['username']); ?></h4>
        <p class="mb-0">Role: <strong><?php echo e($_SESSION['role']); ?></strong></p>
    </div>
</div>

<?php if (isAdmin()): ?>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4>Add Course</h4>
        <form action="admin/add_course.php" method="POST">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="course_code" class="form-control" placeholder="Course Code" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="course_name" class="form-control" placeholder="Course Name" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4>Search Courses</h4>
        <input type="text" id="search" class="form-control" placeholder="Search by code or name">
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4>Available Courses</h4>
        <div id="course-list">Loading courses...</div>
    </div>
</div>

<?php if (!isAdmin()): ?>
<div class="card shadow-sm">
    <div class="card-body">
        <h4>My Registered Courses</h4>

        <?php
        $stmt = $conn->prepare("
            SELECT courses.id, courses.course_code, courses.course_name
            FROM registrations
            JOIN courses ON registrations.course_id = courses.id
            WHERE registrations.user_id = ?
        ");
        $stmt->bind_param("i", $_SESSION['user_id']);
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
                        <td><?php echo e($row['course_code']); ?></td>
                        <td><?php echo e($row['course_name']); ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm drop-course" data-id="<?php echo $row['id']; ?>">Drop</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No registered courses yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php include "includes/footer.php"; ?>