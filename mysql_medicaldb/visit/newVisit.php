<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Visit - Group 33 Health Insurance App</title>
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

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            background-color: #6a11cb;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #5a0fb1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Insert New Visit - Group 33 Health Insurance App</h1>
        </div>

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

            $hospitalclinicQuery = "SELECT hospitalclinicid FROM hospital_clinic";
            $hospitalclinicResult = $conn->query($hospitalclinicQuery);

            $hospitalclinicOptions = "<option value=''>None</option>"; 
            if ($hospitalclinicResult->num_rows > 0) {
                while ($row = $hospitalclinicResult->fetch_assoc()) {
                    $hospitalclinicOptions .= "<option value='" . $row['hospitalclinicid'] . "'>" . $row['hospitalclinicid'] . "</option>";
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

        <form action='storeVisit.php' method='post'> 
            <input type='hidden' id='visitid' name='visitid' value='<?php echo isset($visitid) ? $visitid : ""; ?>'> 

            <div class="form-group">
                <label for="visit_date">Visit Date and Time:</label>
                <input id='visit_date' name='visit_date' type='datetime-local' value='<?php echo isset($visit_date) ? $visit_date : ""; ?>' required>
            </div>

            <div class="form-group">
                <label for="visit_type">Visit Type:</label>
                <select id='visit_type' name='visit_type'>  
                    <option value='CheckUp' <?php echo (isset($visit_type) && $visit_type == 'CheckUp') ? 'selected' : ''; ?>>CheckUp</option>
                    <option value='Inspection' <?php echo (isset($visit_type) && $visit_type == 'Inspection') ? 'selected' : ''; ?>>Inspection</option>
                    <option value='NewIssue' <?php echo (isset($visit_type) && $visit_type == 'NewIssue') ? 'selected' : ''; ?>>NewIssue</option>
                </select>
            </div>

            <div class="form-group">
                <label for="amka">AMKA:</label>
                <select id='amka' name='amka'>
                    <?php echo $amkaOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="doctorid">Doctor ID:</label>
                <select id='doctorid' name='doctorid'>
                    <?php echo $doctorOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hospitalclinicid">Hospital/Clinic ID:</label>
                <select id='hospitalclinicid' name='hospitalclinicid'>
                    <?php echo $hospitalclinicOptions; ?>
                </select>
            </div>

            <input type='submit' value='Save Data' class="btn">
        </form>
        <br><br>
        <a href="../informantion.html">Return to Home Page</a>
        <div class="footer">
            <p>&copy; 2024 Group 33 (Christos-Spyridon Karydis / Dimitrios Konispoliatis). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
