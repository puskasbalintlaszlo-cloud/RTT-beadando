<?php
$mysqli = new mysqli("db", "root", "root", "wp2_lev");
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(["error" => "Adatbázis kapcsolat sikertelen"]);
    exit;
}
$mysqli->set_charset("utf8");
?>
