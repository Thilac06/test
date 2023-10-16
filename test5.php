<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "test1";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT district.district, province.province,type_of_la.type_of_la,la_name.la_name
FROM district 
INNER JOIN province ON district.province = province.id
INNER JOIN type_of_la ON type_of_la.district = district.province
INNER JOIN la_name ON la_name.type_of_la = type_of_la.id";


$result = $mysqli->query($query);

if ($result) {
    echo "<table border='1'>";
    echo "<tr><th>Province</th><th>District</th><th>LA</th></th><th>LA Name</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['province'] . "</td>";
        echo "<td>" . $row['district'] . "</td>";
        echo "<td>" . $row['type_of_la'] . "</td>";
        echo "<td>" . $row['la_name'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    $result->close();
} else {
    echo "Query failed: " . $mysqli->error;
}

$mysqli->close();
?>
