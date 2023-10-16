<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "test1";


$mysqli = new mysqli($host, $username, $password, $database);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$query = "SELECT uid, id, la_name, type_of_la FROM la_name";

$result = $mysqli->query($query);


if ($result) {
    
    echo '<table border="1">';
    echo '<tr><th>UID</th><th>ID</th><th>LA Name</th><th>Type of LA</th></tr>';

 
    while ($row = $result->fetch_assoc()) {
        $uid = $row['uid'];
        $id = $row['id'];
        $laName = $row['la_name'];
        $typeOfLa = $row['type_of_la'];

        echo "<tr><td>$uid</td><td>$id</td><td>$laName</td><td>$typeOfLa</td></tr>";
    }

    
    echo '</table>';

    
    $result->free();
} else {
    echo "Error: " . $mysqli->error;
}


$mysqli->close();
?>
