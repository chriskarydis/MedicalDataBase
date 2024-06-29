<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Renewable Entry</title>
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

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT prescriptionid FROM prescription WHERE is_renewable = 'Yes' AND prescriptionid NOT IN (SELECT prescriptionid FROM renewable)";
            $result = $conn->query($sql);

            $prescriptionOptions = "<option value=''>Select a Prescription ID</option>"; 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $prescriptionOptions .= "<option value='" . $row["prescriptionid"] . "'>" . $row["prescriptionid"] . "</option>";
                }
            } else {
                $prescriptionOptions .= "<option value=''>No available prescription IDs</option>";
            }

            $conn->close();
        ?>
        <form action="storeRenewable.php" method="post">
            <label for="prescriptionid">Prescription ID:</label>
            <select id="prescriptionid" name="prescriptionid">
                <?php echo $prescriptionOptions; ?>
            </select>
            <br><br>
            <label for="renewabletimes">Renewable Times:</label>
            <input id="renewabletimes" name="renewabletimes" type="text" value="<?php echo isset($renewabletimes) ? $renewabletimes : ''; ?>"><br><br>
            <input type="submit" value="Save Data">
        </form>
        <br><br>
        <a href="../informantion.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
