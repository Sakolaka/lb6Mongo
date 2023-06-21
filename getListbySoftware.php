<?php
include("connect.php");

$licensed_software = $_POST["soft"];

$collections = (new MongoDB\Client)->Mongo->inventory;

$filter = ['licensed_software' =>  $licensed_software];
$cursor = $collections->find($filter);

$result = [];
foreach ($cursor as $document) {
    echo "Inventory Number: " . $document['inventory_number'] . "<br>";
    echo "Purchase Year: " . $document['purchase_year'] . "<br>";
    echo "Warranty Period: " . $document['warranty_period'] . "<br>";
    echo "Processor: " . $document['processor'] . "<br>";
    echo "licensed until: " . $document['licensed_until'] . "<br>";
    echo "Memory: " . $document['memory'] . "<br>";
    echo "Disk Capacity: " . $document['disk_capacity'] . "<br>";
    echo "Licensed Software: ";
    foreach ($document['licensed_software'] as $software) {
        echo $software . ", ";
    }
    echo "<br><br>";

    $result[] = $document;
}

echo "<script>localStorage.setItem('request', '" . json_encode($result) . "');</script>";
