<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Hospitalized Data - Group 33 Health Insurance App</title>
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
            text-align: left;
            width: 90%;
            max-width: 600px;
            position: relative;
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
            display: block;
            margin-top: 20px;
        }

        .return-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
            $hospitalizedid = $_GET['hospitalizedid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM hospitalized WHERE hospitalizedid='$hospitalizedid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $entrydate = htmlspecialchars($row["entrydate"]);
                    $exitdate = htmlspecialchars($row["exitdate"]);
                    $amka = htmlspecialchars($row["amka"]);
                    $hospitalclinicid = htmlspecialchars($row["hospitalclinicid"]);
                }
            }

            $hospitalclinicQuery = "SELECT hospitalclinicid FROM hospital_clinic";
            $hospitalclinicResult = $conn->query($hospitalclinicQuery);

            $hospitalclinicOptions = ""; 
            if ($hospitalclinicResult->num_rows > 0) {
                while ($row = $hospitalclinicResult->fetch_assoc()) {
                    $selected = $row['hospitalclinicid'] == $hospitalclinicid ? "selected" : "";
                    $hospitalclinicOptions .= "<option value='" . $row['hospitalclinicid'] . "' $selected>" . $row['hospitalclinicid'] . "</option>";
                }
            }

            $amkaQuery = "SELECT amka FROM patient";
            $amkaResult = $conn->query($amkaQuery);

            $amkaOptions = ""; 
            if ($amkaResult->num_rows > 0) {
                while ($row = $amkaResult->fetch_assoc()) {
                    $selected = $row['amka'] == $amka ? "selected" : "";
                    $amkaOptions .= "<option value='" . $row['amka'] . "' $selected>" . $row['amka'] . "</option>";
                }
            }
        ?>
        <form action='editHospitalized.php' method='post'> 
            <input type="hidden" id='hospitalizedid' name='hospitalizedid' value='<?php echo $hospitalizedid; ?>'>
            <label for="entrydate">Entry Date:</label>
            <input id='entrydate' name='entrydate' type='date' value='<?php echo $entrydate; ?>'>
            <br><br>
            <label for="exitdate">Exit Date:</label>
            <input id='exitdate' name='exitdate' type='date' value='<?php echo $exitdate; ?>'>
            <br><br>
            <label for="amka">AMKA:</label>
            <select id='amka' name='amka'>
                <?php echo $amkaOptions; ?>
            </select>
            <br><br>
            <label for="hospitalclinicid">Hospital Clinic ID:</label>
            <select id='hospitalclinicid' name='hospitalclinicid'>
                <?php echo $hospitalclinicOptions; ?>
            </select>
            <br><br>
            <input type='submit' value='Save Data'>
        </form>
        <br><br>
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
