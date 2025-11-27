<?php
class DB {
    public $conn;
    public function __construct() {
        $this->conn = new mysqli("db.fr-pari1.bengt.wasmernet.com", "4d1865b27acb80002a176ec726a9", "06924d18-65b2-7f68-8000-50477f7705d5", "ith_certificates", 10272);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>
