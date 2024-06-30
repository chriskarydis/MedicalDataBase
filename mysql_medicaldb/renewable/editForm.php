<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Renewable Data - Group 33 Health Insurance App</title>
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
            text-align: left;
            width: 90%;
            max-width: 600px;
            position: relative;
        }

        form {
            text-align: left;
        }

        input[type="text"],
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
            $prescriptionid = $_GET['prescriptionid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM renewable WHERE prescriptionid='$prescriptionid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $renewabletimes = htmlspecialchars($row["renewabletimes"]);
                }
            }
        ?>
        <form action='editRenewable.php' method='post'> 
            <label for='prescriptionid'>Prescription ID:</label>
            <input readonly id='prescriptionid' name='prescriptionid' type='text' value='<?php echo $prescriptionid; ?>'><br><br>
            
            <label for='renewabletimes'>Renewable Times:</label>
            <input id='renewabletimes' name='renewabletimes' type='text' value='<?php echo $renewabletimes; ?>'><br><br>
            
            <input type='submit' value='Save Data'>
        </form>
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
