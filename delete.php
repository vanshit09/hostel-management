<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("location:index.php");
    exit;
}

?>
<?php
require('connection.php');
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql = "DELETE FROM student WHERE id = $id";
    $result=mysqli_query($link,$sql);
    if($result){
        header('location:adminhome.php');
    }else {
        echo"Data delte error";
    }
}
?>
