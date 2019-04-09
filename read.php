<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");




$filter = [];
$options = [];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('PU.blog', $query);

// Insert into database
foreach ($cursor as $document) {
    $entry = json_encode($document, JSON_PRETTY_PRINT);
    var_dump($entry);
}

?>
