<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "test1";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT `data` FROM genaral_details";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $serializedData = $row['data'];
        $dataArray = unserialize($serializedData);

        
        print_r($dataArray);
    }
} else {
    echo "No results found";
}


$conn->close();
?>
