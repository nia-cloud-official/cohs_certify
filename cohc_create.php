<?php
require_once "db.php";
require_once "qrlib.php"; 
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['student_name'];
    $ecd_level = $_POST['ecd_level'];
    $issued_date = $_POST['issued_date'];
    $certificate_id = "ECD-" . strtoupper(substr($student_name,0,3)) . time();

    $stmt = $db->conn->prepare("INSERT INTO ecd_certificates (student_name, ecd_level, issued_date, certificate_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_name, $ecd_level, $issued_date, $certificate_id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>ECD Certificate recorded successfully!</p>";
        $verifyUrl = "https://certification-cohs.wasmer.app/cohc_verify.php?cid=" . urlencode($certificate_id);
        echo "<p><a href='download_qr.php?cid=" . urlencode($certificate_id) . "' target='_blank'>Download QR Code</a></p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Record ECD Certificate</title></head>
<body>
<center>
<form method="post" class="form">
    <p class="title">Record New ECD Certificate</p>
    <label>
        <input type="text" class="input" name="student_name" required>
        <span>Student Name</span>
    </label>
    <label>
        <select class="input" name="ecd_level" required>
            <option value="">Select Level</option>
            <option value="A">ECD A</option>
            <option value="B">ECD B</option>
        </select>
        <span>ECD Level</span>
    </label>
    <label>
        <input type="date" class="input" name="issued_date" required>
        <span>Issued Date</span>
    </label>
    <button class="submit" type="submit">Save</button>
</form>
</center>
</body>
</html>
