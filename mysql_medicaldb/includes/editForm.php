<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Includes Data - Group 33 Health Insurance App</title>
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
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type='text'],
        input[type='date'],
        select,
        input[type='submit'] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type='submit'] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type='submit']:hover {
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
        <h2>Editing Includes Data - Group 33 Health Insurance App</h2>
        <?php 
            $includesid = $_GET['includesid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM includes WHERE includesid='$includesid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $medicineid = htmlspecialchars($row["medicineid"]);
                    $prescriptionid = htmlspecialchars($row["prescriptionid"]);
                }
            }

            $prescriptionQuery = "SELECT prescriptionid FROM prescription";
            $prescriptionResult = $conn->query($prescriptionQuery);

            $prescriptionOptions = ""; 
            if ($prescriptionResult->num_rows > 0) {
                while ($row = $prescriptionResult->fetch_assoc()) {
                    $selected = $row['prescriptionid'] == $prescriptionid ? "selected" : "";
                    $prescriptionOptions .= "<option value='" . $row['prescriptionid'] . "' $selected>" . $row['prescriptionid'] . "</option>";
                }
            }

            $medicineQuery = "SELECT medicineid FROM medicine";
            $medicineResult = $conn->query($medicineQuery);

            $medicineOptions = ""; 
            if ($medicineResult->num_rows > 0) {
                while ($row = $medicineResult->fetch_assoc()) {
                    $selected = $row['medicineid'] == $medicineid ? "selected" : "";
                    $medicineOptions .= "<option value='" . $row['medicineid'] . "' $selected>" . $row['medicineid'] . "</option>";
                }
            }
        ?>
        <form action='editIncludes.php' method='post'> 
            <input type='hidden' id='includesid' name='includesid' value='<?php echo $includesid; ?>'> 
            <label for='medicineid'>Medicine ID:</label>
            <select id='medicineid' name='medicineid'>
                <?php echo $medicineOptions; ?>
            </select>
            <label for='prescriptionid'>Prescription ID:</label>
            <select id='prescriptionid' name='prescriptionid'>
                <?php echo $prescriptionOptions; ?>
            </select>
            <input type='submit' value='Save Data'>
        </form>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
