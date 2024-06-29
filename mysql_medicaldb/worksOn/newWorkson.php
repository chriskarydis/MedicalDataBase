<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert New Workson - Group 33 Health Insurance App</title>
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
            margin-top: 10px;
        }

        input[type='submit']:hover {
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
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            $doctorQuery = "SELECT doctorid FROM doctor";
            $doctorResult = $conn->query($doctorQuery);

            $doctorOptions = ""; 
            if ($doctorResult->num_rows > 0) {
                while ($row = $doctorResult->fetch_assoc()) {
                    $doctorOptions .= "<option value='" . $row['doctorid'] . "'>" . $row['doctorid'] . "</option>";
                }
            }

            $hospitalclinicQuery = "SELECT hospitalclinicid FROM hospital_clinic";
            $hospitalclinicResult = $conn->query($hospitalclinicQuery);

            $hospitalclinicOptions = ""; 
            if ($hospitalclinicResult->num_rows > 0) {
                while ($row = $hospitalclinicResult->fetch_assoc()) {
                    $hospitalclinicOptions .= "<option value='" . $row['hospitalclinicid'] . "'>" . $row['hospitalclinicid'] . "</option>";
                }
            }
        ?>
        <h2>Insert New Workson</h2>
        <form action='storeWorkson.php' method='post'> 
            <input type='hidden' id='worksonid' name='worksonid' value=''> 
            
            <label for='doctorid'>Doctor ID:</label>
            <select id='doctorid' name='doctorid'>
                <?php echo $doctorOptions; ?>
            </select><br><br>
            <label for='hospitalclinicid'>Hospital Clinic ID:</label>
            <select id='hospitalclinicid' name='hospitalclinicid'>
                <?php echo $hospitalclinicOptions; ?>
            </select><br><br>
            <input type='submit' value='Save Data'>
        </form>
        <br><br>
        <a href="../informantion.html">Return to Home Page</a>
    </div>
</body>
</html>
```