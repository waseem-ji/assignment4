<?php
$servername = "localhost";
$username = "root";
$password = "waseemji4217";
$database = "mytestdatabase";

$id = "";
$fname = "" ;
$lname = "" ;
$email = "" ;
$phone = "" ;

$error_message = "";

// Create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn->connect_error){
    die("Connection Error: " . $conn->connect_error );
}

function val($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = val($_POST['fname']);
    $lname = val($_POST['lname']);
    $email = val($_POST['email']);
    $phone = val($_POST['phone']);
    $user_message = val($_POST['user_message']);

    do {
        if ( empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($user_message) ) {
            $error_message = "All Fields are required";
        }
    
        // Enter data into table
        $sql = "INSERT INTO feedback (firstname,lastname,email,phone,message) VALUES('$fname','$lname','$email','$phone','$user_message');";
        if ($conn->query($sql) == TRUE){
            
            echo "Your message has been recieved :)";
        }
        else {
            echo "ERROR: " . $sql . "<br>" . $conn->error;
        }

    }while(false);
    }






    

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 3</title>
</head>
<body>
    <?php
    echo "<h1> WaseemJi's Porfolio </h1> ";
    echo "<p> This page contains informations and descriptions   </p> <hr/>";
    $education = array("HighSchool"=>"93.1%" , "Higher Secondary" => "80.1%" , "Btech" => "75%");
    $skills = array("python","django","mysql","git","postgres","HTML CSS JS Bootstrap");
    
    echo "<hr/> <h3> Education</h3>";
    foreach ($education as $school => $percent) {
        echo $school . ":" . $percent;
        echo "<br>";
    }

    echo "<hr/> <h3>My Skills </h3>";
    $arrlength = count($skills);
    for ($i=0 ; $i < $arrlength ; $i++){
        echo $skills[$i] . "<br/>";
    }
    // var_dump($skills);
    ?>
    <hr>

    <h3>Reach out to me</h3>
    <p><a href="contactus.php?email=<?php $email ?>">Contact Us ;)</a></p>
    <form action="" id="feedback" method="post">
        <table>
            <tr>
                <td>First name</td>
                <td><input type="text" name ="fname"></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td><input type="text" name="lname"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone"></td>
            </tr>
            <tr>
                <td>
                    <!-- <input type="hidden" name="id" value="<?php echo $id; ?>" /> -->
                    <h3> <input type="submit" value="submit"></h3>
                </td>

            </tr>
        </table>
    </form>
    <textarea rows="4" cols="50" name="user_message" form="feedback">
    Enter your message here</textarea>

</body>
</html>