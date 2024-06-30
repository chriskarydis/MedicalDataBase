<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Patient - Group 33 Health Insurance App</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
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
            margin-top: 20px; 
            position: relative; 
            display: flex;
            flex-direction: column; 
            justify-content: space-between; 
            height: 100%; 
        }

        form {
            text-align: left;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type='text'],
        input[type='date'],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type='submit'] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            margin-top: 10px; 
        }

        input[type='submit']:hover {
            background-color: #0056b3;
        }

        .return-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
            margin-top: 20px; 
            display: block; 
        }

        .return-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            $amkaQuery = "SELECT amka FROM patient";
            $amkaResult = $conn->query($amkaQuery);

            $amkaOptions = "<option value=''>None</option>"; 
            if ($amkaResult->num_rows > 0) {
                while ($row = $amkaResult->fetch_assoc()) {
                    $amkaOptions .= "<option value='" . $row['amka'] . "'>" . $row['amka'] . "</option>";
                }
            }

            $addressQuery = "SELECT addressid, street, city, region, country FROM address";
            $addressResult = $conn->query($addressQuery);

            $addressOptions = ""; 
            if ($addressResult->num_rows > 0) {
                while ($row = $addressResult->fetch_assoc()) {
                    $addressOptions .= "<option value='" . $row['addressid'] . "'>" . $row['addressid'] . " - " . $row['street'] . ", " . $row['city'] . ", " . $row['region'] . ", " . $row['country'] . "</option>";
                }
            }

            $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            $bloodTypeOptions = "<option value=''>None</option>";
            foreach ($bloodTypes as $type) {
                $bloodTypeOptions .= "<option value='$type'>$type</option>";
            }
        ?>
        
        <h2>Insert New Patient - Group 33 Health Insurance App</h2>
        <form action='storePatient.php' method='post'> 
            <label for='amka'>AMKA:</label><br>
            <input id='amka' name='amka' type='text' value='<?php echo isset($amka) ? $amka : ""; ?>'><br><br>
            <label for='firstname'>First Name:</label><br>
            <input id='firstname' name='firstname' type='text' value='<?php echo isset($firstname) ? $firstname : ""; ?>'><br><br>
            <label for='middlename'>Middle Name:</label><br>
            <input id='middlename' name='middlename' type='text' value='<?php echo isset($middlename) ? $middlename : ""; ?>'><br><br>
            <label for='lastname'>Last Name:</label><br>
            <input id='lastname' name='lastname' type='text' value='<?php echo isset($lastname) ? $lastname : ""; ?>'><br><br>
            <label for='fathername'>Father Name:</label><br>
            <input id='fathername' name='fathername' type='text' value='<?php echo isset($fathername) ? $fathername : ""; ?>'><br><br>
            <label for='dateofbirth'>Date of Birth:</label><br>
            <input id='dateofbirth' name='dateofbirth' type='date' value='<?php echo isset($dateofbirth) ? $dateofbirth : ""; ?>'><br><br>
            <label for='addressid'>Address ID:</label><br>
            <select id='addressid' name='addressid'>
                <?php echo $addressOptions; ?>
            </select><br><br>
            <label for='email'>Email:</label><br>
            <input id='email' name='email' type='text' value='<?php echo isset($email) ? $email : ""; ?>'><br><br>
            <label for='telephone'>Telephone:</label><br>
            <input id='telephone' name='telephone' type='text' value='<?php echo isset($telephone) ? $telephone : ""; ?>'><br><br>
            <label for='sex'>Sex:</label><br>
            <select id='sex' name='sex'>  
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
                <option value='Other'>Other</option>
            </select><br><br>    
            <label for='insurancename'>Insurance Name:</label><br>
            <input id='insurancename' name='insurancename' type='text' value='<?php echo isset($insurancename) ? $insurancename : ""; ?>'><br><br>
            <label for='insuranceid'>Insurance ID:</label><br>
            <input id='insuranceid' name='insuranceid' type='text' value='<?php echo isset($insuranceid) ? $insuranceid : ""; ?>'><br><br>
            <label for='weight'>Weight:</label><br>
            <input id='weight' name='weight' type='text' value='<?php echo isset($weight) ? $weight : ""; ?>'><br><br>
            <label for='height'>Height:</label><br>
            <input id='height' name='height' type='text' value='<?php echo isset($height) ? $height : ""; ?>'><br><br>
            <label for='bloodtype'>Blood Type:</label><br>
            <select id='bloodtype' name='bloodtype'>
                <?php echo $bloodTypeOptions; ?>
            </select><br><br>
            <label for='familystatus'>Family Status:</label><br>
            <select id='familystatus' name='familystatus'>
                <option value='Single'>Single</option>
                <option value='Divorced'>Divorced</option>
                <option value='Married'>Married</option>
                <option value='Widowed'>Widowed</option>
                <option value='Separated'>Separated</option>
            </select><br><br>
            <label for='insuredby'>Insured By:</label><br>
            <select id='insuredby' name='insuredby'>
                <?php echo $amkaOptions; ?>
            </select><br><br>
            <input type='submit' value='Save Data'>
        </form>
        
        <a href="../information.html" class="return-link">Return to Home Page</a>
        
    </div>
</body>
</html>
