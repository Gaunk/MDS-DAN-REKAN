<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Status Kasus</h2>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari kasus... (nomor, judul, status)">
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <?php foreach($perkara as $p): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <!-- <a href="#">
                                            <img class="align-self-center rounded-circle me-3" 
                                                 style="width:85px; height:85px;" 
                                                 alt="" 
                                                 src="<?= esc($p['avatar_pengacara'] ?? 'images/icon/avatar-01.jpg'); ?>">
                                        </a> -->
                                        <div class="media-body">
                                            <!-- Nama Klien -->
                                            <h6 class="text-light mb-1"><?= esc($p['nama_klien'] ?? '-'); ?></h6>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <i class="far fa-id-card"></i> SKK: <?= esc($p['nomor_perkara']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-user"></i>Adv: <?= esc($p['nama_pengacara'] ?? '-'); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-info-circle text-info"></i> Status: <span class="text-primary"><?= esc($p['nama_status'] ?? '-'); ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="far fa-calendar-alt"></i> Tanggal Mulai: <span class="text-success">
                                            <?= esc($p['tanggal_mulai'] ?? '-'); ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="far fa-calendar-check"></i> Tanggal Selesai: <?= esc($p['tanggal_selesai'] ?? '-'); ?>
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
</div>

<!-- =============================================================== -->
<!-- JAVASCRIPT SEARCH TABLE -->
<!-- =============================================================== -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#statusKasusTable tbody tr');

    rows.forEach(row => {

        let rowText = row.innerText.toLowerCase();

        if(rowText.includes(keyword)){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>
