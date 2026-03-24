<?php
include 'db_config.php';
// Delete by ID (from view.php)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<h2>Student Deleted Successfully!</h2>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
// Delete by Name (from delete.html)
if (isset($_POST['delete'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql = "DELETE FROM students WHERE name = '$name'";
    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "<h2>Student '$name' Deleted 
Successfully!</h2>";
        } else {
            echo "<h2>Student '$name' Not Found!</h2>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
<br>
<a href="register.html">Register New Student</a> | 
<a href="view.php">View All Students</a> | 
<a href="delete.html">Delete Another</a>