<?php
session_start();
require_once 'db.php';

// ambil user_id sebelum session dihancurkan
$user_id = $_SESSION['user_id'] ?? null;

/**
 * =========================
 * RESET DEVICE TOKEN
 * =========================
 */
if ($user_id) {
    $stmt = $conn->prepare("
        UPDATE users
        SET device_token = NULL
        WHERE id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

/**
 * =========================
 * CLEAR SESSION
 * =========================
 */
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

/**
 * =========================
 * REDIRECT
 * =========================
 */
header("Location: login.php?success=Anda berhasil logout");
exit;