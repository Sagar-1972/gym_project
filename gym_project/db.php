<?php

$host = "sql100.infinityfree.com";
$user = "if0_41380877";
$password = "Mygym1234";
$database = "if0_41380877_gym_sql";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>