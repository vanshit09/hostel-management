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
    <title>Contact Us </title>
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
        .img1{
            width:40px;
            height:40px;
            float:left;
            padding-top:10px;
            padding-bottom:20px;
        }
        .img2{
            width:50px;
            height:55px;
            float:left;
            padding-top:15px;
            padding-bottom:20px;
        }
        .img3{
            width:50px;
            height:50px;
            float:left;
            padding-top:5px;
        }
        h3{
            margin-left:100px;
        }
        .e1{
            padding-top:15px;
        }
        .e2{
            padding-top:30px;
        }
        .e3{
            padding-top:15px;
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
        <div>
            <h1><center>Contact Us</center></h1>
            <div><img class="img1" src="whatsapp.jpg">
            <h3 class="e1">7574055241,8469372385,9328144213</h3>
            </div><br>
            <div><img class="img2" src="instagram.png">
            <h3 class="e2">vansh_it9,smit_kachariya,ganvit_harsh</h3>
            </div><br>
            <div>
                <img class="img3" src="gmail.jpg">
                <h3 class="e3">gadoyavanshit10@gmail.com,smitkachariya128@gmail.com,harshganvit23@gamil.com</h3>
            </div>
</div>
    </body>
</html>
