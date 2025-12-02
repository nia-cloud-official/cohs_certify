<?php
require_once "qrlib.php";

$cid = $_GET['cid'];

// Always point to the ECD verification page
$verifyUrl = "https://certification-cohs.wasmer.app/cohc_verify.php?cid=" . urlencode($cid);

// Directly output QR image (no storage)
header('Content-Type: image/png');
QRcode::png($verifyUrl);
?>
