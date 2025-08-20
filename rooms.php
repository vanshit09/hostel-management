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
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <style>
          body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg');
            background-size: cover;
            color: white;
        }
        ul {
            list-style-type: disc;
            margin: 1em 0;
            padding-left: 1.5em;
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
        }
        div.header button {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
        }
        td{
            text-align:center;
        }
        img:hover{
            transform:scale(1.2);
        }
        </style>
</head>
<body>
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
        <table style="width:100%">
        <tr>
            <th>
                Number of person in room
            </th>
            <th>Pic of room</th>
        </tr>
        <tr>
            <td><h3>Single sharing room</h3></td>
            <td><img src="room4.jpg" height=300px width=300px></td>
        </tr>
        <tr>
            <td><h3>Double sharing room</h3></td>
            <td><img src="room2.jpg" height=300px width=300px></td>
        </tr>
        <tr>
            <td><h3>4 sharing room</h3></td>
            <td><img src="room1.jpg" height=300px width=300px></td>
        </tr>
        <tr>
            <td><h3>6 sharing room</h3></td>
            <td><img src="room3.jpg" height=300px width=300px></td>
        </tr>
        </table>
</body>
</hmtl>