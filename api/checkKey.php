<?php 

require_once __DIR__ . "/../globals.php";
require_once __DIR__ . "/../utils/sql.php"; // sql connection and handles

// Insainly basic checking of the key. You can edit this logic for further handling
// It returns the data of the key if it exists so it is easier for you to add further functionality already.

function CheckKey(string $key):bool {

    $result = GetKey($key);

    if ($result === false) {
        return false;
    } else {
        return true;
    }

}

?>