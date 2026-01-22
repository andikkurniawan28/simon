<?php
/**
 * SESSION & AUTH GUARD
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

/**
 * =========================
 * AUTH CHECK
 * =========================
 */
if (
    empty($_SESSION['user_id']) ||
    empty($_SESSION['role_id']) ||
    empty($_SESSION['date'])
) {

    $_SESSION['flash'] = [
        'type'    => 'warning',
        'title'   => 'Session Berakhir',
        'message' => 'Silakan login ulang'
    ];

    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];
$date    = $_SESSION['date'];
