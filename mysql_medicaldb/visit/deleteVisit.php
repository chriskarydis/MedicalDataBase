<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Visit - Group 33 Health Insurance App</title>
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

        .references {
            margin-top: 20px;
            text-align: left;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Delete Visit - Group 33 Health Insurance App</h1>
        </div>

        <?php 
        $visitid = $_GET['visitid'];

        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

        $tables = ['checkup', 'inspection', 'newissue', 'prescription'];
        $referencesFound = false;
        $referencedTables = [];

        foreach ($tables as $table) {
            $checkSql = "SELECT * FROM $table WHERE visitid='$visitid' LIMIT 1";
            $checkResult = $conn->query($checkSql);
            
            if ($checkResult->num_rows > 0) {
                $referencesFound = true;
                $referencedTables[] = $table;
            }
        }
        
        if ($referencesFound) {
            echo "<p>Cannot delete this visit because it is associated with other data in the following tables:</p>";
            echo "<div class='references'>";
            foreach ($referencedTables as $table) {
                echo "<p>- $table</p>";
            }
            echo "</div>";
        } else {
            $deleteSql = "DELETE FROM visit WHERE visitid='$visitid'";

            if ($conn->query($deleteSql)) {
                echo "<p>The visit has been deleted successfully</p>";
            } else {
                echo "<p>Delete Failure: ".$conn->error."</p>";
            }
        }

        $conn->close();
        ?>

        <br><br>
        <a href="../information.html">Return to Home Page</a>

        <div class="footer">
            <p>&copy; 2024 Group 33 (C. S. Karydis / D. Konispoliatis / A. Georgakopoulos). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
