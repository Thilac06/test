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

$sql = "SELECT `data` FROM genaral_details";
$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $serializedData = $row['data'];

        // Use a try-catch block to handle potential unserialize errors
        try {
            $dataArray = unserialize($serializedData);

            if ($dataArray !== false && isset($dataArray[1])) {
                $summaryData[] = [
                    'Source' => 'genaral_details',
                    'Value for Key 1' => $dataArray[1],
                ];
            }
        } catch (Exception $e) {
            // Handle the unserialize error (e.g., log the error or ignore this entry)
            echo "Unserialize error: " . $e->getMessage();
        }
    }
    $result->free();
}

$mysqli->close();

echo '<h2>Summary Table:</h2>';
echo '<table border="1">';
echo '<tr><th>Source</th><th>Value for Key 1</th></tr>';

foreach ($summaryData as $row) {
    echo '<tr>';
    echo '<td>' . $row['Source'] . '</td>';
    echo '<td>' . ($row['Value for Key 1'] ?? '') . '</td>';
    echo '</tr>';
}

echo '</table>';
?>