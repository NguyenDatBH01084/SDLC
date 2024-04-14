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
    <!-- <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style> -->
</head>

<body>
<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "btec-database";

    // Create a connection
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the SELECT query
    $query = "SELECT ID, Name, Email, PhoneNumber, Address, Gender FROM student";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Error executing the query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
?>
    <h2>Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>PhoneNumber</th>
            <th>Address</th>
            <th>Gender</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['PhoneNumber']; ?></td>
                <td><?php echo $row['Address']; ?></td>
                <td><?php echo $row['Gender']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>