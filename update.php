<?php
/**
 * BYU IT-350 - Databases
 * Gabe Coelho and Junior Gomes
 * update
 */
ini_set('display_error',1);

// required headers
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Gather data
$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);
$pwd = filter_var($_GET['password'], FILTER_SANITIZE_STRING);

$server = "mongodb://" . $username . ":" . $pwd . "@localhost:20000/PU";

// Connect to MongoDB and get the bulk write driver
$manager = new MongoDB\Driver\Manager($server);

//record to update
$data = json_decode(file_get_contents("php://input", true));

$fields = $data->{'fields'};

$set_values = array();

foreach ($fields as $key => $fields) {
	$arr = (array)$fields;
	foreach ($fields as $key => $value) {
		$set_values[$key] = $value;
	}
}

//_id field value
$id = $data->{'where'};

// update record
$update = new MongoDB\Driver\BulkWrite();
$update->update(
	['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => $set_values], ['multi' => false, 'upsert' => false]
);

$result = $manager->executeBulkWrite("PU.blog", $update);

// verify
if ($result->getModifiedCount() == 1) {
    echo json_encode(
		array("message" => "Record successfully updated")
	);
} else {
    echo json_encode(
            array("message" => "Error while updating record")
    );
}

?>
