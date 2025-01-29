<?php
include 'db.php';

// Get the search query
$name = isset($_GET['name']) ? $_GET['name'] : '';

// Fetch students based on search
$sql = "SELECT * FROM `students` WHERE first_name LIKE '%$name%' OR last_name LIKE '%$name%'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Search Results for "<?php echo htmlspecialchars($name); ?>"</h2>

        <!-- Search Form Again -->
        <form action="search_student.php" method="GET" class="d-flex mb-3">
            <input type="text" name="name" class="form-control me-2" placeholder="Search by Name" required>
            <button type="submit" class="btn btn-success">Search</button>
            <a href="index.php" class="btn btn-secondary ms-2">Back</a>
        </form>

        <table class="table table-bordered table-striped table-hover">
            <thead>
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
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['age']}</td>
                                <td>{$row['email']}</td>
                                <td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#updateStudentModal' 
                                    data-id='{$row['id']}' data-first_name='{$row['first_name']}' data-last_name='{$row['last_name']}' 
                                    data-age='{$row['age']}' data-email='{$row['email']}'>Update</button></td>
                                <td><a href='delete_student.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No students found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Update Student Modal -->
    <form action="update_student.php" method="POST">
        <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStudentModalLabel">Update Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="update_id" name="id">
                        <div class="mb-3">
                            <label for="update_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="update_first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="update_last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="update_age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="update_email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Pre-fill update modal with selected student's data
        document.getElementById('updateStudentModal').addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            document.getElementById('update_id').value = button.getAttribute('data-id');
            document.getElementById('update_first_name').value = button.getAttribute('data-first_name');
            document.getElementById('update_last_name').value = button.getAttribute('data-last_name');
            document.getElementById('update_age').value = button.getAttribute('data-age');
            document.getElementById('update_email').value = button.getAttribute('data-email');
        });
    </script>
</body>
</html>
