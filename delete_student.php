<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the student by ID
    $sql = "DELETE FROM students WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Student deleted successfully!";
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: index.php"); // Redirect back to the main page
    exit();
} else {
    echo "Invalid request!";
    exit();
}
?>
