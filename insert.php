<?php
/**
 * BYU IT-350 - Databases
 * Gabe Coelho and Junior Gomes
 * INSERT
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Gather data
$username = $_GET['username'];
$pwd = $_GET['password'];

$server = "mongodb://" . $username . ":" . $pwd . "@localhost:27017/PU";

// Connect to MongoDB and get the bulk write driver
$manager = new MongoDB\Driver\Manager($server);

$object = json_decode(file_get_contents("php://input", true));

$insert = new MongoDB\Driver\BulkWrite();

// Build document
//$object = array( 
//   "authors" => ["moroni", "you"], 
//   "date" => "2019-04-03", 
//   "contents" => ["blog stuff", "blog again please"],
//   "keywords" => ["keyword1", "keyword2"],
//   "related_articles" => ["insert_test", "testing_again"]
//);
// Insert document into driver
$insert->insert($object);
$result = $manager->executeBulkWrite('PU.blog', $insert);

// verify
if ($result->getInsertedCount() == 1) {
    echo json_encode(
		array("message" => "Record successfully created")
	);
} else {
    echo json_encode(
            array("message" => "Error while saving record")
    );
}

?>
