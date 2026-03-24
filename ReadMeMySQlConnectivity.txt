PhP MySQL Connectivity
----------------------------
1-Start Apache from XAMP Menu
2-Access MYSQL CLI (password students(through the MySql Search facility
3-Create a required database and table first on mysql cli
4-create blelow files in c:xamp/htdoc/db
db/
├── register.html          (Registration form)
├── delete.html           (Delete by name form)
├── db_config.php         (Database connection)
├── process.php           (Save student)
├── view.php              (View all students)
├── edit.php              (Edit student form)
├── update_process.php    (Update student)
└── delete_process.php    (Delete student)


Table: students
---------------
CREATE TABLE Students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    branch VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



db_config.php
##############
<?php

$host = 'localhost';
$username = 'root';
$password = 'student';  
$database = 'student_db';
// Create connection
$conn = mysqli_connect($host, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


register.html
#############

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration Form</h2>
    <form action="http://127.0.0.1/db/process.php" method="POST">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" 
required></td>
            </tr>
            <tr>
                <td>Branch:</td>
                <td>
                    <select name="branch" required>
                        <option value="">Select Branch</option>
                        <option value="Computer 
Engineering">Computer Engineering</option>
                        <option value="Information 
Technology">Information Technology</option>
                        <option value="Mechanical 
Engineering">Mechanical Engineering</option>
                        <option value="Civil Engineering">Civil 
Engineering</option>
                        <option value="Electronics 
Engineering">Electronics Engineering</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input type="number" name="age" min="17" 
max="45" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="save" 
value="SAVE">
<td> <input type="reset" value="Clear">
 </td>
            </tr>
        </table>
    </form>
    <br>
                    
                </td>
    <a href="view.php">View All Students</a> | 
    <a href="delete.html">Delete Student</a>
</body>
</html>


process.php
###########

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

edit.php
#########################
<?php
include 'db_config.php';
$id = $_GET['id'];
// Fetch student data
$sql = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Information</h2>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo 
$student['id']; ?>">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php 
echo $student['name']; ?>" required></td>
            </tr>
            <tr>
                <td>Branch:</td>
                <td>
                    <select name="branch" required>
                        <option value="Computer Engineering" <?
php if($student['branch']=='Computer Engineering') echo 
'selected'; ?>>Computer Engineering</option>
                        <option value="Information Technology" 
<?php if($student['branch']=='Information Technology') echo 
'selected'; ?>>Information Technology</option>
                        <option value="Mechanical Engineering" 
<?php if($student['branch']=='Mechanical Engineering') echo 
'selected'; ?>>Mechanical Engineering</option>
                        <option value="Civil Engineering" <?php 
if($student['branch']=='Civil Engineering') echo 'selected'; ?>
>Civil Engineering</option>
                        <option value="Electronics Engineering" 
<?php if($student['branch']=='Electronics Engineering') echo 
'selected'; ?>>Electronics Engineering</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input type="number" name="age" value="<?
php echo $student['age']; ?>" min="17" max="45" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="update" 
value="UPDATE">
                    <a href="view.php">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php mysqli_close($conn); ?>


view.php
############
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

delete.html
###########
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
</head>
<body>
    <h2>Delete Student by Name</h2>
    <form action="delete_process.php" method="POST">
        <table>
            <tr>
                <td>Enter Student Name:</td>
                <td><input type="text" name="name" 
required></td>
            </tr>
            <tr>
                <td colspan="2">

                    <input type="submit" name="delete" value="DELETE">
                </td>
            </tr>
        </table>
    </form>
    <br>
    <a href="register.html">Back to Registration</a> | 
    <a href="view.php">View All Students</a>
</body>
</html>


delete_process.php
##################
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


update_process.php
###################
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
