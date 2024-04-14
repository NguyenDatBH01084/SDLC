<!DOCTYPE html>
<html>
<head>
    <style>
        /* Table Styles */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr.rainbow-row {
            animation: rainbow 5s infinite;
        }
        tr:hover {
            background-color: #e5e5e5;
        }

        /* Heading Style */
        h2 {
            color: #333;
            background-color: #f2f2f2;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
    
</head>
<body>
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "btec-database";

$conn = new mysqli($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Xử lý thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO student (ID, Name, Email, PhoneNumber, Address, Gender) VALUES ('$id', '$name', '$email', '$phone', '$address', '$gender')";

    if (mysqli_query($conn, $query)) {
        echo "Student added successfully.";
    } else {
        echo "Error adding student: " . mysqli_error($conn);
    }
}

// Xử lý sửa sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $query = "UPDATE student SET ID='$id', Name='$name', Email='$email', PhoneNumber='$phone', Address='$address', Gender='$gender' WHERE ID='$id'";

    if (mysqli_query($conn, $query)) {
        echo "Student updated successfully.";
    } else {
        echo "Error updating student: " . mysqli_error($conn);
    }
}
// Xử lý xóa sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_student'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM student WHERE ID='$id'";

    if (mysqli_query($conn, $query)) {
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM student";
$result = mysqli_query($conn, $query);

if ($result) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<h2>Students</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rows as $row) { ?>
        <tr onclick="selectStudent('<?php echo $row['ID']; ?>', '<?php echo $row['Name']; ?>', '<?php echo $row['Email']; ?>', '<?php echo $row['PhoneNumber']; ?>', '<?php echo $row['Address']; ?>', '<?php echo $row['Gender']; ?>')">
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['PhoneNumber']; ?></td>
            <td><?php echo $row['Address']; ?></td>
            <td><?php echo $row['Gender']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                    <button type="submit" name="delete_student">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<div>
    <h2>Add Student</h2>
    <form method="post" action="">
        <input type="text" name="id" placeholder="ID" required><br>
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone Number" required><br>
        <input type="text" name="address" placeholder="Address" required><br>
        <input type="text" name="gender" placeholder="Gender" required><br>
        <button type="submit" name="add_student">Add Student</button>
    </form>

    <h2>Edit Student</h2>
    <form method="post" action="" id="edit-form">
        <input type="text" name="id" placeholder="ID" required><br>
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone Number" required><br>
        <input type="text" name="address" placeholder="Address" required><br>
        <input type="text" name="gender" placeholder="Gender" required><br>
        <button type="submit" name="edit_student">Edit Student</button>
    </form>
</div>

<script>
    editSelectedStudent();

    function selectStudent(id, name, email, phone, address, gender) {
        selectedStudent = {
            id: id,
            name: name,
            email: email,
            phone: phone,
            address: address,
            gender: gender
        };
        updateEditForm();
    }

    function updateEditForm() {
        if (selectedStudent) {
            document.getElementById("edit-form").id.value = selectedStudent.id;
            document.getElementById("edit-form").name.value = selectedStudent.name;
            document.getElementById("edit-form").email.value = selectedStudent.email;
            document.getElementById("edit-form").phone.value = selectedStudent.phone;
            document.getElementById("edit-form").address.value = selectedStudent.address;
            document.getElementById("edit-form").gender.value = selectedStudent.gender;
        }
    }
</script>

<script>
editSelectedStudent();
</script>
</body>
</html>