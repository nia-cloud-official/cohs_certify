<?php
require_once "db.php";

class Setup {
    private $conn;
    public function __construct() {
        $db = new DB();
        $this->conn = $db->conn;
    }

    public function createTables() {
        $sql1 = "CREATE TABLE IF NOT EXISTS settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            school_name VARCHAR(255) NOT NULL,
            website_link VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->conn->query($sql1);

        $sql2 = "CREATE TABLE IF NOT EXISTS certificates (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_name VARCHAR(255) NOT NULL,
            course_name VARCHAR(255) NOT NULL,
            certificate_id VARCHAR(100) NOT NULL UNIQUE,
            issued_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->conn->query($sql2);
    }

    public function saveSettings($school_name, $website_link) {
        $stmt = $this->conn->prepare("INSERT INTO settings (school_name, website_link) VALUES (?, ?)");
        $stmt->bind_param("ss", $school_name, $website_link);
        return $stmt->execute();
    }
}

$setup = new Setup();
$setup->createTables();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_name = $_POST['school_name'];
    $website_link = $_POST['website_link'];
    $setup->saveSettings($school_name, $website_link);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Setup Certificate System</title></head>
<body>
    <h2>Setup Your Certificate System</h2>
    <form method="post">
        <label>School Name:</label><br>
        <input type="text" name="school_name" required><br><br>
        <label>Website Link:</label><br>
        <input type="text" name="website_link" required><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
