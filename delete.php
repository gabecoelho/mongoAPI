<?php
/**
 * BYU IT-350 - Databases
 * Gabe Coelho and Junior Gomes
 * delete
 */
ini_set('display_error',1);

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Gather data
$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
$pwd = filter_var($_GET['password'], FILTER_SANITIZE_STRING);

$server = "mongodb://" . $username . ":" . $pwd . "@localhost:20000/PU";

// Connect to MongoDB and get the bulk write driver
$manager = new MongoDB\Driver\Manager($server);

//record to delete
$data = json_decode(file_get_contents("php://input", true));

//_id field value
$id = $data->{'where'};

// delete record
$delete = new MongoDB\Driver\BulkWrite();
$delete->delete(
	['_id' => new MongoDB\BSON\ObjectId($id)],
	['limit' => 0]
);

$result = $manager->executeBulkWrite("PU.blog", $delete);

//print_r($result);

// verify
if ($result->getDeletedCount() == 1) {
    echo json_encode(
		array("message" => "Record successfully deleted")
	);
} else {
    echo json_encode(
            array("message" => "Error while deleting record")
    );
}

?>

