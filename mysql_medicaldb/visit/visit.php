<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visit Data - Group 33 Health Insurance App</title>
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

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #6a11cb;
            color: #fff;
            font-weight: bold;
        }

        th, td {
            white-space: nowrap;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            background-color: #f0f8ff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .footer p {
            margin: 0;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Visit Data - Group 33 Health Insurance App</h1>
        </div>
        <p>Visit data of the health insurance company <b>GROUP 33 CORP</b></p>

        <div class="table-container">
            <table>
                <tr>
                    <th>Visit ID</th><th>AMKA</th><th>Doctor ID</th><th>Doctor Name</th><th>Hospital/Clinic ID</th><th>Hospital Name</th><th>Visit Date</th><th>Visit Type</th><th>Edit</th><th>Delete</th>
                </tr>       
                <?php        
                include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

                $sql = "SELECT v.visitid, v.amka, v.doctorid, d.firstname, d.lastname, v.hospitalclinicid, h.hosp_name, v.visit_date, v.visit_type
                        FROM visit v
                        JOIN doctor d ON v.doctorid = d.doctorid
                        JOIN hospital_clinic h ON v.hospitalclinicid = h.hospitalclinicid
                        ORDER BY v.visitid";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $visitid = htmlspecialchars($row["visitid"]);
                        $amka = htmlspecialchars($row["amka"]);
                        $doctorid = htmlspecialchars($row["doctorid"]);
                        $doctor_name = htmlspecialchars($row["firstname"] . " " . $row["lastname"]);
                        $hospitalclinicid = htmlspecialchars($row["hospitalclinicid"]);
                        $hospital_name = htmlspecialchars($row["hosp_name"]);
                        $visit_date = htmlspecialchars($row["visit_date"]);
                        $visit_type = htmlspecialchars($row["visit_type"]);
                        echo "<tr>"; 
                        echo "<td>$visitid</td><td>$amka</td><td>$doctorid</td><td>$doctor_name</td><td>$hospitalclinicid</td><td>$hospital_name</td><td>$visit_date</td><td>$visit_type</td>";
                        echo "<td><a href='editForm.php?visitid=$visitid'>Edit</a></td>";
                        echo "<td><a href='deleteVisit.php?visitid=$visitid'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No visits found.</td></tr>";
                }

                $conn->close();
                ?>    
            </table>
        </div>

        <br><br>
        <a href="../information.html">Return to Home Page</a>

        <div class="footer">
            <p>&copy; 2024 Group 33 (C. S. Karydis / D. Konispoliatis / A. Georgakopoulos). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
