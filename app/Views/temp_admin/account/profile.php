
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="title-1">Profil Saya</h2>
                </div>
            </div>

            <!-- GRID 2 KOLOM -->
            <div class="row">

                <!-- KIRI: FORM UPDATE -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <section class="card">
                        <div class="card-header bg-primary text-light">
                            Update Profil
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/updateaccount') ?>" method="POST">
                                <?= csrf_field(); ?>

                                <!-- USERNAME -->
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="<?= esc($user['username']) ?>" required>
                                </div>

                                <!-- EMAIL -->
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?= esc($user['email']) ?>" required>
                                </div>

                                <!-- PASSWORD -->
                                <div class="mb-3">
                                    <label>Kata Sandi (kosongkan jika tidak diganti)</label>
                                    <input type="password" name="kata_sandi" class="form-control">
                                </div>

                                <!-- TEMA -->
                                <div class="mb-3">
                                    <label>Tema</label>
                                    <select name="tema" class="form-select">
                                        <option value="light" <?= $user['tema']=='light'?'selected':'' ?>>Light</option>
                                        <option value="dark" <?= $user['tema']=='dark'?'selected':'' ?>>Dark</option>
                                    </select>
                                </div>

                                <!-- NOTIFIKASI EMAIL -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="notifikasi_email" class="form-check-input"
                                        id="notifikasi_email"
                                        <?= $user['notifikasi_email'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="notifikasi_email">
                                        Aktifkan Notifikasi Email
                                    </label>
                                </div>

                                <!-- PESAN -->
                                <div class="mb-3">
                                    <label>Pesan</label>
                                    <textarea name="pesan" class="form-control"><?= esc($user['pesan']) ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </section>
                </div>

                <!-- KANAN: INFO PROFIL -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <section class="card">
                        <div class="card-header bg-secondary text-light">
                            Info Akun
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                    <strong>Username:</strong> <?= esc($user['username']) ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Email:</strong> <?= esc($user['email']) ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Peran:</strong> <?= esc($user['peran']) ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Tema:</strong> <?= esc($user['tema']) ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Notifikasi Email:</strong> 
                                    <?= $user['notifikasi_email'] ? 'Aktif' : 'Tidak aktif' ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Pesan:</strong> <?= esc($user['pesan']) ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Dibuat pada:</strong> <?= esc($user['dibuat_pada']) ?>
                                </li>

                                <li class="list-group-item">
                                    <strong>Diupdate pada:</strong> <?= esc($user['diupdate_pada']) ?>
                                </li>

                            </ul>
                        </div>
                    </section>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- SWEETALERT2 FLASHDATA -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if(session()->getFlashdata('success')): ?>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '<?= session()->getFlashdata('success') ?>',
    showConfirmButton: false,
    timer: 3000,
});
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    title: '<?= session()->getFlashdata('error') ?>',
    showConfirmButton: false,
    timer: 3000,
});
<?php endif; ?>
</script>
