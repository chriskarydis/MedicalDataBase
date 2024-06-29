<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Inspection - Group 33 Health Insurance App</title>
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
        }

        input[type='submit']:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
            display: block;
            margin-top: 20px;
        }

        a:hover {
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

            $sql = "SELECT visitid FROM visit WHERE visit_type='Inspection' AND visitid NOT IN (SELECT visitid FROM inspection)";
            $result = $conn->query($sql);

            $visitOptions = "<option value=''>Select a Visit ID</option>"; 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $visitOptions .= "<option value='" . $row["visitid"] . "'>" . $row["visitid"] . "</option>";
                }
            } else {
                $visitOptions .= "<option value=''>No available visit IDs</option>";
            }

            $conn->close();
        ?>
        <h2>Insert New Inspection - Group 33 Health Insurance App</h2>
        <form action='storeInspection.php' method='post'>
            <label for="visitid">Visit ID:</label>
            <select id="visitid" name="visitid">
                <?php echo $visitOptions; ?>
            </select>
            <br><br>
            <label for="statebetween">State Between:</label>
            <input id='statebetween' name='statebetween' type='text' value='<?php echo isset($statebetween) ? $statebetween : ""; ?>'>
            <br><br>
            <input type='submit' value='Save Data'>
        </form>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
