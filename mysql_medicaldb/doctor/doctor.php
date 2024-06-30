<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Data - Group 33 Health Insurance App</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
            <h1>Doctor Data - Group 33 Health Insurance App</h1>
        </div>
        <p>Doctor data of the health insurance company <b>GROUP 33 CORP</b></p>

        <table>
            <tr>
                <th>Doctor ID</th><th>Last Name</th><th>First Name</th><th>Specialty</th><th>Telephone</th><th>Hospital Name</th><th>Edit</th><th>Delete</th>
            </tr>
            <?php
            include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';

            $sql = "SELECT d.doctorid, d.lastname, d.firstname, d.specialty, d.telephone, hc.hosp_name
                    FROM doctor d
                    LEFT JOIN workson w ON d.doctorid = w.doctorid
                    LEFT JOIN hospital_clinic hc ON w.hospitalclinicid = hc.hospitalclinicid
                    ORDER BY d.doctorid";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $doctorid = htmlspecialchars($row["doctorid"]);
                    $lastname = htmlspecialchars($row["lastname"]);
                    $firstname = htmlspecialchars($row["firstname"]);
                    $specialty = htmlspecialchars($row["specialty"]);
                    $telephone = htmlspecialchars($row["telephone"]);
                    $hosp_name = htmlspecialchars($row["hosp_name"]);

                    echo "<tr>";
                    echo "<td>$doctorid</td><td>$lastname</td><td>$firstname</td><td>$specialty</td><td>$telephone</td><td>$hosp_name</td>";
                    echo "<td><a href='editForm.php?doctorid=$doctorid'>Edit</a></td>";
                    echo "<td><a href='deleteDoctor.php?doctorid=$doctorid'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No doctors found.</td></tr>";
            }

            $conn->close();
            ?>
        </table>

        <br><br>
        <a href="../information.html">Return to Home Page</a>

        <div class="footer">
            <p>&copy; 2024 Group 33 (C. S. Karydis / D. Konispoliatis / A. Georgakopoulos). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
