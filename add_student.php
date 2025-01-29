<?php
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['age']) && isset($_POST['email'])) {
    include 'db.php';
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO `students`(`first_name`, `last_name`, `age`, `email`) VALUES ('$first_name', '$last_name', '$age', '$email')";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    else {
        echo "Student added successfully!";
    }
    // return Response::json($result);
    
    header("Location: index.php");
}