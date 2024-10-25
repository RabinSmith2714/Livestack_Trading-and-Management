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

// Handling form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$location = $_POST['location'];
$breed = $_POST['breed'];
$age = $_POST['age'];
$milk_per_day = $_POST['milk_per_day'];
$amount = $_POST['amount'];
$description = $_POST['description'];
$image = $_FILES['image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($image);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Validate image
if(getimagesize($_FILES['image']['tmp_name']) === false) {
    die("File is not an image.");
}

// Check if file already exists
if (file_exists($target_file)) {
    die("Sorry, file already exists.");
}

// Check file size (5MB maximum)
if ($_FILES['image']['size'] > 5000000) {
    die("Sorry, your file is too large.");
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}

// Move file to target directory
if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    die("Sorry, there was an error uploading your file.");
}

// Insert data into database
$sql = "INSERT INTO cow (name, phone, address, location, breed, age, milk_per_day, amount, description, image)
VALUES ('$name', '$phone', '$address', '$location', '$breed', '$age', '$milk_per_day', '$amount', '$description', '$target_file')";

if ($conn->query($sql) === TRUE) {    
    header("Location: csell.html");
    exit();
}
 else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
