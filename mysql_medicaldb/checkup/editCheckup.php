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

            $visitid = $_POST['visitid'];
            $weight = $_POST['weight'];
            $height = $_POST['height'];
            $systolic_blood_pressure = $_POST['systolic_blood_pressure'];
            $diastolic_blood_pressure = $_POST['diastolic_blood_pressure'];

            $editSQL = "UPDATE checkup SET 
                        weight='$weight', 
                        height='$height', 
                        systolic_blood_pressure='$systolic_blood_pressure', 
                        diastolic_blood_pressure='$diastolic_blood_pressure' 
                        WHERE visitid='$visitid'";

            if ($result = $conn->query($editSQL)) {
                echo "<div class='success-message'>Data successfully updated</div>";
            } else {
                echo "<div class='error-message'>Save Failure: " . $conn->error . "</div>";
            }

            $conn->close();
        ?>
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
