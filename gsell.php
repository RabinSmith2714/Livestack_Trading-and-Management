<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $location = $_POST["location"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    // Image upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert data into database
            $sql = "INSERT INTO goat (name, phone, address, location, breed, age, amount, description, image)
            VALUES ('$name', '$phone', '$address', '$location', '$breed', '$age', '$amount', '$description', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                header("Location: gsell.html");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}

$conn->close();
?>
