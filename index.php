<?php
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="project.css">
</head>
<style>
  body {
    color: black;
  }
  p {
    color: black;
    font-size: 20px;
  }
  a{
    color:blue;

  }
</style>
<body>

  <div class="container">

    <h1>Welcome To Hostel Management System</h1>

    <h2>Login</h2>

    <form method="POST">

      <div class="font">
        <label for="username">username:</label>
        <input text id="username" name="username" placeholder="Enter your username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" text id="password" name="password" placeholder="Enter your password" required><br><br>
        <button class="btn" type="submit" name="login">Login</button>
        <p>are you haven't register yet?   <a href="Register.php">register</a></p>
      </div>

      <?php

      session_start();
      $error_message=" ";

      if (isset($_POST['login'])) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $errors = [];

        if ($username) {
          $username = trim($username);
          if ($username === '') {
            $errors['username'] = 'Username is required.';
            echo '<p style="color: red;">' . $errors['username'] . '</p>';
          }
        } else {
          $errors['username'] = 'Username is required.';
          echo '<p style="color: red;">' . $errors['username'] . '</p>';
        }
        

        if ($password) {
          $password = trim($password);
          if ($password === '') {
            $errors['password'] = 'Password is required.';
            echo '<p style="color: red;">' . $errors['password'] . '</p>';
          }
        } else {
          $errors['password'] = 'Password is required.';
          echo '<p style="color: red;">' . $errors['password'] . '</p>';
        } 
        if (empty($errors)) {
        $stmt = mysqli_prepare($link, "SELECT * FROM `admin` WHERE `username`=? AND `password`=?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);

          if ($row['usertype'] == 'admin') {
            $_SESSION['admin_username'] = $row['username'];
            header('Location: adminhome.php');
            exit; 
          } elseif ($row['usertype'] == 'user') {
            $_SESSION['user_username'] = $row['username'];
            header('Location: userhome.php');
            exit;
          }
        } else {
          echo '<p style="color: red;">Incorrect username or password!</p>';
        }

        mysqli_stmt_close($stmt); 
      }
    }
      ?>

    </form>

  </div>

</body>
</html>
