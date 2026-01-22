<?php
include('header.php');

/**
 * =========================
 * PARAM FROM SESSION
 * =========================
 */
$params = [];

if (!empty($_SESSION['date'])) {
    $params['date'] = $_SESSION['date'];
}
?>

<script>
const DASHBOARD_PARAMS = <?= json_encode($params, JSON_UNESCAPED_SLASHES) ?>;
const queryString = new URLSearchParams(DASHBOARD_PARAMS).toString();
</script>

<div class="container content-container">
    <br><br>

    <!-- =========================
         HPB CARDS (RENDER FIRST)
         ========================= -->
    <div class="row" id="hpb-container">
        <?php foreach (['Pagi','Siang','Malam'] as $s): ?>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <strong><?= strtoupper($s) ?></strong>
                </div>
                <div class="card-body text-center text-muted">
                    Memproses data...
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- =========================
         CHART SECTION (READY CANVAS)
         ========================= -->
    <div class="row mt-3">
        <?php
        $charts = [
            'rendemen' => 'Rata-rata Rendemen NPP / Jam',
            'pol'      => 'Pol Ampas',
            'hk'       => 'HK Tetes',
            'iu-gkp'   => 'IU GKP'
        ];
        foreach ($charts as $id => $title):
        ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"><strong><?= $title ?></strong></div>
                <div class="card-body text-center text-muted">
                    <!-- <small>Memproses data chart...</small> -->
                    <canvas id="chart-<?= $id ?>"></canvas>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/**
 * =========================
 * HELPERS
 * =========================
 */
function buildChart(rows) {
    if (!rows?.length) return { labels: [], values: [], min: 0, max: 0 };

    const labels = [];
    const values = [];

    rows.forEach(r => {
        if (!r.created_at || r.value === null) return;
        labels.push(r.created_at.substr(11,5));
        values.push(+r.value);
    });

    return {
        labels,
        values,
        min: Math.min(...values),
        max: Math.max(...values)
    };
}

function renderLineChart(id, data, pad = 1) {
    if (!data.labels.length) return;

    new Chart(document.getElementById(id), {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { min: data.min - pad, max: data.max + pad }
            }
        }
    });
}

/**
 * =========================
 * FETCH HPB
 * =========================
 */
fetch('hpb_engine.php?' + queryString)
    .then(r => r.json())
    .then(data => {
        const c = document.getElementById('hpb-container');
        c.innerHTML = '';

        Object.entries(data).forEach(([shift,row]) => {
            c.innerHTML += `
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header ${shift==='total'?'bg-dark':'bg-primary'} text-white">
                        <strong>${shift.toUpperCase()}</strong>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-sm mb-0">
                            <tr><td>Tebu</td><td class="text-end">${(+row.tebu).toFixed(2)}</td></tr>
                            <tr><td>Nira Mentah</td><td class="text-end">${row.flow_nm}</td></tr>
                            <tr><td>Imbibisi</td><td class="text-end">${row.flow_imb}</td></tr>
                            <tr class="fw-bold text-success">
                                <td>HPB</td><td class="text-end">${(+row.hpb1).toFixed(2)}%</td>
                            </tr>
                            <tr class="fw-bold text-success">
                                <td>HPB Total</td><td class="text-end">${(+row.hpb_total).toFixed(2)}%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>`;
        });
    });

/**
 * =========================
 * FETCH DASHBOARD CHART
 * =========================
 */
fetch('dashboard_engine.php?' + queryString)
    .then(r => r.json())
    .then(d => {
        renderLineChart('chart-rendemen', buildChart(d.rendemen_npp), 1);
        renderLineChart('chart-pol', buildChart(d.pol_ampas), 1);
        renderLineChart('chart-hk', buildChart(d.hk_tetes), 2);
        renderLineChart('chart-iu-gkp', buildChart(d.iu_gkp), 5);
    });
</script>

<?php include('footer.php'); ?>
