<?php

$conn = new mysqli(
"localhost",
"root",
"",
"parcel_pulse"
);

if($conn->connect_error){
die("Connection Failed");
}

?>