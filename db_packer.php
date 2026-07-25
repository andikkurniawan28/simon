<?php

mysqli_report(MYSQLI_REPORT_OFF);

$username = "andik";
$password = "andik";
$database = "qc";

$hosts = [
    "192.168.20.234",
    "192.168.28.60"
];

$conn2 = false;

foreach ($hosts as $host) {

    $mysqli = mysqli_init();
    mysqli_options($mysqli, MYSQLI_OPT_CONNECT_TIMEOUT, 2); // timeout 2 detik

    if (@mysqli_real_connect($mysqli, $host, $username, $password, $database)) {
        $conn2 = $mysqli;
        break;
    }
}

if (!$conn2) {
    die("Semua server database tidak dapat dihubungi.");
}