<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "test1";

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$tableName = "province"; // Replace with the actual table name

$query = "SELECT id, province FROM $tableName";

$result = $mysqli->query($query);

if ($result) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Province</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['province'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    $result->close();
} else {
    echo "Query failed: " . $mysqli->error;
}

$mysqli->close();
?>
