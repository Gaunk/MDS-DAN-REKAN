<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2 class="title-1">Laporan Keuangan (Mutasi)</h2>
                </div>

                <div class="col-md-6 text-end">
                    <button class="btn btn-primary" onclick="printMutasi()">
                        <i class="fa fa-print"></i> Print Mutasi
                    </button>
                </div>
            </div>

            <!-- FILTER TANGGAL -->
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <input type="date" name="mulai" value="<?= $mulai ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="date" name="selesai" value="<?= $selesai ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success">Filter</button>
                    <a href="<?= base_url('admin/laporankeuangan'); ?>" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari transaksi...">
                </div>
            </div>

            <!-- MUTASI TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="mutasiTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Uraian Transfer</th>
                            <th>Deskripsi</th>
                            <th class="text-end">Pemasukan</th>
                            <th class="text-end">Pengeluaran</th>
                            <th class="text-end">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mutasi as $m): ?>
                        <tr>
                            <!-- Tanggal -->
                            <td><?= date('d-m-Y', strtotime($m['tanggal'])) ?></td>

                            <!-- Uraian Transfer -->
                            <td><?= esc($m['nama_klien'] ?? '-') ?></td>

                            <!-- Deskripsi -->
                            <td><?= esc($m['deskripsi']) ?></td>

                            <!-- Pemasukan -->
                            <td class="text-end text-success">
                                <?= ($m['jenis'] === 'pemasukan') ? number_format($m['jumlah'], 2) : '-' ?>
                            </td>

                            <!-- Pengeluaran -->
                            <td class="text-end text-danger">
                                <?= ($m['jenis'] === 'pengeluaran') ? number_format($m['jumlah'], 2) : '-' ?>
                            </td>

                            <!-- Saldo Berjalan -->
                            <td class="text-end fw-bold">
                                <?= number_format($m['saldo'], 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="3">TOTAL</td>
                            <td class="text-end text-success"><?= number_format($total_pemasukan, 2) ?></td>
                            <td class="text-end text-danger"><?= number_format($total_pengeluaran, 2) ?></td>
                            <td class="text-end"><?= number_format($saldo_akhir, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
</div>


<!-- PRINT AREA HIDDEN -->
<div id="printArea" class="d-none">
    <h3 style="text-align:center;">MDS DAN REKAN</h3>
    <h4 style="text-align:center;">LAPORAN MUTASI KEUANGAN</h4>
    <hr>

    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; font-size:14px;">
        <thead>
            <tr style="background:#e5e5e5;">
                <th>Tanggal</th>
                <th>Uraian Trasnfer</th>
                <th>Deskripsi</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mutasi as $m): ?>
            <tr>
                <td><?= date('d-m-Y', strtotime($m['tanggal'])) ?></td>
                <td><?= esc($m['nama_klien']) ?></td>
                <td><?= esc($m['deskripsi']) ?></td>
                <td><?= ($m['jenis'] === 'pemasukan') ? number_format($m['jumlah'], 2) : '-' ?></td>
                <td><?= ($m['jenis'] === 'pengeluaran') ? number_format($m['jumlah'], 2) : '-' ?></td>
                <td><?= number_format($m['saldo'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- SEARCH SCRIPT -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#mutasiTable tbody tr');

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
    });
});
</script>

<!-- PRINT SCRIPT -->
<script>
function printMutasi() {
    let printContent = document.getElementById('printArea').innerHTML;
    let original = document.body.innerHTML;

    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = original;
}
</script>
