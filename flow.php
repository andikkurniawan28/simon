<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/**
 * =========================
 * AUTH & HEADER
 * =========================
 */
include('header.php');

/**
 * =========================
 * VALIDASI SESSION DATE
 * =========================
 */
if (empty($_SESSION['date_start']) || empty($_SESSION['date_end'])) {
    $_SESSION['flash'] = [
        'type'    => 'warning',
        'title'   => 'Session Berakhir',
        'message' => 'Silakan login ulang'
    ];
    header('Location: login.php');
    exit;
}

$date_start = $_SESSION['date_start'] . ' 00:00:00';
$date_end   = $_SESSION['date_end']   . ' 23:59:59';

/**
 * =========================
 * AMBIL DATA BALANCES + IMBIBITIONS
 * =========================
 * LEFT JOIN berdasarkan created_at (jam & tanggal)
 */
$sql = "
    SELECT 
        b.*,
        i.flow_imb
    FROM balances b
    LEFT JOIN imbibitions i 
        ON DATE_FORMAT(b.created_at, '%Y-%m-%d %H:%i') 
         = DATE_FORMAT(i.created_at, '%Y-%m-%d %H:%i')
    WHERE b.created_at BETWEEN ? AND ?
    ORDER BY b.created_at ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $date_start, $date_end);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container content-container">
    <br><br>

    <div class="card">
        <div class="card-header">
            <strong>Tebu Tergiling dan Flow dalam Proses</strong>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Tebu</th>
                        <th>NMP</th>
                        <th>NM%TEBU</th>
                        <th>IMB</th>
                        <th>IMB%TEBU</th>
                        <th>NMG</th>
                        <th>D1</th>
                        <th>D2</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($result->num_rows === 0): ?>
                        <tr>
                            <td colspan="3" class="text-muted">
                                Tidak ada data
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php
                                        $start = strtotime($row['created_at']);
                                        $end   = strtotime('+1 hour', $start);

                                        echo date('H', $start) . ' - ' . date('H', $end);
                                    ?>
                                </td>
                                <td>
                                    <?= $row['tebu'] !== null
                                        ? number_format($row['tebu'], 2)
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= $row['flow_nm'] !== null
                                        ? number_format($row['flow_nm'])
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= $row['nm_persen_tebu'] !== null
                                        ? number_format($row['nm_persen_tebu'], 2)
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= $row['flow_imb'] !== null
                                        ? number_format($row['flow_imb'])
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= $row['flow_imb'] !== null
                                        ? number_format($row['flow_imb'] / $row['tebu'] * 1000, 2)
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= $row['flow_nm_gilingan'] !== null
                                        ? number_format($row['flow_nm_gilingan'])
                                        : '-' ?>
                                <td>
                                    <?= $row['flow_decanter_1st'] !== null
                                        ? number_format($row['flow_decanter_1st'])
                                        : '-' ?>
                                </td>
                                <td>
                                    <?= $row['flow_decanter_2nd'] !== null
                                        ? number_format($row['flow_decanter_2nd'])
                                        : '-' ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
