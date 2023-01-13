<?php
$servername = "localhost";
$username = "root";
$password = "waseemji4217";
$database = "mytestdatabase";

$conn = new mysqli($servername,$username,$password,$database);

// initializevalues
$fname = "";
$lname = "";
$email = "";
$phone = "";

$user_message = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST['fname'];
    $lname= $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_message = $_POST['user_message'];

    do {    
        if ( empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($user_message)) {
            echo " All fields are required ";
            break;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Enter a valid Email";
            break;
        }

        if (!preg_match('/^[0-9]{10}+$/',$phone)) {
            echo "Enter a valid phone number";
            break;
        }

        $sql = "INSERT INTO feedback(firstname,lastname,email,phone,message) VALUES('$fname','$lname','$email','$phone','$user_message');";
        $results = $conn->query($sql);


        $csv_sql = "SELECT * FROM feedback ;";
        $csv_result = $conn->query($csv_sql);

        $delimiter = ",";
        $filename = "feedbacks.csv";

        $file = fopen("$filename","w");

        // Set colomn header
        $fields = array('ID','FIRST NAME','LAST NAME','EMAIL','PHONE','MESSAGE');
        fputcsv($file,$fields,$delimiter);

        // To output each row to csv
        while ($row = $csv_result->fetch_assoc()){
            $lineData = array($row['id'],$row['firstname'],$row['lastname'],$row['email'],$row['phone'],$row['message']);
            fputcsv($file,$lineData,$delimiter);
        }

        // Move back to begining of file , But Y?
        fseek($file,0);
        header("location: /assignment3/success.php?phone=" . $phone);

    } while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me!!</title>
</head>
<body>
    <h2>We would like to hear from you </h2>
    <br>
    <form action="" method = "post" id="feedback">
        <table>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="fname"></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="lname"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
                <td><input type="hidden" value= <?php echo $email;?>></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone"></td>
            </tr>
            <tr>
                <td>Message</td>
                
            </tr>
            <input type="submit" value="  submit  ">
        </table>
    </form>
    <textarea rows="4" cols="50" name="user_message" form="feedback"></textarea><br>
</body>
</html>