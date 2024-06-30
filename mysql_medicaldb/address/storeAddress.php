<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save</title>
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

        .footer {
            margin-top: 20px;
            background-color: #f0f8ff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .footer p {
            margin: 0;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
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

        function allFieldsFilled($fields) {
            foreach ($fields as $field) {
                if (empty($field)) {
                    return false;
                }
            }
            return true;
        }

        $street = $_POST['street'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $country = $_POST['country'];
        $postal_code = $_POST['postal_code'];

        $requiredFields = array($street, $city, $region, $country, $postal_code);
        if (!allFieldsFilled($requiredFields)) {
            echo "<p>Error: Not all required fields are filled.</p>";
            echo "<a href='javascript:history.back()'>Go Back to Add New Address</a>";
            die();
        }

        $insertSQL = "INSERT INTO address (street, city, region, country, postal_code) 
                      VALUES ('$street', '$city', '$region', '$country', '$postal_code')";

        if ($conn->query($insertSQL) === TRUE) {
            echo "<p>New address record created successfully</p>";
        } else {
            echo "<p>Error: " . $insertSQL . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
        ?>

        <br><br>
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
