<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Includes - Group 33 Health Insurance App</title>
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

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
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
        <h2>Insert New Includes - Group 33 Health Insurance App</h2>
        <?php
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            $prescriptionQuery = "SELECT prescriptionid FROM prescription";
            $prescriptionResult = $conn->query($prescriptionQuery);

            $prescriptionOptions = ""; 
            if ($prescriptionResult->num_rows > 0) {
                while ($row = $prescriptionResult->fetch_assoc()) {
                    $prescriptionOptions .= "<option value='" . $row['prescriptionid'] . "'>" . $row['prescriptionid'] . "</option>";
                }
            }

            $medicineQuery = "SELECT medicineid FROM medicine";
            $medicineResult = $conn->query($medicineQuery);

            $medicineOptions = ""; 
            if ($medicineResult->num_rows > 0) {
                while ($row = $medicineResult->fetch_assoc()) {
                    $medicineOptions .= "<option value='" . $row['medicineid'] . "'>" . $row['medicineid'] . "</option>";
                }
            }
        ?>    

        <form action='storeIncludes.php' method='post'> 
            <input type='hidden' id='includesid' name='includesid' value='<?php echo isset($includesid) ? $includesid : ""; ?>'> 
            
            <label for='medicineid'>Medicine ID:</label>
            <select id='medicineid' name='medicineid'>
                <?php echo $medicineOptions; ?>
            </select><br>

            <label for='prescriptionid'>Prescription ID:</label>
            <select id='prescriptionid' name='prescriptionid'>
                <?php echo $prescriptionOptions; ?>
            </select><br>

            <input type='submit' value='Save Data'>
        </form>
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
