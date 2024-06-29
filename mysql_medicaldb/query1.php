<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctors and Periods Monitoring Patient</title>
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

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

        $patient = $_POST['patient'];

        if (is_numeric($patient)) {
            $query = "SELECT d.firstname, d.lastname, s.startdate, s.enddate 
                      FROM supervise s
                      JOIN doctor d ON s.doctorid = d.doctorid
                      WHERE s.amka = '$patient'";
        } else {
            $query = "SELECT d.firstname, d.lastname, s.startdate, s.enddate 
                      FROM supervise s
                      JOIN doctor d ON s.doctorid = d.doctorid
                      JOIN patient p ON s.amka = p.amka
                      WHERE p.firstname LIKE '%$patient%' OR p.lastname LIKE '%$patient%' OR CONCAT(p.firstname, ' ', p.lastname) LIKE '%$patient%'";
        }

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>Doctors and Periods Monitoring Patient</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Doctor First Name</th><th>Doctor Last Name</th><th>Start Date</th><th>End Date</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['startdate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['enddate']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No records found.";
        }

        $conn->close();
        ?>
        <br><br>
        <a href="questions.html" class="back-link">Return to Questions</a>
    </div>
</body>
</html>
