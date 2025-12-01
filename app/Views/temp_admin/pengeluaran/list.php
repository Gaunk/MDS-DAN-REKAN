<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Pengeluaran Uang</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengeluaranModal">
                        <i class="fas fa-plus"></i> Tambah Pengeluaran
                    </button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari pengeluaran... (keterangan, kategori)">
                </div>
            </div>

            <!-- TOTAL PEMASUKAN, SISA UANG & PENGELUARAN -->
            <div class="row mb-4">
                <!-- Pemasukan -->
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-primary">
                                    <i class="zmdi zmdi-arrow-up"></i>
                                </div>
                                <div class="text">
                                    <h2>$ <?= number_format($totalPemasukan ?? 0, 2); ?></h2>
                                    <span>Pemasukan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sisa Uang -->
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item <?= ($sisaUang < 0) ? 'overview-item--c2' : 'overview-item--c1'; ?>">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon <?= ($sisaUang < 0) ? 'text-danger' : 'text-success'; ?>">
                                    <i class="zmdi <?= ($sisaUang < 0) ? 'zmdi-arrow-down' : 'zmdi-arrow-up'; ?>"></i>
                                </div>
                                <div class="text">
                                    <h2>$ <?= number_format($sisaUang ?? 0, 2); ?></h2>
                                    <span>
                                        <?php if($sisaUang < 0): ?>
                                            <strong class="text-white">Minus Uang</strong>
                                        <?php else: ?>
                                            <strong>Sisa Uang</strong>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Pengeluaran -->
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-warning">
                                    <i class="zmdi zmdi-arrow-down"></i>
                                </div>
                                <div class="text">
                                    <h2>$ <?= number_format($totalPengeluaran ?? 0, 2); ?></h2>
                                    <span>Pengeluaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- CARDS PENGELUARAN -->
            <div class="row" id="pengeluaranCards">
                <?php foreach($listPengeluaran as $p): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <aside class="profile-nav alt">
                            <section class="card border-<?= $p['kategori'] === 'Pembelian' || $p['kategori'] === 'Operasional' ? 'danger' : 'success'; ?>">
                                <div class="card-header bg-<?= $p['kategori'] === 'Pembelian' || $p['kategori'] === 'Operasional' ? 'danger' : 'success'; ?> text-light">
                                    <i class="fas <?= $p['kategori'] === 'Pembelian' || $p['kategori'] === 'Operasional' ? 'fa-arrow-down' : 'fa-arrow-up'; ?> me-2"></i>
                                    <?= esc($p['kategori']); ?>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <i class="far fa-calendar-alt"></i> Tanggal: <?= esc($p['tanggal']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-file-alt"></i> Keterangan: <?= esc($p['keterangan']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-dollar-sign"></i> Jumlah: <?= number_format($p['jumlah'], 2); ?>
                                    </li>
                                </ul>
                            </section>
                        </aside>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<!-- MODAL TAMBAH PENGELUARAN -->
<div class="modal fade" id="tambahPengeluaranModal" tabindex="-1" aria-labelledby="tambahPengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/savepengeluaran'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPengeluaranLabel">Tambah Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" name="tanggal" class="form-control" id="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pembelian">Pembelian</option>
                            <option value="Transport">Transport</option>
                            <option value="Honorarium">Honorarium</option>
                            <option value="Operasional">Operasional</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" step="0.01" name="jumlah" class="form-control" id="jumlah" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengeluaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JAVASCRIPT SEARCH CARDS -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let cards = document.querySelectorAll('#pengeluaranCards .col-lg-3');

    cards.forEach(card => {
        let cardText = card.innerText.toLowerCase();
        card.style.display = cardText.includes(keyword) ? "" : "none";
    });
});
</script>
