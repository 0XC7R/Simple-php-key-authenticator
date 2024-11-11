<?php

define("IN_APP", true); // prevents included files from not working

require_once "globals.php";
require_once "./utils/sql.php"; // sql connection and handles

?>

<!DOCTYPE HTML>
<html>

<header>
    <title>Simple php key authenticator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</header>
<body>
    <?php include(__DIR__ . "/api/checkKey.php"); // include checkKey api in the index 
    
    // change to $_POST for post requests.
    if (isset($_GET["Key"])) {

        if (empty($_GET["Key"])) {
            echo "{\"Status\": \"Key Empty\" }";
            return; // prevents further execution
        }

        $exists = CheckKey(strval($_GET["Key"]));

        if ($exists) { 
            // edit to return other data if wanted
            echo "{\"Status\": \"Key Exists\" }";
            return; // prevents further execution
        } else {
            echo "{\"Status\": \"Key Invalid\" }";
            return; // prevents further execution
        }
    } else {
        echo "{\"Status\": \"No Key Parsed\" }";
        return; // prevents further execution
    }
?>
</body>

</html>