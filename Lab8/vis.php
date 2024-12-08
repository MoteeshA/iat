<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Student Records</h1>

    <?php
    // Database connection
    $con = new mysqli("localhost", "root", "", "studentdb");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Fetch student records
    $query = "SELECT * FROM tblstudent";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $students = $result->fetch_all(MYSQLI_ASSOC);
        echo "<h2>Before Sorting</h2>";

        echo "<table>";
        echo "<tr><th>Sl. No.</th><th>USN</th><th>Name</th><th>Department</th></tr>";
        foreach ($students as $index => $student) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . $student['usn'] . "</td>";
            echo "<td>" . $student['name'] . "</td>";
            echo "<td>" . $student['dept'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Selection sort by USN
        for ($i = 0; $i < count($students); $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < count($students); $j++) {
                if ($students[$j]['usn'] < $students[$minIndex]['usn']) {
                    $minIndex = $j;
                }
            }
            $temp = $students[$i];
            $students[$i] = $students[$minIndex];
            $students[$minIndex] = $temp;
        }

        echo "<h2>After Sorting - Selection Sort</h2>";
        echo "<table>";
        echo "<tr><th>Sl. No.</th><th>USN</th><th>Name</th><th>Department</th></tr>";

        foreach ($students as $index => $student) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . $student['usn'] . "</td>";
            echo "<td>" . $student['name'] . "</td>";
            echo "<td>" . $student['dept'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No student records found.</p>";
    }

    // Close connection
    $con->close();
    ?>
</body>
</html>
