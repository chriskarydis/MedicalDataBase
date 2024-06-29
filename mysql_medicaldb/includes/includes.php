<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Includes Data - Group 33 Health Insurance App</title>
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
            <h1>Includes Data - Group 33 Health Insurance App</h1>
        </div>
        <p>Includes data of the health insurance company <b>GROUP 33 CORP</b></p>

        <div class="table-container">
            <table>
                <tr>
                    <th>Includes ID</th><th>Medicine ID</th><th>Prescription ID</th><th>Edit</th><th>Delete</th>
                </tr>
                <?php        
                include 'C:/xampp/htdocs/mysql_medicaldb/connDB.php';
                
                $sql = "SELECT includesid, medicineid, prescriptionid FROM includes ORDER BY includesid";
                
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $includesid = htmlspecialchars($row["includesid"]);
                        $medicineid = htmlspecialchars($row["medicineid"]);
                        $prescriptionid = htmlspecialchars($row["prescriptionid"]);
                        echo "<tr>"; 
                        echo "<td>$includesid</td><td>$medicineid</td><td>$prescriptionid</td>";
                        echo "<td><a href='editForm.php?includesid=$includesid'>Edit</a></td>";
                        echo "<td><a href='deleteIncludes.php?includesid=$includesid'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found.</td></tr>";
                }
                
                $conn->close();
                ?>    
            </table>
        </div>
        
        <br><br>
        <a href="../informantion.html">Return to Home Page</a>

        <div class="footer">
            <p>&copy; 2024 Group 33 (Christos-Spyridon Karydis / Dimitrios Konispoliatis). All rights reserved.</p>
        </div>
    </div>
</body>
</html>
