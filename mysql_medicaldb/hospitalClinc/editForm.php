<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Hospital/Clinic Data - Group 33 Health Insurance App</title>
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
            <h1>Editing Hospital/Clinic Data - Group 33 Health Insurance App</h1>
        </div>
        <?php 
            $hospitalclinicid = $_GET['hospitalclinicid'];
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
            
            $sql = "SELECT * FROM hospital_clinic WHERE hospitalclinicid='$hospitalclinicid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $hosp_name = htmlspecialchars($row["hosp_name"]);
                    $addressid = htmlspecialchars($row["addressid"]);
                    $telephone = htmlspecialchars($row["telephone"]);
                    $fax = htmlspecialchars($row["fax"]);
                    $email = htmlspecialchars($row["email"]);
                }
            }

            $addressQuery = "SELECT addressid, street, city, region, country FROM address";
            $addressResult = $conn->query($addressQuery);

            $addressOptions = ""; 
            if ($addressResult->num_rows > 0) {
                while ($row = $addressResult->fetch_assoc()) {
                    $selected = $row['addressid'] == $addressid ? "selected" : "";
                    $addressOptions .= "<option value='" . $row['addressid'] . "' $selected>" . $row['addressid'] . " - " . $row['street'] . ", " . $row['city'] . ", " . $row['region'] . ", " . $row['country'] . "</option>";
                }
            }
        ?>
        <form action='editHospitalClinic.php' method='post'> 
            <input type='hidden' id='hospitalclinicid' name='hospitalclinicid' value='<?php echo $hospitalclinicid; ?>'>
            
            <div class="form-group">
                <label for="hosp_name">Hospital/Clinic Name:</label>
                <input id='hosp_name' name='hosp_name' type='text' value='<?php echo $hosp_name; ?>'>
            </div>

            <div class="form-group">
                <label for="addressid">Address ID:</label>
                <select id='addressid' name='addressid'>
                    <?php echo $addressOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input id='telephone' name='telephone' type='text' value='<?php echo $telephone; ?>'>
            </div>

            <div class="form-group">
                <label for="fax">Fax:</label>
                <input id='fax' name='fax' type='text' value='<?php echo $fax; ?>'>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input id='email' name='email' type='text' value='<?php echo $email; ?>'>
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
