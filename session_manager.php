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
$role_name = $_SESSION['role_name'];
$date    = $_SESSION['date'];

function checkRoleAccess($allowed_roles = []) 
{
    global $role_name;
    
    // Debug 1: Tampilkan role yang sedang diproses
    error_log("=== ROLE CHECK START ===");
    error_log("User Role: " . $role_name);
    error_log("Allowed Roles: " . print_r($allowed_roles, true));
    
    // Bersihkan array dari elemen kosong dan whitespace
    $cleaned_allowed_roles = array_map('trim', $allowed_roles);
    $cleaned_allowed_roles = array_filter($cleaned_allowed_roles, function($value) {
        return $value !== '';
    });
    
    error_log("Cleaned Allowed Roles: " . print_r($cleaned_allowed_roles, true));
    
    // Jika array kosong setelah dibersihkan, berikan akses
    if (empty($cleaned_allowed_roles)) {
        error_log("No roles specified, access granted");
        return true;
    }
    
    // Trim role name pengguna juga
    $user_role = trim($role_name);
    error_log("User Role (trimmed): " . $user_role);
    
    // Cek case-insensitive
    $user_role_lower = strtolower($user_role);
    $allowed_roles_lower = array_map('strtolower', $cleaned_allowed_roles);
    
    error_log("User Role (lower): " . $user_role_lower);
    error_log("Allowed Roles (lower): " . print_r($allowed_roles_lower, true));
    
    if (!in_array($user_role_lower, $allowed_roles_lower)) {
        error_log("ACCESS DENIED for role: " . $user_role);
        error_log("=== ROLE CHECK END (DENIED) ===");
        
        // Tampilkan SweetAlert dan STOP eksekusi
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Akses ditolak',
                        text: 'Anda tidak dapat mengakses halaman ini!!!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.history.back();
                        }
                    });
                });
            </script>
            ";
        exit; // INI YANG PENTING! Hentikan eksekusi PHP
    }
    
    error_log("ACCESS GRANTED for role: " . $user_role);
    error_log("=== ROLE CHECK END (GRANTED) ===");
    return true;
}
