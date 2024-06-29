<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Workson Data - Group 33 Health Insurance App</title>
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

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        select,
        input[type='submit'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type='submit'] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type='submit']:hover {
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
        <h1>Editing Workson Data - Group 33 Health Insurance App</h1>
        <?php 
            $worksonid = $_GET['worksonid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM workson WHERE worksonid='$worksonid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $doctorid = htmlspecialchars($row["doctorid"]);
                    $hospitalclinicid = htmlspecialchars($row["hospitalclinicid"]);
                }
            }

            $doctorQuery = "SELECT doctorid FROM doctor";
            $doctorResult = $conn->query($doctorQuery);

            $doctorOptions = ""; 
            if ($doctorResult->num_rows > 0) {
                while ($row = $doctorResult->fetch_assoc()) {
                    $selected = $row['doctorid'] == $doctorid ? "selected" : "";
                    $doctorOptions .= "<option value='" . $row['doctorid'] . "' $selected>" . $row['doctorid'] . "</option>";
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
        ?>
        <form action='editWorkson.php' method='post'> 
            <input type='hidden' id='worksonid' name='worksonid' value='<?php echo $worksonid; ?>'> 
            <label for="doctorid">Doctor ID:</label>
            <select id='doctorid' name='doctorid'>
                <?php echo $doctorOptions; ?>
            </select>
            <label for="hospitalclinicid">Hospital Clinic ID:</label>
            <select id='hospitalclinicid' name='hospitalclinicid'>
                <?php echo $hospitalclinicOptions; ?>
            </select>
            <input type='submit' value='Save Data'>
        </form>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
```