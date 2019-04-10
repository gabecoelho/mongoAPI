<?php
/*
 * BYU IT-350 - Databases
 * Gabe Coelho and Junior Gomes
 * Read
 */
ini_set('display_error',1);

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Gather data
$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
$pwd = filter_var($_GET['password'], FILTER_SANITIZE_STRING);

$server = "mongodb://" . $username . ":" . $pwd . "@localhost:20000/PU";

// Connect to MongoDB and get the bulk write driver
$manager = new MongoDB\Driver\Manager($server);
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

