<?php
include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

$query = "SELECT CONCAT(d.firstname, ' ', d.lastname) as doctor_name, d.specialty, h.hosp_name as hospital_name, 
                 CONCAT(a.street, ', ', a.city, ', ', a.region, ', ', a.country, ', ', a.postal_code) as address
          FROM doctor d
          JOIN workson w ON d.doctorid = w.doctorid
          JOIN hospital_clinic h ON w.hospitalclinicid = h.hospitalclinicid
          JOIN address a ON h.addressid = a.addressid";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Doctors and Hospitals Collaboration</title>
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
    <div class='container'>";

    echo "<h2>Doctors and Hospitals Collaboration</h2>";
    echo "<table border='1'>
            <tr>
                <th>Doctor Name</th><th>Specialty</th><th>Hospital Name</th><th>Address</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['doctor_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['specialty']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hospital_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<br><br>";
    echo "<a href='questions.html' class='back-link'>Return to Questions</a>";
    echo "</div></body></html>";
} else {
    echo "No records found.";
}

$conn->close();
?>
