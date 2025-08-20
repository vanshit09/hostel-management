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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
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
        .about, .highlights, .gallery, .testimonials{
            padding: 20px;
            margin-bottom: 30px;
        }
        .testimonial {
            background-color: #f9f9f9;
            color:black;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .testimonial cite {
            font-weight: bold;
        }
        
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
        }
        
        .image-grid img {
            width: 250px;
            height: 250px;
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
<div class="center">
    <h1>WELCOME TO </h1>
    <h1 style="color:red">Prime Boys Hostel</h1>
</div>
<div class="about">
        <h2>About Our Hostel</h2>
        <p>Established in 2020, Prime Boys Hostel has been providing travelers with a warm and friendly home away from home. Our mission is to create a welcoming and inclusive environment where adventurers from all walks of life can connect, share stories, and create unforgettable memories.</p>
        <p>We believe that travel is not just about visiting new places but also about embracing diverse cultures, meeting new people, and stepping out of your comfort zone. That's why our hostel is designed to be a vibrant hub where like-minded travelers can come together and forge lifelong friendships.</p>
    </div>


    <div class="gallery">
        <h2>Take a Look Inside</h2>
        <div class="image-grid">
            <img src="room.avif" alt="Hostel Room">
            <img src="lounge.jpeg" alt="Lounge Area">
            <img src="kitchen.jpg" alt="Shared Kitchen">
            <img src="tarrece.jpg" alt="Rooftop Terrace">
        </div>
    </div>

    <div class="testimonials">
        <h2>What Our Guests Say</h2>
        <div class="testimonial">
            <p>"This hostel was an absolute gem! The staff was incredibly friendly, the rooms were clean and comfortable, and the location was perfect for exploring the city. I'll definitely be staying here again on my next visit."</p>
            <cite>- Jane D.</cite>
        </div>
        <div class="testimonial">
            <p>"I had the best time at this hostel! The atmosphere was lively and welcoming, and I made so many new friends from all over the world. Highly recommended for solo travelers looking to meet amazing people."</p>
            <cite>- Alex T.</cite>
        </div>
    </div>
</body>
</html>
