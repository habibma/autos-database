<?php
$host = "postgresql://fred:vlNkSyzAyIkQl0MMeVDdNMwfwLckGSoo@dpg-cusv4gbqf0us739ponsg-a/misc_yo7z";
$dbname = "misc_yo7z";
$user = "fred";
$pass = "vlNkSyzAyIkQl0MMeVDdNMwfwLckGSoo";

try {
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
