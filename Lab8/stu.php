<?php 
$conn = new mysqli("localhost", "root", "", "visitor_counter");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT counter_value FROM visits WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $counterVal = $row['counter_value'] + 1;
    $conn->query("UPDATE visits SET counter_value = $counterVal WHERE id = 1");
} else {
    $counterVal = 1;
    $conn->query("INSERT INTO visits (counter_value) VALUES ($counterVal)");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Count</title>
</head>
<body>
    <h1>Welcome to my page!</h1>
    <footer>
        <em>No. of visitors: <?php echo $counterVal; ?></em>
    </footer>
</body>
</html>
