<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Checkup - Group 33 Health Insurance App</title>
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

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT visitid FROM visit WHERE visit_type='CheckUp' AND visitid NOT IN (SELECT visitid FROM checkup)";
            $result = $conn->query($sql);

            $visitOptions = "<option value=''>Select a Visit ID</option>"; // Default option
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $visitOptions .= "<option value='" . $row["visitid"] . "'>" . $row["visitid"] . "</option>";
                }
            }

            $conn->close();
        ?>
        
        <h2>Insert New Checkup - Group 33 Health Insurance App</h2>
        <form action="storeCheckup.php" method="post">
            <label for="visitid">Visit ID:</label><br>
            <select id="visitid" name="visitid">
                <?php echo $visitOptions; ?>
            </select><br><br>
            <label for="weight">Weight:</label><br>
            <input id="weight" name="weight" type="text" value="<?php echo isset($weight) ? $weight : ''; ?>"><br><br>
            <label for="height">Height:</label><br>
            <input id="height" name="height" type="text" value="<?php echo isset($height) ? $height : ''; ?>"><br><br>
            <label for="systolic_blood_pressure">Systolic Blood Pressure:</label><br>
            <input id="systolic_blood_pressure" name="systolic_blood_pressure" type="text" value="<?php echo isset($systolic_blood_pressure) ? $systolic_blood_pressure : ''; ?>"><br><br>
            <label for="diastolic_blood_pressure">Diastolic Blood Pressure:</label><br>
            <input id="diastolic_blood_pressure" name="diastolic_blood_pressure" type="text" value="<?php echo isset($diastolic_blood_pressure) ? $diastolic_blood_pressure : ''; ?>"><br><br>
            <input type="submit" value="Save Data">
        </form>
        
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
