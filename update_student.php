<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name', age='$age', email='$email' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Student updated successfully!";
    } else {
        echo "Error updating student: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: index.php"); // Redirect back to the main page
}
?>
