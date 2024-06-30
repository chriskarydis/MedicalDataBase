<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Address Data</title>
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

        input[type="text"], input[type="submit"] {
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
            $addressid = $_GET['addressid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM address WHERE addressid='$addressid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                $street = htmlspecialchars($row["street"]);
                $city = htmlspecialchars($row["city"]);
                $region = htmlspecialchars($row["region"]);
                $country = htmlspecialchars($row["country"]);
                $postal_code = htmlspecialchars($row["postal_code"]);
            }
        ?>
        <form action='editAddress.php' method='post'> 
            <input type='hidden' id='addressid' name='addressid' value='<?php echo $addressid; ?>'>
            
            Street: <input id='street' name='street' type='text' value='<?php echo $street; ?>'> <br><br>
            City: <input id='city' name='city' type='text' value='<?php echo $city; ?>'> <br><br>
            Region: <input id='region' name='region' type='text' value='<?php echo $region; ?>'> <br><br>
            Country: <input id='country' name='country' type='text' value='<?php echo $country; ?>'> <br><br>
            Postal Code: <input id='postal_code' name='postal_code' type='text' value='<?php echo $postal_code; ?>'> <br><br>
                    
            <input type='submit' value='Save Address'>
        </form>
        <br><br>        
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
