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
            max-width: 600px;
            position: relative; 
        }

        .success-message {
            color: #4CAF50;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error-message {
            color: #f44336;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
            position: absolute;
            bottom: 20px; 
            left: 50%;
            transform: translateX(-50%);
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

            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $addressid = $_POST['addressid'];
            $specialty = $_POST['specialty'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $dateofbirth = $_POST['dateofbirth'];
            $sex = $_POST['sex'];

            $updateSQL = "UPDATE doctor SET firstname='$firstname', middlename='$middlename', lastname='$lastname', addressid='$addressid', specialty='$specialty', email='$email', telephone='$telephone', dateofbirth='$dateofbirth', sex='$sex' WHERE email='$email'";

            if ($conn->query($updateSQL)) {
                echo "<div class='success-message'>Data successfully updated</div>";
            } else {
                echo "<div class='error-message'>Save Failure: " . $conn->error . "</div>";
            }

            $conn->close();
        ?>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
