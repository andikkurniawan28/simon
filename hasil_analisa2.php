<?php
$station_id = intval($_GET['id'] ?? 0);
$search = isset($_GET['search']) ? trim($_GET['search']) : ''; // Tambahkan parameter search
include('session_manager.php');

// Definisikan allowed berdasarkan station_id
$allowed = [];

switch ($station_id) {
    // Raw Sugar
    case 1: 
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
    
    // Gilingan
    case 2:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
    
    // Pemurnian
    case 3:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
    
    // Penguapan
    case 4:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
        
    // DRK
    case 5:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
    
    // Masakan
    case 6:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
        
    // Stroop
    case 7:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
    
    // Gula
    case 8:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
      
    // Tangki Tetes
    case 9:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
        
    // Ketel
    case 10:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
    
    // Packer
    case 11:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
        
    // Request
    case 12:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;
       
    // Sogokan
    case 16:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            // 'Direksi',
            // 'Tamu',
            'Pemimpin',
        ];
        break;
}

// Cek role access dengan allowed yang sudah di-switch
checkRoleAccess($allowed);

include('header.php');

if ($station_id <= 0) {
    die('Station tidak valid');
}

/**
 * =========================
 * STATION
 * =========================
 */
$station = $conn->query("
    SELECT name 
    FROM stations 
    WHERE id = $station_id
")->fetch_assoc();

/**
 * =========================
 * MATERIALS dengan fitur pencarian
 * =========================
 */
$materialsQuery = "
    SELECT id, name
    FROM materials
    WHERE station_id = $station_id
";

if (!empty($search)) {
    $searchEscaped = $conn->real_escape_string($search);
    $materialsQuery .= " AND name LIKE '%$searchEscaped%'";
}

$materialsQuery .= " ORDER BY id ASC";

$materialsQ = $conn->query($materialsQuery);
?>

<div class="container content-container">
    <br><br>
    
    <!-- Header dengan judul station dan form pencarian -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h4>Data Analisa: <?= htmlspecialchars($station['name']) ?></h4>
        </div>
        <div class="col-md-6">
            <form method="GET" action="" id="searchForm">
                <input type="hidden" name="id" value="<?= $station_id ?>">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Ketik untuk mencari material..." 
                        value="<?= htmlspecialchars($search) ?>"
                        autocomplete="off"
                        id="searchInput"
                    >
                    <?php if (!empty($search)): ?>
                        <a href="?id=<?= $station_id ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Info hasil pencarian -->
    <?php if (!empty($search)): ?>
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-info py-2">
                    <i class="fas fa-info-circle"></i> 
                    Menampilkan <strong><?= $materialsQ->num_rows ?></strong> material untuk pencarian "<strong><?= htmlspecialchars($search) ?></strong>"
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Pesan jika tidak ada material -->
    <?php if ($materialsQ->num_rows == 0): ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php if (!empty($search)): ?>
                        Tidak ada material dengan nama "<strong><?= htmlspecialchars($search) ?></strong>" ditemukan.
                    <?php else: ?>
                        Tidak ada material untuk station ini.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">

        <?php while ($material = $materialsQ->fetch_assoc()): ?>

            <?php
            /**
             * =========================
             * METHODS (PIVOT → INDICATORS)
             * =========================
             */
            $methodsQ = $conn->prepare("
                SELECT 
                    i.name AS indicator_name
                FROM methods m
                JOIN indicators i ON i.id = m.indicator_id
                WHERE m.material_id = ?
                ORDER BY m.id ASC
            ");
            $methodsQ->bind_param("i", $material['id']);
            $methodsQ->execute();
            $methods = $methodsQ->get_result()->fetch_all(MYSQLI_ASSOC);

            if (empty($methods)) {
                continue;
            }

            /**
             * =========================
             * ANALISA DATA
             * =========================
             */
            $year = (int) date('Y', strtotime($_SESSION['date']));

            if ($year >= 2026)
            {    
                $dataQ = $conn->prepare("
                    SELECT *
                    FROM analisa_off_farm_new
                    WHERE material_id = ?
                    AND created_at BETWEEN ? AND ?
                    ORDER BY id DESC
                ");
            } 
            else 
            {
                $dataQ = $conn->prepare("
                    SELECT 
                        af.*
                    FROM analisa_off_farms af
                    JOIN samples s ON s.id = af.sample_id
                    WHERE s.material_id = ?
                    AND s.created_at BETWEEN ? AND ?
                    ORDER BY af.id DESC
                ");
            }

            $dataQ->bind_param(
                "iss",
                $material['id'],
                $_SESSION['date_start'],
                $_SESSION['date_end']
            );
            $dataQ->execute();
            $data = $dataQ->get_result();

            /**
             * =========================
             * PREPARE STAT
             * =========================
             */
            $stats = [];

            foreach ($methods as $m) {
                $col = str_replace(' ', '_', $m['indicator_name']);
                $stats[$col] = [];
            }

            while ($row = $data->fetch_assoc()) {
                foreach ($stats as $col => $arr) {
                    if (isset($row[$col]) && $row[$col] !== null) {
                        $stats[$col][] = $row[$col];
                    }
                }
            }
            $data->data_seek(0);
            ?>

            <div class="col-md-<?php if(count($methods) >= 8) echo "12"; else echo "6"; ?>">
                <div class="card mb-4">
                    
                    <!-- Highlight jika material sesuai pencarian -->
                    <div class="card-header text-left <?= (!empty($search) && stripos($material['name'], $search) !== false) ? 'bg-warning' : '' ?>">
                        <strong><?= strtoupper($material['name']) ?></strong>
                        <?php if (!empty($search) && stripos($material['name'], $search) !== false): ?>
                            <span class="badge bg-dark ms-2">Hasil pencarian</span>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-sm">

                                <thead>
                                    <tr>
                                        <th>Jam</th>
                                        <?php foreach ($methods as $m): ?>
                                            <th><?= $m['indicator_name'] ?></th>
                                        <?php endforeach; ?>
                                    </tr>

                                    <!-- AVG -->
                                    <tr style="background:#ffc107">
                                        <th>Avg</th>
                                        <?php foreach ($methods as $m):
                                            $col = str_replace(' ', '_', $m['indicator_name']);
                                            $avg = !empty($stats[$col])
                                                ? array_sum($stats[$col]) / count($stats[$col])
                                                : null;
                                        ?>
                                            <th>
                                                <?= $avg !== null
                                                    ? in_array($col, ['IU', 'CaO'])
                                                    ? number_format($avg)
                                                    : number_format($avg, 2)
                                                    : ''
                                                ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>

                                    <!-- MIN -->
                                    <tr style="background:#28a745;color:#fff">
                                        <th>Min</th>
                                        <?php foreach ($methods as $m):
                                            $col = str_replace(' ', '_', $m['indicator_name']);
                                            $min = !empty($stats[$col]) ? min($stats[$col]) : null;
                                        ?>
                                            <th>
                                                <?= $min !== null
                                                    ? in_array($col, ['IU', 'CaO'])
                                                    ? number_format($min)
                                                    : number_format($min, 2)
                                                    : ''
                                                ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>

                                    <!-- MAX -->
                                    <tr style="background:#dc3545;color:#fff">
                                        <th>Max</th>
                                        <?php foreach ($methods as $m):
                                            $col = str_replace(' ', '_', $m['indicator_name']);
                                            $max = !empty($stats[$col]) ? max($stats[$col]) : null;
                                        ?>
                                            <th>
                                                <?= $max !== null
                                                    ? in_array($col, ['IU', 'CaO'])
                                                    ? number_format($max)
                                                    : number_format($max, 2)
                                                    : ''
                                                ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php while ($row = $data->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= date('H:i', strtotime($row['created_at'])) ?></td>

                                            <?php foreach ($methods as $m):
                                                $col = str_replace(' ', '_', $m['indicator_name']);
                                                $v = $row[$col] ?? null;
                                            ?>
                                                <td>
                                                    <?= $v !== null
                                                        ? in_array($col, ['IU', 'CaO'])
                                                        ? number_format($v)
                                                        : number_format($v, 2)
                                                        : ''
                                                    ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

    </div>
</div>

<!-- JavaScript untuk pencarian langsung (live search) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    const stationId = '<?= $station_id ?>';
    
    if (searchInput) {
        // Variable untuk debounce
        let timeout = null;
        
        // Fungsi untuk submit form
        function submitSearch() {
            searchForm.submit();
        }
        
        // Event listener untuk setiap kali user mengetik
        searchInput.addEventListener('input', function() {
            // Clear timeout sebelumnya
            clearTimeout(timeout);
            
            // Set timeout baru (300ms delay setelah berhenti mengetik)
            timeout = setTimeout(submitSearch, 300);
        });
        
        // Mencegah form submit normal ketika enter
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitSearch();
        });
        
        // Hapus timeout jika input dikosongkan dengan cepat
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchInput.value = '';
                timeout = setTimeout(submitSearch, 50);
            }
        });
    }
});
</script>

<!-- CSS tambahan untuk live search -->
<style>
/* Animasi loading untuk indikator pencarian */
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.search-loading .input-group-text i {
    animation: pulse 1s infinite;
}

/* Style untuk input pencarian */
#searchInput {
    border-left: none;
    padding-left: 0;
}

.input-group-text {
    border-right: none;
    background-color: white;
}

/* Hover effect untuk tombol reset */
.btn-outline-secondary:hover {
    background-color: #f8f9fa;
}
</style>

<?php include('footer.php'); ?>