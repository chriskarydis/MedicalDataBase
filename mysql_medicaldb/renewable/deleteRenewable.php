<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Renewable - Group 33 Health Insurance App</title>
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

        .message {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success-message {
            color: #4CAF50;
        }

        .error-message {
            color: #f44336;
        }

        .return-link {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .return-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
        $prescriptionid = $_GET['prescriptionid'];
        
        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                
        $deleteSql = "DELETE FROM renewable WHERE prescriptionid='$prescriptionid'";
        
        if ($result = $conn->query($deleteSql)) {
            echo "<p class='message success-message'>The renewable entry is deleted</p>";
        } else {
            echo "<p class='message error-message'>Delete Failure: ".$conn->error."</p>";
        }
        ?>
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
