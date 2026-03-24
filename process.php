
<?php
include 'db_config.php';
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $age = $_POST['age'];
    $sql = "INSERT INTO students (name, branch, age) VALUES 
('$name', '$branch', '$age')";
    if (mysqli_query($conn, $sql)) {
        echo "<h2>Student Registered Successfully!</h2>";
        echo "<p><b>Name:</b> $name</p>";
        echo "<p><b>Branch:</b> $branch</p>";
        echo "<p><b>Age:</b> $age</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>