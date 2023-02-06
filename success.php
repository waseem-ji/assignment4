<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "mytestdatabase";

$conn = new mysqli($servername,$username,$password,$database);

$fname = "";
$lname = "";
$email = "";
$phone = "";
$user_message = "";

$phone = $_GET['phone'];

// echo "email id is $email";



$sql = "SELECT * FROM feedback WHERE phone=$phone;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$fname = $row['firstname'];
$lname = $row['lastname'];
$email = $row['email'];
$phone = $row['phone'];
$user_message = $row['message'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Successfull</title>
</head>
<body>
    <h2>Your message has been Recieved</h2>

    <h4>The details you have entered are</h4>
    <table>
        <tr>
            <td> First Name</td>
            <td><?php echo $fname?></td>
        </tr>
        <tr>
            <td>Last name</td>
            <td><?php echo $lname?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $email?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><?php echo $phone?></td>
        </tr>
        <tr>
            <td>Message</td>
            <td><?php echo $user_message?></td>
        </tr>
    </table>
    <p><a href="/">Go back to main page</a></p>
    <p><a href="/contactus.php"> Send another feed back</a></p>
</body>
</html>