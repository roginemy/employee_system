<?php
session_start();
$server = "localhost";
$user = "root";
$password = "";
$database = "employee_management";

$conn = mysqli_connect($server, $user, $password, $database);