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