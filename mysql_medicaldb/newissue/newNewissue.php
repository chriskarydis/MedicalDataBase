<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Issue - Group 33 Health Insurance App</title>
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

        input[type="text"],
        select,
        input[type="submit"] {
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
           include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT visitid FROM visit WHERE visit_type='NewIssue' AND visitid NOT IN (SELECT visitid FROM newissue)";
            $result = $conn->query($sql);

            $visitOptions = "<option value=''>Select a Visit ID</option>"; // Default option
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $visitOptions .= "<option value='" . $row["visitid"] . "'>" . $row["visitid"] . "</option>";
                }
            }

            $conn->close();
        ?>
        <form action='storeNewIssue.php' method='post'> 
            <label for="visitid">Visit ID:</label>
            <select id="visitid" name="visitid">
                <?php echo $visitOptions; ?>
            </select>
            <br><br>
            <label for="initialdiagnosis">Initial Diagnosis:</label>
            <input id='initialdiagnosis' name='initialdiagnosis' type='text' value='<?php echo isset($initialdiagnosis) ? $initialdiagnosis : ""; ?>'>
            <br><br>
            <input type='submit' value='Save Data'>
        </form>
        <br><br>
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
