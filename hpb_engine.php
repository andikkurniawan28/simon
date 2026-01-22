<?php
/**
 * =====================================================
 * HPB ENGINE (STATELESS JSON API)
 * =====================================================
 * INPUT  : date, date_start, date_end (GET / POST)
 * OUTPUT : JSON
 * =====================================================
 */

header('Content-Type: application/json; charset=utf-8');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require 'db.php';

/* ============================================
   VALIDASI INPUT
============================================ */
if (
    empty($_GET['date'])
) {
    return [];
}


/* ============================================
   DEFINISI SHIFT
============================================ */
$date = $_GET['date'];
$shifts = [
    'pagi' => ['start' => $date . ' 05:00:00'],
    'siang'=> ['start' => $date . ' 13:00:00'],
    'malam'=> ['start' => $date . ' 21:00:00'],
];

foreach ($shifts as $k => $s) {
    $start = new DateTime($s['start']);
    $end   = (clone $start)->modify('+8 hours');
    $shifts[$k]['end'] = $end->format('Y-m-d H:i:s');
}

/* ============================================
   LOOP SHIFT
============================================ */
$hasil = [];

foreach ($shifts as $shift => $r) {

    /* BALANCES */
    $stmt = $conn->prepare("
        SELECT 
            SUM(tebu)/10 AS tebu,
            SUM(flow_nm) AS flow_nm
        FROM balances
        WHERE created_at BETWEEN ? AND ?
    ");
    $stmt->bind_param('ss', $r['start'], $r['end']);
    $stmt->execute();
    $bal = $stmt->get_result()->fetch_assoc();

    $tebu    = (float) ($bal['tebu'] ?? 0);
    $flow_nm = (float) ($bal['flow_nm'] ?? 0);

    /* IMBIBISI */
    $stmt = $conn->prepare("
        SELECT SUM(flow_imb) AS imb
        FROM imbibitions
        WHERE created_at BETWEEN ? AND ?
    ");
    $stmt->bind_param('ss', $r['start'], $r['end']);
    $stmt->execute();
    $imb = $stmt->get_result()->fetch_assoc();
    $flow_imb = (float) ($imb['imb'] ?? 0);

    /* ANALISA (OLD SCHEMA) */
    $stmt = $conn->prepare("
        SELECT
            s.material_id,
            AVG(a.`%Brix`) AS brix,
            AVG(a.`HK`) AS hk,
            AVG(a.`Pol_Ampas`) AS pol_ampas
        FROM samples s
        JOIN analisa_off_farms a ON a.sample_id = s.id
        WHERE s.material_id IN (3,4,7,14,400)
          AND a.is_verified = 1
          AND s.created_at BETWEEN ? AND ?
        GROUP BY s.material_id
    ");
    $stmt->bind_param('ss', $r['start'], $r['end']);
    $stmt->execute();

    $analisa = [];
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $analisa[$row['material_id']] = $row;
    }

    /* EKSTRAK */
    $brix_npp  = (float)($analisa[3]['brix'] ?? 0);
    $brix_ng2  = (float)($analisa[4]['brix'] ?? 0);
    $brix_ng5  = (float)($analisa[7]['brix'] ?? 0);
    $hk_ng5    = (float)($analisa[7]['hk'] ?? 0);
    $pol_ampas = (float)($analisa[400]['pol_ampas'] ?? 0);
    $brix_nm   = (float)($analisa[14]['brix'] ?? 0);

    /* PERHITUNGAN */
    $ton_ampas = $tebu + $flow_imb - $flow_nm;
    $brix_ampas = ($hk_ng5 > 0) ? ($pol_ampas / $hk_ng5) * 100 : 0;

    $ton_brix_ampas = $brix_ampas * $ton_ampas / 100;
    $ton_brix_nm    = $brix_nm * $flow_nm / 100;
    $ton_brix_tebu  = $ton_brix_nm + $ton_brix_ampas;

    $brix_tebu = ($tebu > 0) ? ($ton_brix_tebu / $tebu) * 100 : 0;
    $knt       = ($brix_npp > 0) ? ($brix_tebu / $brix_npp) : 0;

    $ton_npp = (($brix_npp - $brix_ng2) != 0)
        ? (($brix_nm - $brix_ng2) / ($brix_npp - $brix_ng2)) * $flow_nm
        : 0;

    $npp_pct = ($tebu > 0) ? ($ton_npp / $tebu) * 100 : 0;
    $hpb1    = ($knt > 0) ? ($npp_pct / $knt) : 0;
    $hpb_tot = ($hpb1 > 0 && $brix_npp > 0)
        ? 100 - (($brix_ng5 * $hpb1) / $brix_npp)
        : 0;

    $hasil[$shift] = [
        'tebu'       => $tebu,
        'flow_nm'    => $flow_nm,
        'flow_imb'   => $flow_imb,
        'hpb1'       => $hpb1,
        'hpb_total'  => $hpb_tot
    ];
}

// echo json_encode([
//     'status' => 'ok',
//     'data'   => $hasil
// ]);

echo json_encode($hasil, JSON_THROW_ON_ERROR);
