<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save - Group 33 Health Insurance App</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Save Medicine Data - Group 33 Health Insurance App</h1>
        </div>

        <?php
        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

        $medicineid = $_POST['medicineid'];
        $med_name = $_POST['med_name'];
        $med_type = $_POST['med_type'];
        $expirationdate = $_POST['expirationdate'];
        $activeingredients = $_POST['activeingredients'];
        $med_usage = $_POST['med_usage'];
        $sideeffects = $_POST['sideeffects'];
        $indications = $_POST['indications'];
        $prescreptionneeded = $_POST['prescreptionneeded'];

        $insertSQL = "INSERT INTO medicine (medicineid, med_name, med_type, expirationdate, activeingredients, med_usage, sideeffects, indications, prescreptionneeded) 
                      VALUES ('$medicineid', '$med_name', '$med_type', '$expirationdate', '$activeingredients', '$med_usage', '$sideeffects', '$indications', '$prescreptionneeded')";

        if ($conn->query($insertSQL) === TRUE) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: " . $insertSQL . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
        ?>

        <br><br>
        <a href="../informantion.html">Return to Home Page</a>

        <div class="footer">
            <p>&copy; 2024 Group 33 (Christos-Spyridon Karydis / Dimitrios Konispoliatis). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
