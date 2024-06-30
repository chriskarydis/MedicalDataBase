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
            
            $editSQL = "UPDATE prescription SET presc_type='$presc_type', startdate='$startdate', expirationdate='$expirationdate', comments='$comments', eligibility='$eligibility', dosage='$dosage', doctorid='$doctorid', amka='$amka', visitid='$visitid', is_renewable='$is_renewable' WHERE prescriptionid='$prescriptionid'";
            
            if ($result = $conn->query($editSQL)) {
                echo "<div class='success-message'>Data successfully entered</div>";
            } else {
                echo "<div class='error-message'>Save Failure: ".$conn->error."</div>";
            } 
            
            $conn->close();
        ?>    
        
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
