<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Jadwal Sidang</h2>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari jadwal... (nomor, pengacara, status)">
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive mt-3">

                    <?php if (empty($jadwals)): ?>
                        <div class="alert alert-warning">
                            Tidak ada data jadwal sidang (atau gagal scrape).
                        </div>
                    <?php else: ?>
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Sidang</th>
                                    <th>Nomor Perkara</th>
                                    <th>Sidang Keliling</th>
                                    <th>Ruangan</th>
                                    <th>Agenda</th>
                                    <th>Detil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jadwals as $jadwal): ?>
                                    <tr>
                                        <td><?= esc($jadwal['no']) ?></td>
                                        <td><?= esc($jadwal['tanggal_sidang']) ?></td>
                                        <td><?= esc($jadwal['nomor_perkara']) ?></td>
                                        <td><?= esc($jadwal['sidang_keliling']) ?></td>
                                        <td><?= esc($jadwal['ruangan']) ?></td>
                                        <td><?= esc($jadwal['agenda']) ?></td>
                                        <td>
                                            <?php if (!empty($jadwal['detil'])): ?>
                                                <a href="<?= esc($jadwal['detil']) ?>" target="_blank">Lihat Detil</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SEARCH TABLE -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#jadwalTable tbody tr');
    rows.forEach(row => {
        let rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(keyword) ? "" : "none";
    });
});
</script>
<script>
    const puppeteer = require('puppeteer');
const fs = require('fs');

(async () => {
  // Launch browser headless
  const browser = await puppeteer.launch({ headless: true });
  const page = await browser.newPage();

  // Buka halaman jadwal sidang
  await page.goto('https://sipp.pn-negara.go.id/list_jadwal_sidang', { waitUntil: 'networkidle2' });

  // Tunggu tabel selesai muncul
  await page.waitForSelector('table');

  // Ambil data dari tabel
  const jadwals = await page.evaluate(() => {
    const rows = Array.from(document.querySelectorAll('table tbody tr'));
    return rows.map(row => {
      const cells = row.querySelectorAll('td');
      return {
        tanggal_sidang: cells[1]?.innerText.trim(),
        nomor_perkara:  cells[2]?.innerText.trim(),
        sidang_keliling: cells[3]?.innerText.trim(),
        ruangan:        cells[4]?.innerText.trim(),
        agenda:         cells[5]?.innerText.trim()
      };
    });
  });

  // Tampilkan hasil
  console.log(jadwals);

  // Simpan ke file JSON (opsional)
  fs.writeFileSync('jadwal_sidang.json', JSON.stringify(jadwals, null, 2));

  await browser.close();
})();

</script>