<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit;
}

require("connection.php");

$id = isset($_GET['updateid']) ? $_GET['updateid'] : null;

if ($id === null) {
    die("Error: ID not provided.");
}

$sql = "SELECT id, name, department, roomno, contactnumber, email, address, payment_id FROM student WHERE id=?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Error: No student found with the provided ID.");
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$department = $row['department'];
$roomno = $row['roomno'];
$contactnumber = $row['contactnumber'];
$email = $row['email'];
$address = $row['address'];
$payment_id = $row['payment_id'];
$errors = [];

if (isset($_POST['update'])) {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $department = trim(filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING));
    $roomno = trim(filter_input(INPUT_POST, 'roomno', FILTER_SANITIZE_STRING));
    $contactnumber = trim(filter_input(INPUT_POST, 'contactnumber', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
    $payment_id = trim(filter_input(INPUT_POST, 'payment_id', FILTER_SANITIZE_STRING));

    // Validation
    $required_fields = [
        'name' => 'Name is required.',
        'department' => 'Department is required.',
        'roomno' => 'Room no is required.',
        'contactnumber' => 'Contact Number is required.',
        'email' => 'Email is required.',
        'address' => 'Address is required.',
        'payment_id' => 'Payment ID is required.'
    ];

    foreach ($required_fields as $field => $error_message) {
        if (empty($$field)) {
            $errors[$field] = $error_message;
        }
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    if (empty($errors)) {
        $sql = "UPDATE student SET name=?, department=?, roomno=?, contactnumber=?, email=?, address=?, payment_id=? WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $name, $department, $roomno, $contactnumber, $email, $address, $payment_id, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header('Location: adminhome.php');
            exit;
        } else {
            echo 'Error: ' . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }

        .container {
            margin: 50px auto;
            max-width: 700px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
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
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        form{
            width: 25vw;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 1rem;
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
        <h1>Update Student</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?updateid=' . $id; ?>">
            <?php
            $fields = [
                'name' => 'Name',
                'department' => 'Department',
                'roomno' => 'Room No',
                'contactnumber' => 'Contact Number',
                'email' => 'Email',
                'address' => 'Address',
                'payment_id' => 'Payment ID'
            ];

            foreach ($fields as $field => $label) {
                echo "<label for='{$field}'>{$label}:</label>";
                $type = ($field == 'email') ? 'email' : 'text';
                $value = htmlspecialchars($$field);
                echo "<input type='{$type}' id='{$field}' name='{$field}' value='{$value}' required>";
                if (isset($errors[$field])) {
                    echo "<p>{$errors[$field]}</p>";
                }
            }
            ?>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
