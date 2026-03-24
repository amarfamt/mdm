<?php
include 'db_config.php';
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name']);
    $branch = $_POST['branch']);
    $age = $_POST['age']);
    $sql = "UPDATE students SET name='$name', branch='$branch', 
age='$age' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<h2>Student Updated Successfully!</h2>";
        echo "<p><b>Name:</b> $name</p>";
        echo "<p><b>Branch:</b> $branch</p>";
        echo "<p><b>Age:</b> $age</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
<br>
<a href="view.php">View All Students</a> | 
<a href="register.html">Register New Student</a>