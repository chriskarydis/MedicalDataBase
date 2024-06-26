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

            function allFieldsFilled($fields) {
                foreach ($fields as $field) {
                    if (empty($field)) {
                        return false;
                    }
                }
                return true;
            }

            $prescriptionid = $_POST['prescriptionid'];
            $presc_type = $_POST['presc_type'];
            $startdate = $_POST['startdate'];
            $expirationdate = $_POST['expirationdate'];
            $comments = $_POST['comments'];
            $eligibility = $_POST['eligibility'];
            $dosage = $_POST['dosage'];
            $doctorid = $_POST['doctorid'];
            $amka = $_POST['amka'];
            $visitid = $_POST['visitid'];
            $is_renewable = $_POST['is_renewable']; 

            $requiredFields = array($presc_type, $startdate, $dosage, $doctorid, $amka, $visitid);
            if (!allFieldsFilled($requiredFields)) {
                echo "<p class='error-message'>Error: Not all required fields are filled.</p>";
                echo "<a href='javascript:history.back()' class='return-button'>Go Back to Add New Prescription</a>";
                die();
            }

            $insertSQL = "INSERT INTO prescription (prescriptionid, presc_type, startdate, expirationdate, comments, eligibility, dosage, doctorid, amka, visitid, is_renewable) 
                        VALUES ('$prescriptionid', '$presc_type', '$startdate', '$expirationdate', '$comments', '$eligibility', '$dosage', '$doctorid', '$amka', '$visitid', '$is_renewable')";

            if ($conn->query($insertSQL) === TRUE) {
                echo "<p class='success-message'>New record created successfully</p>";
            } else {
                echo "<p class='error-message'>Error: " . $insertSQL . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        ?>
        
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
