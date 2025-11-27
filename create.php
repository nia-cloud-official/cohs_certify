<?php
require_once "db.php";
require_once "qrlib.php"; 
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['student_name'];
    $course_name = $_POST['course_name'];
    $certificate_id = $_POST['certificate_id'];
    $issued_date = $_POST['issued_date'];

    // Save certificate record
    $stmt = $db->conn->prepare("INSERT INTO certificates (student_name, course_name, certificate_id, issued_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_name, $course_name, $certificate_id, $issued_date);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Certificate recorded successfully!</p>";

        // Generate QR code directly for download
        $verifyUrl = "https://certification-ith.wasmer.app/verify.php?cid=" . urlencode($certificate_id);

        echo "<p><a href='download_qr.php?cid=" . urlencode($certificate_id) . "' target='_blank'>Download QR Code</a></p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Record Certificate</title></head>
<body>
    <style>
        body { 
            background-color: #2c2c2c;
        }
        .form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 350px;
  background-color:#2c2c2c;
  padding: 20px;
  border-radius: 20px;
  position: relative;
}

.title {
  font-size: 28px;
  color: white;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: white;
}

.title::before {
  width: 18px;
  height: 18px;
  background-color: white;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.message, .signin {
  color: rgba(88, 87, 87, 0.822);
  font-size: 14px;
}

.signin {
  text-align: center;
}

.signin a {
  color: royalblue;
}

.signin a:hover {
  text-decoration: underline royalblue;
}

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form label .input {
  width: 100%;
  padding: 10px 10px 20px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .input + span {
  position: absolute;
  left: 10px;
  top: 15px;
  color: grey;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .input:placeholder-shown + span {
  top: 15px;
  font-size: 0.9em;
}

.form label .input:focus + span,.form label .input:valid + span {
  top: 30px;
  font-size: 0.7em;
  font-weight: 600;
}

.form label .input:valid + span {
  color: green;
}

.submit {
  border: none;
  outline: none;
  background-color: black;
  padding: 10px;
  border-radius: 10px;
  color: #ffffffff;
  font-size: 16px;
  transform: .3s ease;
}

.submit:hover {
  background-color: rgba(255, 255, 255, 1);
  color:black;
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}
    </style>
    <center>
            <div class="container">
    <form method="post" class="form">
        <p class="title">Record New Certificate</p>
        <label>
            <input type="text" class="input" name="student_name" required>
            <span>Student Name</span>
        </label>
        
        <label>
            <input type="text" class="input" name="course_name" required>
            <span>Course Name</span>
        </label>
        <label>
            <input type="text" class="input" name="certificate_id" required>
            <span>Certificate ID</span>
        </label>
        <label>
            <input type="date" class="input" name="issued_date" required>
            <span>Issued Date</span>
        </label>
        <button class="submit" type="submit">Save</button>
    </form>
    <a href="./index.php"><button class="submit" type="submit">Back Home</button></a>
    </div>
    </center>


</body>
</html>
