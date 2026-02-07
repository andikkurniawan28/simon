<?php
session_start();
require_once 'db.php';

/**
 * =========================
 * AMBIL INPUT
 * =========================
 */
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'title' => 'Login Gagal',
        'message' => 'Username dan password wajib diisi'
    ];
    header("Location: login.php");
    exit;
}

/**
 * =========================
 * 1. AMBIL USER AKTIF
 * =========================
 */
$stmt = $conn->prepare("
    SELECT id, username, password, name, role_id
    FROM users
    WHERE username = ?
      AND is_active = 1
    LIMIT 1
");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'title' => 'Login Gagal',
        'message' => 'Username / password salah'
    ];
    header("Location: login.php");
    exit;
}

$user = $result->fetch_assoc();

/**
 * =========================
 * 2. CEK PASSWORD (bcrypt)
 * =========================
 */
if (!password_verify($password, $user['password'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'title' => 'Login Gagal',
        'message' => 'Username / password salah'
    ];
    header("Location: login.php");
    exit;
}

/**
 * =========================
 * 3. LOGIN SUKSES
 * =========================
 */
session_regenerate_id(true);

$_SESSION['login']    = true;
$_SESSION['user_id']  = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['name']     = $user['name'];
$_SESSION['role_id']  = $user['role_id'];

/**
 * =========================
 * 3A. HITUNG FACTORY DATE
 * Jam pabrik: 06:00 - 05:59
 * =========================
 */
date_default_timezone_set('Asia/Jakarta');

$now = new DateTime();

$todaySixAM = (new DateTime())->setTime(6, 0, 0);

if ($now < $todaySixAM) {
    // Masih masuk hari kerja kemarin
    $factoryDate = (new DateTime('yesterday'))->format('Y-m-d');
    $factoryStart = (new DateTime('yesterday'))->setTime(6, 0, 0);
    $factoryEnd   = (new DateTime())->setTime(5, 59, 59);
    $factoryStartRetail = (new DateTime('yesterday'))->setTime(7, 0, 0);
    $factoryEndRetail   = (new DateTime())->setTime(6, 59, 59);
} else {
    // Hari kerja hari ini
    $factoryDate = (new DateTime())->format('Y-m-d');
    $factoryStart = (new DateTime())->setTime(6, 0, 0);
    $factoryEnd   = (new DateTime('tomorrow'))->setTime(5, 59, 59);
    $factoryStartRetail = (new DateTime())->setTime(7, 0, 0);
    $factoryEndRetail   = (new DateTime('tomorrow'))->setTime(6, 59, 59);
}

/**
 * =========================
 * SIMPAN KE SESSION
 * =========================
 */
$_SESSION['date']  = $factoryDate;
$_SESSION['date_start'] = $factoryStart->format('Y-m-d H:i:s');
$_SESSION['date_end']   = $factoryEnd->format('Y-m-d H:i:s');
$_SESSION['date_start_retail']   = $factoryStartRetail->format('Y-m-d H:i:s');
$_SESSION['date_end_retail']   = $factoryEndRetail->format('Y-m-d H:i:s');


/**
 * =========================
 * 4. REDIRECT INTENDED
 * =========================
 */
$redirect = 'index.php';
unset($_SESSION['intended_url']);

header("Location: $redirect");
exit;
