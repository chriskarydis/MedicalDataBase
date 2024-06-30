<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Address</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-size: 14px;
        }

        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 600px;
        }

        .message {
            margin-top: 20px;
        }

        a {
            display: block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-top: 20px;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            $addressid = $_POST['addressid']; 
            $street = $_POST['street'];
            $city = $_POST['city'];
            $region = $_POST['region'];
            $country = $_POST['country'];
            $postal_code = $_POST['postal_code'];

            $editAddressSQL = "UPDATE address SET street='$street', city='$city', region='$region', country='$country', postal_code='$postal_code' WHERE addressid='$addressid'";

            if ($conn->query($editAddressSQL)) {
                echo "<h2>Address data successfully updated</h2>";
            } else {
                echo "<h2>Update Failure: " . $conn->error . "</h2>";
            }

            $conn->close();
        ?>
        
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
