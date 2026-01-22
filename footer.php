<br><br>

<!-- Floating button untuk membuka modal -->
<button type="button" class="btn btn-info text-dark floating-button" data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    <i class="fas fa-calendar-alt"></i>
    <?php
    $hari_global = date('l', strtotime($_SESSION['date']));
    switch ($hari_global) {
        case 'Monday':
            $hari_lokal = 'Senin';
            break;
        case 'Tuesday':
            $hari_lokal = 'Selasa';
            break;
        case 'Wednesday':
            $hari_lokal = 'Rabu';
            break;
        case 'Thursday':
            $hari_lokal = 'Kamis';
            break;
        case 'Friday':
            $hari_lokal = "Jum'at";
            break;
        case 'Saturday':
            $hari_lokal = 'Sabtu';
            break;
        case 'Sunday':
            $hari_lokal = 'Minggu';
            break;
    }

    $bulan_global = date('F', strtotime($_SESSION['date']));
    switch ($bulan_global) {
        case 'January':
            $bulan_lokal = 'Januari';
            break;
        case 'February':
            $bulan_lokal = 'Februari';
            break;
        case 'March':
            $bulan_lokal = 'Maret';
            break;
        case 'April':
            $bulan_lokal = 'April';
            break;
        case 'May':
            $bulan_lokal = 'Mei';
            break;
        case 'June':
            $bulan_lokal = 'Juni';
            break;
        case 'July':
            $bulan_lokal = 'Juli';
            break;
        case 'August':
            $bulan_lokal = 'Agustus';
            break;
        case 'September':
            $bulan_lokal = 'September';
            break;
        case 'October':
            $bulan_lokal = 'Oktober';
            break;
        case 'November':
            $bulan_lokal = 'November';
            break;
        case 'December':
            $bulan_lokal = 'Desember';
            break;
        default:
            $bulan_lokal = $bulan_global;
            break;
    }

    $tanggal = date('d', strtotime($_SESSION['date']));
    $tahun = date('Y', strtotime($_SESSION['date']));

    $formatted_date = "{$hari_lokal}, {$tanggal} {$bulan_lokal} {$tahun}";
    ?>
    <?= $formatted_date ?>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan data -->
                <form id="changeDateForm" action="change_date.php" method="POST">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="<?= $_SESSION['date'] ?>"
                            id="date" onchange="submitForm()">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById("changeDateForm").submit();
    }
</script>

<style>
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #17a2b8;
        /* Warna latar belakang footer */
        padding: 10px 0;
        /* Padding atas dan bawah footer */
        text-align: center;
        /* Teks tengah pada footer */
        z-index: 100;
        /* Pastikan footer berada di atas konten */
    }
</style>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>