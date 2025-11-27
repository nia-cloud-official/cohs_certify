<?php
require_once "db.php";
$db = new DB();
$result = $db->conn->query("SELECT * FROM settings LIMIT 1");

if ($result->num_rows == 0) {
    header("Location: setup.php");
    exit;
} else {
    $school = $result->fetch_assoc();
    echo "<h2>School Settings</h2>";
    echo "<p><strong>School:</strong> {$school['school_name']}</p>";
    echo "<p><strong>Website:</strong> {$school['website_link']}</p>";
}
?>
