<?php
// Database credentials
define('DB_SERVER', 'uanvm.h.filess.io'); // Host
define('DB_USERNAME', 'aunit_thuscowrow'); // User
define('DB_PASSWORD', 'Pr@p0nVii');     // Password
define('DB_NAME', 'aunit_thuscowrow');  // Database
define('DB_PORT', 61002);              // Port

// Attempt to connect to MySQL database
// เพิ่ม DB_PORT เข้าไปในพารามิเตอร์ของ mysqli constructor
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Check connection
if($conn->connect_error){
    die("ERROR: Could not connect. " . $conn->connect_error);
}

// Set character set to UTF-8 for proper Thai display
$conn->set_charset("utf8mb4");
?>