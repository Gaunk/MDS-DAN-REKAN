
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="/admin/dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <a href="/admin/listpengguna">Users Managements</a>
                                </li>   
                            </ul>
                        </li>
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-users   mb-2"></i>Management Klien</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?= base_url('admin/listklien') ?>">Data Klien</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Management Kasus</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?= base_url('admin/listperkara') ?>">Semua Kasus</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/statuskasus') ?>">Status Kasus</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="far fa-calendar   mb-2"></i>Jadwal & Agenda</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?= base_url('admin/jadwalsidang') ?>">SIPP</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/pengacara') ?>">Pengacara</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/jadwalpertemuan') ?>">Jadwal Pertemuan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/kalender_aktivitas') ?>">Kalender Aktivitas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-briefcase   mb-2"></i>Dokumen & Arsip</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?= base_url('admin/suratkuasa') ?>">Surat Kuasa</a>
                                </li>

                                <li>
                                    <a href="<?= base_url('admin/dokumenperkara') ?>">Dokumen Perkara</a>
                                </li>
                                <!-- <li>
                                    <a href="forget-pass.html">Draft Gugatan</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Notulen Rapat</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">E-Arsip</a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-dollar-sign   mb-2"></i>Keuangan</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?= base_url('admin/pembayaran') ?>">Pembayaran Klien</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/tagihan') ?>">Invoice / Tagihan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/honorariumpengacara') ?>">Honorarium Pengacara</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/pengeluaranuang') ?>">Pengeluaran Keuangan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/laporankeuangan') ?>">Laporan Keuangan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-cog   mb-2"></i>Pengaturan</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?= base_url('admin/account') ?>">Profil Akun</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/barcodeqr') ?>">Barcode</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('admin/pengaturansistem') ?>">Pengaturan Sistem</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->


        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu" id="notifMenu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity" id="notifCount"><?= !empty($kontak) ? count($kontak) : 0 ?></span>
                                        <div class="notifi-dropdown js-dropdown" id="notifDropdown">
                                            <div class="notifi__title">
                                                <p id="notifTitle">
                                                    You have <?= !empty($kontak) ? count($kontak) : 0 ?> Notification<?= count($kontak) != 1 ? 's' : '' ?>
                                                </p>
                                            </div>
                                            <div class="notifications-list" id="notifList">
                                                <?php if(!empty($kontak)): ?>
                                                    <?php foreach($kontak as $kon): ?>
                                                        <div class="notifi__item">
                                                            <div class="bg-c1 img-cir img-40">
                                                                <i class="zmdi zmdi-email-open"></i>
                                                            </div>
                                                            <div class="content">
                                                                <p><strong><?= esc($kon['name']) ?>:</strong> <?= substr(esc($kon['message']), 0, 50) ?>...</p>
                                                                <span class="date"><?= date('F d, Y H:i', strtotime($kon['created_at'])) ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="notifi__item">
                                                        <div class="bg-c1 img-cir img-40">
                                                            <i class="zmdi zmdi-email-open"></i>
                                                        </div>
                                                        <div class="content">
                                                            <p>Tidak ada pesan baru</p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="/admin/kontak">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="Admin" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"> <?= esc($username); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"> <?= esc($username); ?></a>
                                                    </h5>
                                                    <span class="email"><?= esc($email); ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="<?= base_url('admin/account') ?>">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="<?= base_url('admin/logout')?>">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
