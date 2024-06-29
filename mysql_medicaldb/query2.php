<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescribed Medicines, Doctors, and Diagnoses</title>
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
            $query = "SELECT v.visitid, v.visit_date, v.visit_type, CONCAT(d.firstname, ' ', d.lastname) as doctor_name, m.med_name as medicine_name
                      FROM prescription p
                      JOIN includes i ON p.prescriptionid = i.prescriptionid
                      JOIN medicine m ON i.medicineid = m.medicineid
                      JOIN doctor d ON p.doctorid = d.doctorid
                      JOIN visit v ON p.amka = v.amka
                      WHERE p.amka = '$patient'";
        } else {
            $query = "SELECT v.visitid, v.visit_date, v.visit_type, CONCAT(d.firstname, ' ', d.lastname) as doctor_name, m.med_name as medicine_name
                      FROM prescription p
                      JOIN includes i ON p.prescriptionid = i.prescriptionid
                      JOIN medicine m ON i.medicineid = m.medicineid
                      JOIN doctor d ON p.doctorid = d.doctorid
                      JOIN visit v ON p.amka = v.amka
                      JOIN patient pa ON p.amka = pa.amka
                      WHERE pa.firstname LIKE '%$patient%' OR pa.lastname LIKE '%$patient%' OR CONCAT(pa.firstname, ' ', pa.lastname) LIKE '%$patient%'";
        }

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>Prescribed Medicines, Doctors, and Diagnoses</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Visit ID</th><th>Visit Date</th><th>Visit Type</th><th>Doctor Name</th><th>Medicine Name</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['visitid']) . "</td>";
                echo "<td>" . htmlspecialchars($row['visit_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['visit_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['doctor_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['medicine_name']) . "</td>";
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
