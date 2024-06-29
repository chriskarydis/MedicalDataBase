<?php
include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

$patient = $_POST['patient'];
$doctor = $_POST['doctor'];

if (is_numeric($patient) && is_numeric($doctor)) {
    $query = "SELECT v.visitid, v.visit_date, v.visit_type, v.doctorid, v.amka, 
                     ni.initialdiagnosis AS newissue_initialdiagnosis, 
                     c.weight AS checkup_weight, c.height AS checkup_height, 
                     c.systolic_blood_pressure AS checkup_systolic, 
                     c.diastolic_blood_pressure AS checkup_diastolic,
                     i.statebetween AS inspection_statebetween
              FROM visit v
              LEFT JOIN newissue ni ON v.visitid = ni.visitid
              LEFT JOIN checkup c ON v.visitid = c.visitid
              LEFT JOIN inspection i ON v.visitid = i.visitid
              JOIN patient p ON v.amka = p.amka
              JOIN doctor d ON v.doctorid = d.doctorid
              WHERE p.amka = '$patient' AND d.doctorid = '$doctor'";
} else {
    $query = "SELECT v.visitid, v.visit_date, v.visit_type, v.doctorid, v.amka, 
                     ni.initialdiagnosis AS newissue_initialdiagnosis, 
                     c.weight AS checkup_weight, c.height AS checkup_height, 
                     c.systolic_blood_pressure AS checkup_systolic, 
                     c.diastolic_blood_pressure AS checkup_diastolic,
                     i.statebetween AS inspection_statebetween
              FROM visit v
              LEFT JOIN newissue ni ON v.visitid = ni.visitid
              LEFT JOIN checkup c ON v.visitid = c.visitid
              LEFT JOIN inspection i ON v.visitid = i.visitid
              JOIN patient p ON v.amka = p.amka
              JOIN doctor d ON v.doctorid = d.doctorid
              WHERE (p.firstname LIKE '%$patient%' OR p.lastname LIKE '%$patient%') 
              AND (d.firstname LIKE '%$doctor%' OR d.lastname LIKE '%$doctor%')";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>All Data of Visits</title>
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
            margin-top: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
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
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class='container'>";

    echo "<h2>All Data of Visits</h2>";
    echo "<table border='1'>
            <tr>
                <th>Visit ID</th><th>Visit Date</th><th>Visit Type</th><th>Doctor ID</th><th>AMKA</th>";
                
    $headers = [];
    $data = [];
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['newissue_initialdiagnosis'])) {
            $headers['newissue_initialdiagnosis'] = 'New Issue Initial Diagnosis';
        }
        if (!empty($row['checkup_weight'])) {
            $headers['checkup_weight'] = 'Checkup Weight';
        }
        if (!empty($row['checkup_height'])) {
            $headers['checkup_height'] = 'Checkup Height';
        }
        if (!empty($row['checkup_systolic'])) {
            $headers['checkup_systolic'] = 'Checkup Systolic BP';
        }
        if (!empty($row['checkup_diastolic'])) {
            $headers['checkup_diastolic'] = 'Checkup Diastolic BP';
        }
        if (!empty($row['inspection_statebetween'])) {
            $headers['inspection_statebetween'] = 'Inspection State Between';
        }
        $data[] = $row;
    }

    foreach ($headers as $key => $header) {
        echo "<th>$header</th>";
    }

    echo "</tr>";

    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['visitid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['visit_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['visit_type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['doctorid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['amka']) . "</td>";
        foreach ($headers as $key => $header) {
            echo "<td>" . htmlspecialchars($row[$key]) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<br><br>";
    echo "<a href='questions.html' class='back-link'>Return to Questions</a>";
    echo "</div></body></html>";
} else {
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>No Records Found</title>
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
            text-align: center;
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            color: #333;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h2>No records found.</h2>
        <br><br>
        <a href='questions.html' class='back-link'>Return to Questions</a>
    </div>
</body>
</html>";
}

$conn->close();
?>
