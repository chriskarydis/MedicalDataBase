<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Checkup Data - Group 33 Health Insurance App</title>
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
        }

        form {
            text-align: left;
        }

        input[type="text"], input[type="submit"] {
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
        $visitid = $_GET['visitid'];

        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

        $sql = "SELECT * FROM checkup WHERE visitid='$visitid'";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $weight = htmlspecialchars($row["weight"]);
                $height = htmlspecialchars($row["height"]);
                $systolic_blood_pressure = htmlspecialchars($row["systolic_blood_pressure"]);
                $diastolic_blood_pressure = htmlspecialchars($row["diastolic_blood_pressure"]);
            }
        }
        ?>

        <form action='editCheckup.php' method='post'> 
            <input type='hidden' id='visitid' name='visitid' value='<?php echo $visitid; ?>'>

            <label for="weight">Weight:</label>
            <input id='weight' name='weight' type='text' value='<?php echo $weight; ?>'>

            <label for="height">Height:</label>
            <input id='height' name='height' type='text' value='<?php echo $height; ?>'>

            <label for="systolic_blood_pressure">Systolic Blood Pressure:</label>
            <input id='systolic_blood_pressure' name='systolic_blood_pressure' type='text' value='<?php echo $systolic_blood_pressure; ?>'>

            <label for="diastolic_blood_pressure">Diastolic Blood Pressure:</label>
            <input id='diastolic_blood_pressure' name='diastolic_blood_pressure' type='text' value='<?php echo $diastolic_blood_pressure; ?>'>
                    
            <input type='submit' value='Save Data'>
        </form>
        <br><br>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
