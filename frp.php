<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("location:index.php");
    exit;
}

$roomno_error = '';
if (isset($_POST['find'])) {
    $roomno = $_POST['roomno'];

    // Validate room number
    if (empty($roomno)) {
        $roomno_error = "Room number is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $roomno)) {
        $roomno_error = "Room number can only contain letters and digits.";
    } else {
        include ("connection.php");
        $sql = "SELECT id, name, department, roomno, contactnumber, email, address, status FROM student INNER JOIN payment_status USING(payment_id) WHERE roomno = '$roomno'";
        $result = mysqli_query($link, $sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Room Partner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-container {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Find Room Partner</h1>
        <div class="form-container">
            <form method="post">
                <input type="text" id="roomno" name="roomno" placeholder="Enter Room Number"
                    value="<?php echo isset($_POST['roomno']) ? $_POST['roomno'] : ''; ?>">
                <span class="error"><?php echo $roomno_error; ?></span>
                <br>
                <input type="submit" name="find" value="Find">
            </form>
        </div>

        <?php
        if (isset($result)) {
            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                echo "<th>Id</th>";
                echo "<th>Name</th>";
                echo "<th>Department</th>";
                echo "<th>Room No.</th>";
                echo "<th>Contact Number</th>";
                echo "<th>Email</th>";
                echo "<th>Address</th>";
                echo "<th>Payment Status</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['roomno'] . "</td>";
                    echo "<td>" . $row['contactnumber'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo '<p>No students found for the entered room number.</p>';
            }

            mysqli_close($link);
        }
        ?>
        <a href="adminhome.php" class="back-button">Back</a>
    </div>
</body>

</html>