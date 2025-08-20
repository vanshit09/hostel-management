<?php
session_start();
if (!isset($_SESSION['user_username'])) {
    header("location:index.php");
    exit;
}
?>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
    exit;
}
?>
<?php
require ('connection.php');

$errors = [];

if (isset($_GET['submit'])) {
    $name = trim($_GET['name']);
    $email = trim($_GET['email']);
    $rating = trim($_GET['rating']);
    $comments = trim($_GET['comments']);


    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }


    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($comments)) {
        $errors['comments'] = "Comments are required.";
    }
    if (empty($errors)) {
        $query = "INSERT INTO `feedback` (`name`, `email`, `rating`, `comments`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $rating, $comments);

        if (mysqli_stmt_execute($stmt)) {
            header('location:userhome.php');
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($link);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg');
            background-size: cover;
            color: white;
        }

        ul {
            list-style-type: none;
            margin: 10px;
            padding: 0;
        }

        nav {

            background-color: #333;
            list-style-type: none;
        }

        nav ul {
            overflow: hidden;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #555;
        }

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

        .center {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <div class="header">
            <h1>WELCOME - <?php echo $_SESSION['user_username'] ?></h1>
            <form method="post">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
        <nav>
            <ul>
                <li><a href="userhome.php">home</a></li>
                <li><a href="rooms.php">rooms</a></li>
                <li><a href="contactus.php">contactus</a></li>
                <li><a href="feedback.php">feedback</a></li>
            </ul>
        </nav>
    </header>
    <div class="center">
        <h1>Feedback Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required placeholder="Enter your name" required><br>
            <?php if (!empty($errors['name'])): ?>
                <p class="error"><?php echo $errors['name']; ?></p>
            <?php endif; ?>
            <br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required placeholder="Enter Your email" required><br>
            <?php if (!empty($errors['email'])): ?>
                <p class="error"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
            <br>
            <label for="rating">Rate our website:</label><br>
            <select id="rating" name="rating">
                <option value="excellent">Excellent</option>
                <option value="good">Good</option>
                <option value="average">Average</option>
                <option value="poor">Poor</option>
            </select><br>
            <br>
            <label for="comments">Comments:</label><br>
            <textarea id="comments" name="comments" rows="4" cols="50"
                placeholder="Enter some comments">required</textarea><br>
            <?php if (!empty($errors['comments'])): ?>
                <p class="error"><?php echo $errors['comments']; ?></p>
            <?php endif; ?>
            <br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>

</html>