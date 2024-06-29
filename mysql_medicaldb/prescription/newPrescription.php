<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Prescription - Group 33 Health Insurance App</title>
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

        form {
            text-align: left;
        }

        input[type="text"], input[type="date"], input[type="number"], select, input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        select {
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
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

            $doctorQuery = "SELECT doctorid FROM doctor";
            $doctorResult = $conn->query($doctorQuery);

            $doctorOptions = "<option value=''>None</option>"; 
            if ($doctorResult->num_rows > 0) {
                while ($row = $doctorResult->fetch_assoc()) {
                    $doctorOptions .= "<option value='" . $row['doctorid'] . "'>" . $row['doctorid'] . "</option>";
                }
            }

            $visitQuery = "SELECT visitid FROM visit";
            $visitResult = $conn->query($visitQuery);

            $visitOptions = "<option value=''>None</option>"; 
            if ($visitResult->num_rows > 0) {
                while ($row = $visitResult->fetch_assoc()) {
                    $visitOptions .= "<option value='" . $row['visitid'] . "'>" . $row['visitid'] . "</option>";
                }
            }

            $amkaQuery = "SELECT amka FROM patient";
            $amkaResult = $conn->query($amkaQuery);

            $amkaOptions = "<option value=''>None</option>"; 
            if ($amkaResult->num_rows > 0) {
                while ($row = $amkaResult->fetch_assoc()) {
                    $amkaOptions .= "<option value='" . $row['amka'] . "'>" . $row['amka'] . "</option>";
                }
            }
        ?>
        <h2>Insert New Prescription - Group 33 Health Insurance App</h2>
        <form action='storePrescription.php' method='post'> 
            <input type='hidden' id='prescriptionid' name='prescriptionid' value='<?php echo isset($prescriptionid) ? $prescriptionid : ""; ?>'> 
            
            Prescription Type: <input id='presc_type' name='presc_type' type='text' value='<?php echo isset($presc_type) ? $presc_type : ""; ?>'> <br><br>
            Start Date: <input id='startdate' name='startdate' type='date' value='<?php echo isset($startdate) ? $startdate : ""; ?>'> <br><br>
            Expiration Date: <input id='expirationdate' name='expirationdate' type='date' value='<?php echo isset($expirationdate) ? $expirationdate : ""; ?>'> <br><br>
            Comments: <input id='comments' name='comments' type='text' value='<?php echo isset($comments) ? $comments : ""; ?>'> <br><br>
            Eligibility: 
            <select id='eligibility' name='eligibility'>  
                <option value='Yes'>Yes</option>
                <option value='No'>No</option>
            </select><br><br>
            Dosage: <input id='dosage' name='dosage' type='number' value='<?php echo isset($dosage) ? $dosage : ""; ?>'> <br><br>
            Doctor ID: 
            <select id='doctorid' name='doctorid'>
                <?php echo $doctorOptions; ?>
            </select><br><br>
            AMKA: 
            <select id='amka' name='amka'>
                <?php echo $amkaOptions; ?>
            </select><br><br>
            Visit ID:
            <select id='visitid' name='visitid'>
                <?php echo $visitOptions; ?>
            </select><br><br>
            Is Renewable: 
            <select id='is_renewable' name='is_renewable'>  
                <option value='Yes'>Yes</option>
                <option value='No'>No</option>
            </select><br><br>    
            <input type='submit' value='Save Data'>
        </form><br><br>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
