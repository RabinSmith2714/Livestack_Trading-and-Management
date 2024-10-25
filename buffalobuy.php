<!DOCTYPE html>
<html>
<head>
    <title>Buffalo for sales</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global Styles */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .animal {
            flex-basis: calc(33.33% - 20px);
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .animal:hover {
            transform: translateY(-5px);
        }

        .animal img {
            width: 100%;
            height: 50%;
            display: block;
            border-radius: 10px 10px 0 0;
        }

        .animal-details {
            padding: 20px;
        }

        .animal-details p {
            margin-bottom: 10px;
        }

        .load-more {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .load-more:hover {
            background-color: #138496;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .contact_link-container {
            display: flex;
            justify-content: flex-end;
        }

        .contact_link-container a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }

        .contact_link-container a:hover {
            text-decoration: underline;
        }

        .navbar-brand span {
            font-size: 24px;
            font-weight: 700;
        }

        .navbar-nav .nav-link {
            color: #333;
            font-weight: 600;
        }

        .navbar-nav .nav-link:hover {
            color: #17a2b8;
        }

        .call-button {
            padding: 10px 20px;
            background-color: #ff6f61;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .call-button:hover {
            background-color: #e05246;
        }
    </style>
</head>
<body>
    <div class="container">
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

        // Fetch all data from the database
        $sql = "SELECT name, phone, location, breed, age, milk_per_day, amount, description, image FROM buffalo";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="animal">';
                echo '<img src="' . $row["image"] . '" alt="Animal Image">';
                echo '<div class="animal-details">';
                echo '<p><strong>Name:</strong> ' . $row["name"] . '</p>';
                echo '<p><strong>Phone:</strong> ' . $row["phone"] . '</p>';
                echo '<p><strong>Location:</strong> ' . $row["location"] . '</p>';
                echo '<p><strong>Breed:</strong> ' . $row["breed"] . '</p>';
                echo '<p><strong>Age:</strong> ' . $row["age"] . '</p>';
                echo '<p><strong>Milk Per Day (liters):</strong> ' . $row["milk_per_day"] . '</p>';
                echo '<p><strong>Amount:</strong> ' . $row["amount"] . '</p>';
                echo '<p><strong>Description:</strong> ' . $row["description"] . '</p>';
                echo '<button class="call-button" onclick="call(\'' . $row["phone"] . '\')">Call</button>'; // Pass phone number to JavaScript function
                echo '</div>';
                echo '</div>';
            }
        } else
        {
            echo "<p>No records found</p>";
        }
        
        $conn->close();
        ?>
        </div>
        
        <script>
            function call(phone) {
                window.location.href = 'tel:' + phone; // Open phone app with the provided phone number
            }
        </script>
        
        </body>
        </html>
        