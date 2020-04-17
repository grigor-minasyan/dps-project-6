<?php
// Only allow POST requests
if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
  throw new Exception("\nOnly POST requests are allowed, not ".strtoupper($_SERVER['REQUEST_METHOD']));
}

// Make sure Content-Type is application/json
$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (stripos($content_type, 'application/json') === false) {
  throw new Exception("\nContent-Type must be application/json, not not not not not ".$_SERVER['CONTENT_TYPE']);
}

// Include config file
require_once "config.php";

// Read the input stream
$body = file_get_contents("php://input");
$event_id_to_delete = json_decode($body)->event_id_to_delete;

// Display the object
// print_r($object);

$sql = "DELETE FROM event_history WHERE event_id={$event_id_to_delete}";

if ($mysqli->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $mysqli->error;
}
