<?php
require_once "qrlib.php";

if (isset($_GET['cid'])) {
    $certificate_id = $_GET['cid'];
    $verifyUrl = "https://certification-cohs.wasmer.app/verify.php?cid=" . urlencode($certificate_id);

    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="qr_' . $certificate_id . '.png"');
    QRcode::png($verifyUrl, false, QR_ECLEVEL_L, 4); // direct output, no file storage
    exit;
} else {
    echo "No certificate ID provided.";
}
?>
