<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save - Group 33 Health Insurance App</title>
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
            max-width: 800px;
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
        <div class="header">
            <h1>Save Hospital Data - Group 33 Health Insurance App</h1>
        </div>

        <?php
        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

        $hospitalclinicid = $_POST['hospitalclinicid'];
        $hosp_name = $_POST['hosp_name'];
        $addressid = $_POST['addressid'];
        $telephone = $_POST['telephone'];
        $fax = $_POST['fax'];
        $email = $_POST['email'];

        $editSQL = "UPDATE hospital_clinic SET hosp_name='$hosp_name', addressid='$addressid', telephone='$telephone', fax='$fax', email='$email' WHERE hospitalclinicid='$hospitalclinicid'";

        if ($result = $conn->query($editSQL)) {
            echo "<p>Data successfully entered</p>";
        } else {
            echo "<p>Save Failure: ".$conn->error."</p>";
        }

        $conn->close();
        ?>

        <br><br>
        <a href="../information.html">Return to Home Page</a>

        <div class="footer">
            <p>&copy; 2024 Group 33 (C. S. Karydis / D. Konispoliatis / A. Georgakopoulos). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
