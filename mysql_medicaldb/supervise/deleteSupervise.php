<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Supervision Record - Group 33 Health Insurance App</title>
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

        .message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .success-message {
            color: #4CAF50;
            font-weight: bold;
        }

        .error-message {
            color: #f44336;
            font-weight: bold;
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
                    
            $deleteSql = "DELETE FROM supervise WHERE recordid='$recordid'";
            
            if ($result = $conn->query($deleteSql)) {
                echo "<p class='message success-message'>The supervision record is deleted.</p>";
            } else {
                echo "<p class='message error-message'>Delete Failure: ".$conn->error."</p>";
            }
        ?>
        <a href="../information.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
