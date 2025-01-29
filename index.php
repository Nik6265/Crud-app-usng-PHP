<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center display-4 my-5 text-dark font-weight-bold text-uppercase shadow-sm bg-info p-3 rounded border border-primary">
        CRUD APPLICATION
    </h1>
    <div class="container">
   
    <div class="d-flex justify-content-between align-items-center box1 m-3">
    <h2 class="text-left bg-white text-secondary mb-0 m-3">All Students</h2>

    <!-- Search Form -->
    <form action="search_student.php" method="GET" class="d-flex">
        <input type="text" name="name" class="form-control me-2" placeholder="Search by Name" required>
        <button type="submit" class="btn btn-success">Search</button>
    </form>

    <!-- Sorting Form -->
    <form action="sort_student.php" method="GET" class="d-flex">
        <label class="me-2">Sort By:</label>
        <select name="sort_by" class="form-control me-2">
            <option value="name">Name</option>
            <option value="age">Age</option>
            <option value="id">id</option>
        </select>
        <button type="submit" class="btn btn-warning">Sort</button>
    </form>

    <!-- Button to trigger Add modal -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
</div>



    
        
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
                    // Include database connection
                    include 'db.php';

                    // Check if connection is successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all students
                    $sql = "SELECT * FROM `students`";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    // Display the data in table rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['age']}</td>
                                <td>{$row['email']}</td>
                                <td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#updateStudentModal' data-id='{$row['id']}' data-first_name='{$row['first_name']}' data-last_name='{$row['last_name']}' data-age='{$row['age']}' data-email='{$row['email']}'>Update</button></td>
                                <td><a href='delete_student.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a></td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>

        <!-- Add Student Modal -->
        <form action="add_student.php" method="POST">
            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Student</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Update Student Modal -->
        <form action="update_student.php" method="POST">
            <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateStudentModalLabel">Update Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        // Pre-fill update modal with selected student's data
        const updateModal = document.getElementById('updateStudentModal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const firstName = button.getAttribute('data-first_name');
            const lastName = button.getAttribute('data-last_name');
            const age = button.getAttribute('data-age');
            const email = button.getAttribute('data-email');
            
            document.getElementById('update_id').value = id;
            document.getElementById('update_first_name').value = firstName;
            document.getElementById('update_last_name').value = lastName;
            document.getElementById('update_age').value = age;
            document.getElementById('update_email').value = email;
        });
    </script>
</body>
</html>
