<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Patient</title>
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

        a {
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-top: 20px;
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
        <?php 
        $amka = $_GET['amka'];
        
        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
        
        $tables = ['hospitalized', 'prescription', 'supervise', 'visit'];
        $referencesFound = false;
        $referencedTables = [];
        
        foreach ($tables as $table) {
            $checkSql = "SELECT * FROM $table WHERE amka='$amka' LIMIT 1";
            $checkResult = $conn->query($checkSql);
            
            if ($checkResult->num_rows > 0) {
                $referencesFound = true;
                $referencedTables[] = $table;
            }
        }
        
        if ($referencesFound) {
            echo "<p>Cannot delete the patient because they are associated with other data in the following tables:</p>";
            echo "<div class='references'>";
            foreach ($referencedTables as $table) {
                echo "<p>- $table</p>";
            }
            echo "</div>";
        } else {
            $deleteSql = "DELETE FROM patient WHERE amka='$amka'";
            
            if ($conn->query($deleteSql)) {
                echo "<p>The patient has been deleted successfully</p>";
            } else {
                echo "<p>Delete Failure: ".$conn->error."</p>";
            }
        }
        
        $conn->close();
        ?>
        
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
