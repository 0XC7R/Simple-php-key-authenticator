<?php 

require_once __DIR__ . '/../globals.php';

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    exit();
}

global $db;
$db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

function init(): void
{
    global $db;

    if (!file_exists((string)$GLOBALS['DatabaseName'])) {
        error_log('The database: ' . $GLOBALS['DatabaseName'] . ' Does not exist. Please check permissions', 1);
        exit();
    }

    $db->exec('CREATE TABLE IF NOT EXISTS KeyStorage (id INTEGER PRIMARY KEY, KeyString TEXT)'); // edit table if you want more handling
}

function GetKey($key) {
    try {
        $db = new SQLite3($GLOBALS['DatabaseName'], SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

        $query = "SELECT * FROM KeyStorage WHERE KeyString = :key"; // get all data related to that key for later processing

        $stmt = $db->prepare($query);

        $stmt->bindValue(':key', $key, SQLITE3_TEXT);

        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);

        // if the row data isnt null and actually has data then return it
        if ($row && !is_null($row)) {

            return json_encode($row); // encode it so we can decode and index array correctly

        } else {
            return false; // we return this as the error code
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString(), 0);
        return false; 
    }
}

init();

?>

