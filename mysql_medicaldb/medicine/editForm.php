<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Medicine Data - Group 33 Health Insurance App</title>
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
            <h1>Editing Medicine Data - Group 33 Health Insurance App</h1>
        </div>
        <?php 
            $medicineid = $_GET['medicineid'];
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
            
            $sql = "SELECT * FROM medicine WHERE medicineid='$medicineid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $med_name = htmlspecialchars($row["med_name"]);
                    $med_type = htmlspecialchars($row["med_type"]);
                    $expirationdate = htmlspecialchars($row["expirationdate"]);
                    $activeingredients = htmlspecialchars($row["activeingredients"]);
                    $med_usage = htmlspecialchars($row["med_usage"]);
                    $sideeffects = htmlspecialchars($row["sideeffects"]);
                    $indications = htmlspecialchars($row["indications"]);
                    $prescreptionneeded = htmlspecialchars($row["prescreptionneeded"]);
                }
            }
        ?>
        <form action='editMedicine.php' method='post'> 
            <input type='hidden' id='medicineid' name='medicineid' value='<?php echo $medicineid; ?>'>
            
            <div class="form-group">
                <label for="med_name">Medicine Name:</label>
                <input id='med_name' name='med_name' type='text' value='<?php echo $med_name; ?>'>
            </div>
            
            <div class="form-group">
                <label for="med_type">Medicine Type:</label>
                <input id='med_type' name='med_type' type='text' value='<?php echo $med_type; ?>'>
            </div>
            
            <div class="form-group">
                <label for="expirationdate">Expiration Date:</label>
                <input id='expirationdate' name='expirationdate' type='date' value='<?php echo $expirationdate; ?>'>
            </div>
            
            <div class="form-group">
                <label for="activeingredients">Active Ingredients:</label>
                <input id='activeingredients' name='activeingredients' type='text' value='<?php echo $activeingredients; ?>'>
            </div>
            
            <div class="form-group">
                <label for="med_usage">Medicine Usage:</label>
                <input id='med_usage' name='med_usage' type='text' value='<?php echo $med_usage; ?>'>
            </div>
            
            <div class="form-group">
                <label for="sideeffects">Side Effects:</label>
                <input id='sideeffects' name='sideeffects' type='text' value='<?php echo $sideeffects; ?>'>
            </div>
            
            <div class="form-group">
                <label for="indications">Indications:</label>
                <input id='indications' name='indications' type='text' value='<?php echo $indications; ?>'>
            </div>
            
            <div class="form-group">
                <label for="prescreptionneeded">Prescription Needed:</label>
                <select id='prescreptionneeded' name='prescreptionneeded'>
                    <option <?php if ($prescreptionneeded == 'Yes') echo 'selected'; ?> value='Yes'>Yes</option>
                    <option <?php if ($prescreptionneeded == 'No') echo 'selected'; ?> value='No'>No</option>
                </select>
            </div>
            
            <input type='submit' value='Save Data' class="btn">
        </form>
        <br><br>
        <a href="../information.html">Return to Home Page</a>
        <div class="footer">
            <p>&copy; 2024 Group 33 (C. S. Karydis / D. Konispoliatis / A. Georgakopoulos). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
