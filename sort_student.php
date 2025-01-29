<?php
// Include database connection
include 'db.php';

// Get sorting preference
$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

// Base SQL query
$sql = "SELECT * FROM students";

// Sorting Logic
if ($sortBy == 'name') {
    $sql .= " ORDER BY first_name ASC, last_name ASC";
} elseif ($sortBy == 'age') {
    $sql .= " ORDER BY age ASC";
}
else{
    $sql .= " ORDER BY `id`";
}

// Execute query
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorted Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center text-primary">Sorted Students List</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Back to Main Page -->
            <a href="index.php" class="btn btn-secondary">⬅ Back to Home</a>

            <!-- Sort Again -->
            <form action="sort_student.php" method="GET" class="d-flex">
                <label class="me-2">Sort By:</label>
                <select name="sort_by" class="form-control me-2">
                    <option value="name" <?= ($sortBy == 'name') ? 'selected' : '' ?>>Name</option>
                    <option value="age" <?= ($sortBy == 'age') ? 'selected' : '' ?>>Age</option>
                </select>
                <button type="submit" class="btn btn-warning">Sort Again</button>
            </form>
        </div>

        <!-- Display Sorted Data -->
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateStudentModal"
                                data-id="<?= $row['id'] ?>"
                                data-first_name="<?= $row['first_name'] ?>"
                                data-last_name="<?= $row['last_name'] ?>"
                                data-age="<?= $row['age'] ?>"
                                data-email="<?= $row['email'] ?>">
                                Update
                            </button>
                        </td>
                        <td>
                            <a href="delete_student.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
