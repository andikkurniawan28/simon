<?php
session_start();

/**
 * =========================
 * CEK LOGIN
 * =========================
 */
if (empty($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/**
 * =========================
 * VALIDASI INPUT
 * =========================
 */
if (empty($_POST['date'])) {
    $back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header("Location: $back");
    exit;
}

date_default_timezone_set('Asia/Jakarta');

$inputDate = $_POST['date']; // format: YYYY-MM-DD

/**
 * =========================
 * HITUNG JAM PABRIK
 * 06:00 - 05:59
 * =========================
 */
$baseDate = new DateTime($inputDate);

$dateStart = (clone $baseDate)->setTime(6, 0, 0);
$dateEnd   = (clone $baseDate)->modify('+1 day')->setTime(5, 59, 59);
$dateStartRetail = (clone $baseDate)->setTime(7, 0, 0);
$dateEndRetail = (clone $baseDate)->modify('+1 day')->setTime(6, 59, 59);

/**
 * =========================
 * SIMPAN KE SESSION
 * =========================
 */
$_SESSION['date']       = $baseDate->format('Y-m-d');
$_SESSION['date_start'] = $dateStart->format('Y-m-d H:i:s');
$_SESSION['date_end']   = $dateEnd->format('Y-m-d H:i:s');
$_SESSION['date_start_retail']   = $dateStartRetail->format('Y-m-d H:i:s');
$_SESSION['date_end_retail']   = $dateEndRetail->format('Y-m-d H:i:s');

/**
 * =========================
 * REDIRECT KEMBALI
 * =========================
 */
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
