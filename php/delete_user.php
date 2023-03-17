<?php
date_default_timezone_set("America/Santo_Domingo");
require_once("../config/db.php");
require_once("../config/conexion.php");

$sql = "DELETE FROM users WHERE user_id = '".$_POST['id']."'";

if ($con->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}

$con->close();

?>