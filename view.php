<?php
include 'db_config.php';
$sql = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
</head>
<body>
    <h2>All Registered Students</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Branch</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=" . $row['id'] . 
"'>Edit</a> | ";
                echo "<a href='delete_process.php?id=" . 
$row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No students 
found</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
    <br>
    <a href="register.html">Add New Student</a>
</body>
</html>