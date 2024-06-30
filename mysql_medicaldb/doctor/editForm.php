<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editing Doctor Data</title>
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

        input[type="text"], input[type="date"], select, input[type="submit"] {
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

        select {
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
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
            $doctorid = $_GET['doctorid'];
            
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                    
            $sql = "SELECT * FROM doctor WHERE doctorid='$doctorid'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $firstname = htmlspecialchars($row["firstname"]);
                    $middlename = htmlspecialchars($row["middlename"]);
                    $lastname = htmlspecialchars($row["lastname"]);
                    $addressid = htmlspecialchars($row["addressid"]);
                    $specialty = htmlspecialchars($row["specialty"]);
                    $email = htmlspecialchars($row["email"]);
                    $telephone = htmlspecialchars($row["telephone"]);
                    $dateofbirth = htmlspecialchars($row["dateofbirth"]);
                    $sex = htmlspecialchars($row["sex"]);
                }
            }

            $addressQuery = "SELECT addressid, street, city, region, country FROM address";
            $addressResult = $conn->query($addressQuery);

            $addressOptions = ""; 
            if ($addressResult->num_rows > 0) {
                while ($row = $addressResult->fetch_assoc()) {
                    $selected = $row['addressid'] == $addressid ? "selected" : "";
                    $addressOptions .= "<option value='" . $row['addressid'] . "' $selected>" . $row['addressid'] . " - " . $row['street'] . ", " . $row['city'] . ", " . $row['region'] . ", " . $row['country'] . "</option>";
                }
            }

        ?>
        <form action='editDoctor.php' method='post'> 
            First Name: <input id='firstname' name='firstname' type='text' value='<?php echo $firstname; ?>'> <br><br>
            Middle Name: <input id='middlename' name='middlename' type='text' value='<?php echo $middlename; ?>'> <br><br>
            Last Name: <input id='lastname' name='lastname' type='text' value='<?php echo $lastname; ?>'> <br><br>
            Date of Birth: <input id='dateofbirth' name='dateofbirth' type='date' value='<?php echo $dateofbirth; ?>'> <br><br>
            Address ID: 
            <select id='addressid' name='addressid'>
                <?php echo $addressOptions; ?>
            </select><br><br>
            Specialty: <input id='specialty' name='specialty' type='text' value='<?php echo $specialty; ?>'> <br><br>
            Email: <input id='email' name='email' type='text' value='<?php echo $email; ?>'> <br><br>
            Telephone: <input id='telephone' name='telephone' type='text' value='<?php echo $telephone; ?>'> <br><br>
            Sex: 
            <select id='sex' name='sex'> 
                <option <?php if ($sex == 'Male') echo 'selected'; ?> value='Male'>Man</option>
                <option <?php if ($sex == 'Female') echo 'selected'; ?> value='Female'>Woman</option>
                <option <?php if ($sex == 'Other') echo 'selected'; ?> value='Other'>Other</option>
            </select><br><br>
                    
            <input type='submit' value='Save Data'>
        </form>
        <br><br>        
        <a href="../information.html">Return to Home Page</a>
    </div>
</body>
</html>
