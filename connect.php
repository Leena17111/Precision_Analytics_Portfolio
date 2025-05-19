<?php
// Detect if running locally or on live server
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Local XAMPP setup
    $host = "localhost";
    $dbname = "db_panalytics";  
    $username = "root";                
    $password = "";                  
} else {
    // Live hosting (InfinityFree) setup
    $host = "sql301.infinityfree.com";
    $dbname = "if0_39006213_db_pa";  
    $username = "if0_39006213";       
    $password = "panalytics3"; 
}

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
