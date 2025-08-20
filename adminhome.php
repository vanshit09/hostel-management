<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("location:index.php");
    exit;
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
    exit;
}

if (isset($_POST['create'])) {
    header("location:create.php");
    exit;
}
if (isset($_POST['frp'])) {
    header("location:frp.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        div.header {
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: #204969;
            color: white;
        }

        div.header button {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
        }

        .button {
            margin: 20px 10px;
        }

        .button input {
            padding: 10px;
            color: white;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            background-color: black;
        }

        .button input:hover {
            background-color: gray;
            cursor: pointer;
        }

        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .dataTable {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>WELCOME - <?php echo $_SESSION['admin_username']; ?></h1>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
    <div class="dataTable">
        <div class="button">
            <form method='POST'>
                <input type="submit" name="create" value="Create" />
                <input type="submit" name="frp" value="FindRoomPartner">
            </form>
        </div>
        <?php
        include ("connection.php");
        $sql = "SELECT id , name, department , roomno, contactnumber , email , address , status FROM student INNER JOIN payment_status USING(payment_id)";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                echo "<th>Id</th>";
                echo "<th>Name</th>";
                echo "<th>Department</th>";
                echo "<th>Room.no</th>";
                echo "<th>contactnumber</th>";
                echo "<th>email</th>";
                echo "<th>address</th>";
                echo "<th>payment_status</th>";
                echo "<th>action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['roomno'] . "</td>";
                    echo "<td>" . $row['contactnumber'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo '<td> <button><a href="update.php?updateid=' . $id . '">update</a></button> <button><a href="delete.php?deleteid=' . $id . '">delete</a></button> </td>';
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo '<em>No records were found.</em>';
            }
            mysqli_close($link);
        }
        ?>
    </div>
</body>

</html>