<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Supervision Record - Group 33 Health Insurance App</title>
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
            $recordid = $_GET['recordid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM supervise WHERE recordid='$recordid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $startdate = htmlspecialchars($row["startdate"]);
                    $enddate = htmlspecialchars($row["enddate"]);
                    $comments = htmlspecialchars($row["comments"]);
                    $amka = htmlspecialchars($row["amka"]);
                    $doctorid = htmlspecialchars($row["doctorid"]);
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
        <h2>Editing Supervision Record</h2>
        <form action='editSupervise.php' method='post'> 
            <label for="recordid">Record ID:</label>
            <input type='hidden' id='recordid' name='recordid' value='<?php echo $recordid; ?>'> 
            
            <label for="startdate">Start Date:</label>
            <input id='startdate' name='startdate' type='date' value='<?php echo $startdate; ?>'> <br>
            
            <label for="enddate">End Date:</label>
            <input id='enddate' name='enddate' type='date' value='<?php echo $enddate; ?>'> <br>
            
            <label for="comments">Comments:</label>
            <input id='comments' name='comments' type='text' value='<?php echo $comments; ?>'> <br>
            
            <label for="amka">AMKA:</label>
            <select id='amka' name='amka'>
                <?php echo $amkaOptions; ?>
            </select><br>
            
            <label for="doctorid">Doctor ID:</label>
            <select id='doctorid' name='doctorid'>
                <?php echo $doctorOptions; ?>
            </select><br>
                    
            <input type='submit' value='Save Data'>
        </form>
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
