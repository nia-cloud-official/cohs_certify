<?php
class DB {
    public $conn;
    public function __construct() {
        $this->conn = new mysqli("db.fr-pari1.bengt.wasmernet.com", "8a4c26ee7568800066a23ffffc8a", "06928a4c-26ee-7713-8000-25ea39caf2bf", "cohs_certificates", 10272);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>
