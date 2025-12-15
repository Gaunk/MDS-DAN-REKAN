<!-- CSS PRINT -->
<style>
@media print {
    /* Pastikan warna teks dan latar tetap */
    #printArea table th,
    #printArea table td {
        -webkit-print-color-adjust: exact !important; 
        print-color-adjust: exact !important;
    }

    /* Sembunyikan elemen lain */
    body * { visibility: hidden; }
    #printArea, #printArea * { visibility: visible; }

    #printArea { position: absolute; left:0; top:0; width:100%; }
}
</style>
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
                <button class="btn btn-primary btn-print-top" onclick="printMutasi()">
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
                <table class="table table-borderless table-striped table-earning table-hover" id="mutasiTable">
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
                    <tbody id="mutasiBody">
                        <?php foreach ($mutasi as $m): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($m['tanggal'])) ?></td>
                            <td><?= esc($m['nama_klien'] ?? '-') ?></td>
                            <td><?= esc($m['deskripsi']) ?></td>
                            <td class="text-end text-success"><?= ($m['jenis'] === 'pemasukan') ? number_format($m['jumlah'], 2) : '-' ?></td>
                            <td class="text-end text-danger"><?= ($m['jenis'] === 'pengeluaran') ? number_format($m['jumlah'], 2) : '-' ?></td>
                            <td class="text-end fw-bold"><?= number_format($m['saldo'], 2) ?></td>
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

                <!-- Pagination dengan panah -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center" id="mutasiPagination"></ul>
                </nav>
            </div>

            <!-- PRINT AREA HIDDEN -->
            <div id="printArea" class="d-none">
                <h3 style="text-align:center;">MDS DAN REKAN</h3>
                <h4 style="text-align:center;">LAPORAN MUTASI KEUANGAN</h4>
                <hr>

                <table width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse; font-size:14px; font-family: Arial, sans-serif;">
                    <thead>
                        <tr style="background-color:#007BFF; color:white;">
                            <th style="text-align:left; padding:6px; border:1px solid #ccc;">Tanggal</th>
                            <th style="text-align:left; padding:6px; border:1px solid #ccc;">Uraian Transfer</th>
                            <th style="text-align:left; padding:6px; border:1px solid #ccc;">Deskripsi</th>
                            <th style="text-align:right; padding:6px; border:1px solid #ccc;">Pemasukan</th>
                            <th style="text-align:right; padding:6px; border:1px solid #ccc;">Pengeluaran</th>
                            <th style="text-align:right; padding:6px; border:1px solid #ccc;">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mutasi as $index => $m): ?>
                        <?php 
                            $bg = ($index % 2 == 0) ? '#f9f9f9' : '#ffffff'; // zebra stripe dengan warna sangat terang
                        ?>
                        <tr style="background-color: <?= $bg ?>;">
                            <td style="padding:5px; border:1px solid #ccc;"><?= date('d-m-Y', strtotime($m['tanggal'])) ?></td>
                            <td style="padding:5px; border:1px solid #ccc;"><?= esc($m['nama_klien']) ?></td>
                            <td style="padding:5px; border:1px solid #ccc;"><?= esc($m['deskripsi']) ?></td>
                            <td style="text-align:right; color:green; padding:5px; border:1px solid #ccc;"><?= ($m['jenis'] === 'pemasukan') ? number_format($m['jumlah'], 2) : '-' ?></td>
                            <td style="text-align:right; color:red; padding:5px; border:1px solid #ccc;"><?= ($m['jenis'] === 'pengeluaran') ? number_format($m['jumlah'], 2) : '-' ?></td>
                            <td style="text-align:right; font-weight:bold; padding:5px; border:1px solid #ccc;"><?= number_format($m['saldo'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="background-color:#e0e0e0; font-weight:bold;">
                            <td colspan="3" style="padding:5px; border:1px solid #ccc;">TOTAL</td>
                            <td style="text-align:right; color:green; padding:5px; border:1px solid #ccc;"><?= number_format($total_pemasukan, 2) ?></td>
                            <td style="text-align:right; color:red; padding:5px; border:1px solid #ccc;"><?= number_format($total_pengeluaran, 2) ?></td>
                            <td style="text-align:right; padding:5px; border:1px solid #ccc;"><?= number_format($saldo_akhir, 2) ?></td>
                        </tr>
                    </tfoot>
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
    location.reload();
}
</script>

<script>
const rowsPerPage = 10;
const tbody = document.getElementById('mutasiBody');
const pagination = document.getElementById('mutasiPagination');
const rows = Array.from(tbody.querySelectorAll('tr'));
const pageCount = Math.ceil(rows.length / rowsPerPage);
let currentPage = 1;

function showPage(page = 1) {
    currentPage = page;
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    rows.forEach((row, index) => {
        row.style.display = (index >= start && index < end) ? '' : 'none';
    });

    renderPagination();
}

function renderPagination() {
    pagination.innerHTML = '';

    // Tombol Previous
    const prevLi = document.createElement('li');
    prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prevLi.innerHTML = `<a href="#" class="page-link">&laquo; Previous</a>`;
    prevLi.addEventListener('click', function(e) {
        e.preventDefault();
        if(currentPage > 1) showPage(currentPage - 1);
    });
    pagination.appendChild(prevLi);

    // Nomor halaman
    for(let i = 1; i <= pageCount; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
        li.innerHTML = `<a href="#" class="page-link">${i}</a>`;
        li.addEventListener('click', function(e){
            e.preventDefault();
            showPage(i);
        });
        pagination.appendChild(li);
    }

    // Tombol Next
    const nextLi = document.createElement('li');
    nextLi.className = `page-item ${currentPage === pageCount ? 'disabled' : ''}`;
    nextLi.innerHTML = `<a href="#" class="page-link">Next &raquo;</a>`;
    nextLi.addEventListener('click', function(e) {
        e.preventDefault();
        if(currentPage < pageCount) showPage(currentPage + 1);
    });
    pagination.appendChild(nextLi);
}

// Init
showPage(1);
</script>
