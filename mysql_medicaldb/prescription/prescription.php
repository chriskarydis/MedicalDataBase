<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription Data - Group 33 Health Insurance App</title>
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

        .scrollable-table {
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
        <div class="header">
            <h1>Prescription Data - Group 33 Health Insurance App</h1>
        </div>
        <p>Prescription data of the health insurance company <b>GROUP 33 CORP</b></p>

        <div class="scrollable-table">
            <table>
                <tr>
                    <th>Prescription ID</th><th>Prescription Type</th><th>Start Date</th><th>Expiration Date</th><th>Comments</th><th>Eligibility</th><th>Dosage</th><th>Doctor ID</th><th>AMKA</th><th>Visit ID</th><th>Is Renewable</th><th>Edit</th><th>Delete</th>
                </tr>
                <?php        
                include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                
                $sql = "SELECT prescriptionid, presc_type, startdate, expirationdate, comments, eligibility, dosage, doctorid, amka, visitid, is_renewable
                        FROM prescription
                        ORDER BY prescriptionid";
                
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $prescriptionid = htmlspecialchars($row["prescriptionid"]);
                        $presc_type = htmlspecialchars($row["presc_type"]);
                        $startdate = htmlspecialchars($row["startdate"]);
                        $expirationdate = htmlspecialchars($row["expirationdate"]);
                        $comments = htmlspecialchars($row["comments"]);
                        $eligibility = htmlspecialchars($row["eligibility"]);
                        $dosage = htmlspecialchars($row["dosage"]);
                        $doctorid = htmlspecialchars($row["doctorid"]);
                        $amka = htmlspecialchars($row["amka"]);
                        $visitid = htmlspecialchars($row["visitid"]);
                        $is_renewable = htmlspecialchars($row["is_renewable"]);
                        echo "<tr>"; 
                        echo "<td>$prescriptionid</td><td>$presc_type</td><td>$startdate</td><td>$expirationdate</td><td>$comments</td><td>$eligibility</td><td>$dosage</td><td>$doctorid</td><td>$amka</td><td>$visitid</td><td>$is_renewable</td>";
                        echo "<td><a href='editForm.php?prescriptionid=$prescriptionid'>Edit</a></td>";
                        echo "<td><a href='deletePrescription.php?prescriptionid=$prescriptionid'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No prescriptions found.</td></tr>";
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
