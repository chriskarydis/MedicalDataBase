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

        .return-link {
            position: absolute;
            bottom: 20px; 
            left: 50%;
            transform: translateX(-50%);
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
            display: block;
            margin-top: 20px; 
        }

        .return-link:hover {
            color: #0056b3;
        }

        .return-button {
            margin-top: 20px; 
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .return-button:hover {
            background-color: #0056b3;
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

            $requiredFields = array($weight, $height, $systolic_blood_pressure, $diastolic_blood_pressure);
            foreach ($requiredFields as $field) {
                if (empty($field)) {
                    echo "<p class='error-message'>Error: All fields must be filled.</p>";
                    echo "<a href='javascript:history.back()' class='return-button'>Go Back to Add New Checkup</a>";
                    die(); 
                }
            }

            try {
                $checkVisitIDQuery = "SELECT COUNT(*) as count FROM checkup WHERE visitid = '$visitid'";
                $checkVisitIDResult = $conn->query($checkVisitIDQuery);
                if ($checkVisitIDResult && $checkVisitIDResult->num_rows > 0) {
                    $visitidRow = $checkVisitIDResult->fetch_assoc();
                    if ($visitidRow['count'] > 0) {
                        echo "<p class='error-message'>Error: Visit ID '$visitid' already exists in the checkup database.</p>";
                        echo "<a href='javascript:history.back()' class='return-button'>Go Back to Add New Checkup</a>";
                    } else {
                        $insertSQL = "INSERT INTO checkup (visitid, weight, height, systolic_blood_pressure, diastolic_blood_pressure) 
                                      VALUES ('$visitid', '$weight', '$height', '$systolic_blood_pressure', '$diastolic_blood_pressure')";

                        if ($conn->query($insertSQL) === TRUE) {
                            echo "<p class='success-message'>New checkup record created successfully</p>";
                            echo "<a href='../information.html' class='return-button'>Return to Home Page</a>";
                        } else {
                            throw new Exception($conn->error);
                        }
                    }
                } else {
                    throw new Exception("Error checking Visit ID");
                }
            } catch (Exception $e) {
                echo "<p class='error-message'>Error: " . $e->getMessage() . "</p>";
                echo "<a href='javascript:history.back()' class='return-button'>Go Back to Add New Checkup</a>";
            }

            $conn->close();
        ?>
    </div>
</body>
</html>
