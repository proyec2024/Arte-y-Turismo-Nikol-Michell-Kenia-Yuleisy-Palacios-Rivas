<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "arteturistico";

$servername = "localhost";
$username = "keniclasespiti_root"; 
$password = "9*O&Ma0Pn78i";     
$dbname = "keniclasespiti_login";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
