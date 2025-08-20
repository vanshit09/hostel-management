<?php
include 'connection.php';

$errors = [];

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $usertype = trim($_POST['usertype']);


    if (empty($username)) {
        $errors['username'] = "Username must be filled out";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address";
    }

    if (empty($password)) {
        $errors['password'] = "Password must be filled out";
    }

    if ($password !== $cpassword) {
        $errors['cpassword'] = "Passwords do not match";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM `admin` WHERE `username` = '$username'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            $errors['username_exists'] = "User already exists!";
        }
    }

    if (empty($errors)) {
        $query = "INSERT INTO `admin` (`username`, `email`, `password`, `usertype`) VALUES ('$username', '$email', '$password', '$usertype')";
        mysqli_query($link, $query);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
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
            max-width: 700px;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        input[type="password"],
        select {
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
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h1>Register Now</h1>
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            <?php if (isset($errors['username'])) { ?>
                <p style="color:red;"><?php echo $errors['username']; ?></p>
            <?php } ?>
            <?php if (isset($errors['username_exists'])) { ?>
                <p style="color:red;"><?php echo $errors['username_exists']; ?></p>
            <?php } ?>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            <?php if (isset($errors['email'])) { ?>
                <p style="color:red;"><?php echo $errors['email']; ?></p>
            <?php } ?>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            <?php if (isset($errors['password'])) { ?>
                <p style="color:red;"><?php echo $errors['password']; ?></p>
            <?php } ?>
            <label for="cpassword">Confirm Password:</label>
            <input type="password" name="cpassword" placeholder="Confirm your password" required>
            <?php if (isset($errors['cpassword'])) { ?>
                <p style="color:red;"><?php echo $errors['cpassword']; ?></p>
            <?php } ?>
            <label for="usertype">User Type:</label>
            <select id="usertype" name="usertype">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now">
            <p>Already have an account? <a href="index.php">Login now</a></p>
        </form>
    </div>
</body>

</html>