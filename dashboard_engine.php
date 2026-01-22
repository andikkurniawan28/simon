<?php
/**
 * =====================================================
 * DASHBOARD ENGINE
 * =====================================================
 * - Auto source switch by year
 * - Rendemen NPP: AVG per hour
 * - Output: array siap chart
 * =====================================================
 */
header('Content-Type: application/json; charset=utf-8');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require 'db.php';

/* =====================================================
   1. VALIDASI SESSION
===================================================== */
if (
    empty($_GET['date'])
) {
    return [];
}

$date  = $_GET['date'];
$start = date('Y-m-d 06:00:00', strtotime($date));
$end   = date('Y-m-d H:i:s', strtotime($start . ' +23 hours +59 minutes'));

$year = (int) date('Y', strtotime($date));

/* =====================================================
   2. CONTAINER OUTPUT
===================================================== */
$dashboard = [
    'rendemen_npp' => [],
    'pol_ampas'    => [],
    'hk_tetes'     => [],
    'iu_gkp'       => [],
];

/* =====================================================
   3. SOURCE SWITCH
===================================================== */
$useNewTable = $year >= 2026;

/* =====================================================
   4. RENDEMEN NPP (%R) – AVG PER JAM
===================================================== */
if ($useNewTable) {

    // === analisa_off_farm_new ===
    $stmt = $conn->prepare("
        SELECT
            DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') AS created_at,
            AVG(`%R`) AS value
        FROM analisa_off_farm_new
        WHERE material_id = 3
          AND is_verified = 1
          AND `%R` IS NOT NULL
          AND created_at BETWEEN ? AND ?
        GROUP BY DATE_FORMAT(created_at, '%Y-%m-%d %H')
        ORDER BY created_at ASC
    ");

} else {

    // === analisa_off_farms + samples ===
    $stmt = $conn->prepare("
        SELECT
            DATE_FORMAT(s.created_at, '%Y-%m-%d %H:00:00') AS created_at,
            AVG(a.`%R`) AS value
        FROM analisa_off_farms a
        JOIN samples s ON a.sample_id = s.id
        WHERE s.material_id = 3
          AND a.is_verified = 1
          AND a.`%R` IS NOT NULL
          AND s.created_at BETWEEN ? AND ?
        GROUP BY DATE_FORMAT(s.created_at, '%Y-%m-%d %H')
        ORDER BY created_at ASC
    ");
}

$stmt->bind_param('ss', $start, $end);
$stmt->execute();
$dashboard['rendemen_npp'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

/* =====================================================
   5. POL AMPAS – MATERIAL 12
===================================================== */
if ($useNewTable) {

    $stmt = $conn->prepare("
        SELECT
            created_at,
            Pol_Ampas AS value
        FROM analisa_off_farm_new
        WHERE material_id = 12
          AND is_verified = 1
          AND Pol_Ampas IS NOT NULL
          AND created_at BETWEEN ? AND ?
        ORDER BY created_at ASC
    ");

} else {

    $stmt = $conn->prepare("
        SELECT
            s.created_at,
            a.Pol_Ampas AS value
        FROM analisa_off_farms a
        JOIN samples s ON a.sample_id = s.id
        WHERE s.material_id = 12
          AND a.is_verified = 1
          AND a.Pol_Ampas IS NOT NULL
          AND s.created_at BETWEEN ? AND ?
        ORDER BY s.created_at ASC
    ");
}

$stmt->bind_param('ss', $start, $end);
$stmt->execute();
$dashboard['pol_ampas'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

/* =====================================================
   6. HK TETES – MATERIAL 64
===================================================== */
if ($useNewTable) {

    $stmt = $conn->prepare("
        SELECT
            created_at,
            HK AS value
        FROM analisa_off_farm_new
        WHERE material_id = 64
          AND is_verified = 1
          AND HK IS NOT NULL
          AND HK != 0
          AND created_at BETWEEN ? AND ?
        ORDER BY created_at ASC
    ");

} else {

    $stmt = $conn->prepare("
        SELECT
            s.created_at,
            a.HK AS value
        FROM analisa_off_farms a
        JOIN samples s ON a.sample_id = s.id
        WHERE s.material_id = 64
          AND a.is_verified = 1
          AND a.HK IS NOT NULL
          AND a.HK != 0
          AND s.created_at BETWEEN ? AND ?
        ORDER BY s.created_at ASC
    ");
}

$stmt->bind_param('ss', $start, $end);
$stmt->execute();
$dashboard['hk_tetes'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

/* =====================================================
   7. IU GKP – MATERIAL 67
===================================================== */
if ($useNewTable) {

    $stmt = $conn->prepare("
        SELECT
            created_at,
            IU AS value
        FROM analisa_off_farm_new
        WHERE material_id = 67
          AND is_verified = 1
          AND IU IS NOT NULL
          AND IU != 0
          AND created_at BETWEEN ? AND ?
        ORDER BY created_at ASC
    ");

} else {

    $stmt = $conn->prepare("
        SELECT
            s.created_at,
            a.IU AS value
        FROM analisa_off_farms a
        JOIN samples s ON a.sample_id = s.id
        WHERE s.material_id = 67
          AND a.is_verified = 1
          AND a.IU IS NOT NULL
          AND a.IU != 0
          AND s.created_at BETWEEN ? AND ?
        ORDER BY s.created_at ASC
    ");
}

$stmt->bind_param('ss', $start, $end);
$stmt->execute();
$dashboard['iu_gkp'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

/* =====================================================
   8. RETURN
===================================================== */
echo json_encode($dashboard, JSON_THROW_ON_ERROR);
exit;
