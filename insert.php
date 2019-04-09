<?php
/**
 * BYU IT-350 - Databases
 * Gabe Coelho and Junior Gomes
 * INSERT
 */


// Connect to MongoDB and get the bulk write driver
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite;

// Build document
$object = array( 
   "authors" => ["me", "you"], 
   "date" => "2019-04-03", 
   "contents" => ["blog stuff", "blog again please"],
   "keywords" => ["keyword1", "keyword2"],
   "related_articles" => ["insert_test", "testing_again"]
);

// Insert document into driver
$bulk->insert($object);
$manager->executeBulkWrite('PU.blog', $bulk);

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
