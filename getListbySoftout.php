<?php
include("connect.php");

$currentYear = date('Y');

$collections = (new MongoDB\Client)->Mongo->inventory;

$cursor = $collections->find();

$result = [];

foreach ($cursor as $document) {
    $warrantyExpired = $document['purchase_year'] + $document['warranty_period'] > $currentYear;

    if ($warrantyExpired) {
        echo "Inventory Number: " . $document['inventory_number'] . "<br>";
        echo "Purchase Year: " . $document['purchase_year'] . "<br>";
        echo "Warranty Period: " . $document['warranty_period'] . "<br>";
        echo "Processor: " . $document['processor'] . "<br>";
        echo "Licensed until: " . $document['licensed_until'] . "<br>";
        echo "Memory: " . $document['memory'] . "<br>";
        echo "Disk Capacity: " . $document['disk_capacity'] . "<br>";
        echo "Licensed Software: ";
        foreach ($document['licensed_software'] as $software) {
            echo $software . ", ";
        }
        echo "<br><br>";

        $result[] = $document;
    }
}

echo "<script>localStorage.setItem('request', '" . json_encode($result) . "');</script>";
