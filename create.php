<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("location:index.php");
    exit;
}

include('connection.php');

$error = '';
$errors = [];

if (isset($_POST['create'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $department = isset($_POST['department']) ? trim($_POST['department']) : '';
    $roomno = isset($_POST['roomno']) ? trim($_POST['roomno']) : '';
    $contactnumber = isset($_POST['contactnumber']) ? trim($_POST['contactnumber']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

    if (empty($department)) {
        $errors['department'] = "Department is required.";
    }
    if (empty($roomno)) {
        $errors['roomno'] = "Room number is required.";
    }

    if (empty($contactnumber)) {
        $errors['contactnumber'] = "Contact number is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address.";
    }

    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM `student` WHERE `name` = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['name'] = 'User already exists!';
        } else {
            $query = "INSERT INTO `student` (`name`, `department`,`roomno`, `contactnumber`, `email`, `address`) VALUES (?, ?, ?, ?, ?,?)";
            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $department,$roomno, $contactnumber, $email, $address);

            if (mysqli_stmt_execute($stmt)) {
                header('Location: adminhome.php');
                exit;
            } else {
                $error = "Error: " . mysqli_stmt_error($stmt);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            margin: 50px auto;  
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        form{
            width: 25vw;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid black;
            border-radius: 3px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create</h1>
        <form method="post" action="">
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter a name" required>
            <?php if (isset($errors['name']) && isset($_POST['create'])): ?>
                <p class="error"><?php echo $errors['name']; ?></p>
            <?php endif; ?>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" placeholder="Enter a department" required>
            <?php if (isset($errors['department']) && isset($_POST['create'])): ?>
                <p class="error"><?php echo $errors['department']; ?></p>
            <?php endif; ?>

            <label for="roomno">Room.no:</label>
            <input type="text" id="roomno" name="roomno" placeholder="Enter a room number" required>
            <?php if (isset($errors['roomno']) && isset($_POST['create'])): ?>
                <p class="error"><?php echo $errors['roomno']; ?></p>
            <?php endif; ?>

            <label for="contactnumber">Contact Number:</label>
            <input type="text" id="contactnumber" name="contactnumber" placeholder="Enter a contact number" required>
            <?php if (isset($errors['contactnumber']) && isset($_POST['create'])): ?>
                <p class="error"><?php echo $errors['contactnumber']; ?></p>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter an email" required>
            <?php if (isset($errors['email']) && isset($_POST['create'])): ?>
                <p class="error"><?php echo $errors['email']; ?></p>
            <?php endif; ?>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter an address" required>
            <?php if (isset($errors['address']) && isset($_POST['create'])): ?>
                <p class="error"><?php echo $errors['address']; ?></p>
            <?php endif; ?>

            <button type="submit" name="create">Create</button>
        </form>
    </div>
</body>
</html>