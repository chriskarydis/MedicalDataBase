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
            max-width: 600px;
            position: relative; 
        }

        .success-message {
            color: #4CAF50;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error-message {
            color: #f44336;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
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
            display: block;
            margin-top: 20px; 
        }

        .return-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

			$doctorid = isset($_POST['doctorid']) ? $_POST['doctorid'] : ''; 
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$dateofbirth = $_POST['dateofbirth'];
			$addressid = $_POST['addressid'];
			$specialty = $_POST['specialty'];
			$email = $_POST['email'];
			$telephone = $_POST['telephone'];
			$sex = $_POST['sex'];

			$checkAddressQuery = "SELECT COUNT(*) as count FROM address WHERE addressid = '$addressid'";
			$checkAddressResult = $conn->query($checkAddressQuery);
			if ($checkAddressResult && $checkAddressResult->num_rows > 0) {
				$addressRow = $checkAddressResult->fetch_assoc();
				if ($addressRow['count'] > 0) {
					$insertQuery = "INSERT INTO doctor (firstname, middlename, lastname, dateofbirth, addressid, specialty, email, telephone, sex) 
									VALUES ('$firstname', '$middlename', '$lastname', '$dateofbirth', '$addressid', '$specialty', '$email', '$telephone', '$sex')";

					if ($conn->query($insertQuery) === TRUE) {
						echo "<p class='success-message'>New record created successfully</p>";
					} else {
						echo "<p class='error-message'>Error: " . $insertQuery . "<br>" . $conn->error . "</p>";
					}
				} else {
					echo "<p class='error-message'>Error: Invalid addressid provided.</p>";
				}
			} else {
				echo "<p class='error-message'>Error: Checking addressid failed.</p>";
			}

            $conn->close();
        ?>
        <a href="../informantion.html" class="return-link">Return to Home Page</a>
    </div>
</body>
</html>
