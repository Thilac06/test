<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "test1";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$summaryData = [];


$query = "SELECT uid, la_name, type_of_la FROM la_name";
$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $summaryData[] = [
            'Source' => 'la_name',
            'UID' => $row['uid'],
            'Name' => $row['la_name'],
            'Type' => $row['type_of_la'],
        ];
    }
    $result->free();
}


$sql = "SELECT `data` FROM genaral_details";
$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $serializedData = $row['data'];
        $dataArray = unserialize($serializedData);

        if ($dataArray !== false && isset($dataArray[1])) {
            $summaryData[] = [
                'Source' => 'genaral_details',
                'Value for Key 1' => $dataArray[1],
            ];
        }
    }
    $result->free();
}


$sqlDistrict = "SELECT uid, province FROM district";
$resultDistrict = $mysqli->query($sqlDistrict);

if ($resultDistrict) {
    while ($rowDistrict = $resultDistrict->fetch_assoc()) {
        $summaryData[] = [
            'Source' => 'district',
            'UID' => $rowDistrict['uid'],
            'Province' => $rowDistrict['province'],
        ];
    }
    $resultDistrict->free();
}

$mysqli->close();


echo '<h2>Summary Table:</h2>';
echo '<table border="1">';
echo '<tr><th>Source</th><th>UID</th><th>Name</th><th>Type</th><th>Value for Key 1</th><th>Province</th></tr>';

foreach ($summaryData as $row) {
    echo '<tr>';
    echo '<td>' . $row['Source'] . '</td>';
    echo '<td>' . ($row['UID'] ?? '') . '</td>';
    echo '<td>' . ($row['Name'] ?? '') . '</td>';
    echo '<td>' . ($row['Type'] ?? '') . '</td>';
    echo '<td>' . ($row['Value for Key 1'] ?? '') . '</td>';
    echo '<td>' . ($row['Province'] ?? '') . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
