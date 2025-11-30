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

            <!-- 2 GRID -->
            <div class="row">
                <!-- KIRI: Form Update Profil -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <section class="card">
                        <div class="card-header bg-primary text-light">
                            Update Profil
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/updateaccount') ?>" method="POST">
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= esc($username) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= esc($email) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Kata Sandi (kosongkan jika tidak diganti)</label>
                                    <input type="password" name="kata_sandi" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Tema</label>
                                    <select name="tema" class="form-select">
                                        <option value="light" <?= $tema=='light'?'selected':'' ?>>Light</option>
                                        <option value="dark" <?= $tema=='dark'?'selected':'' ?>>Dark</option>
                                    </select>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="notifikasi_email" class="form-check-input" id="notifikasi_email" <?= $notifikasi_email ? 'checked':'' ?>>
                                    <label class="form-check-label" for="notifikasi_email">Aktifkan Notifikasi Email</label>
                                </div>

                                <div class="mb-3">
                                    <label>Pesan</label>
                                    <textarea name="pesan" class="form-control"><?= esc($pesan) ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </section>
                </div>

                <!-- KANAN: Info Profil / Card Ringkas -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <section class="card">
                        <div class="card-header bg-secondary text-light">
                            Info Akun
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Username:</strong> <?= esc($username) ?></li>
                                <li class="list-group-item"><strong>Email:</strong> <?= esc($email) ?></li>
                                <li class="list-group-item"><strong>Peran:</strong> <?= esc($peran) ?></li>
                                <li class="list-group-item"><strong>Tema:</strong> <?= esc($tema) ?></li>
                                <li class="list-group-item"><strong>Notifikasi Email:</strong> <?= $notifikasi_email ? 'Aktif':'Nonaktif' ?></li>
                                <li class="list-group-item"><strong>Pesan:</strong> <?= esc($pesan) ?></li>
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
    timerProgressBar: true
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
    timerProgressBar: true
});
<?php endif; ?>
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const usernameInput = document.querySelector('input[name="username"]');
    const emailInput = document.querySelector('input[name="email"]');
    const temaSelect  = document.querySelector('select[name="tema"]');
    const notifikasiCheckbox = document.querySelector('input[name="notifikasi_email"]');
    const pesanTextarea = document.querySelector('textarea[name="pesan"]');

    const infoList = document.querySelectorAll('.list-group-item');
    const infoUsername = infoList[0];
    const infoEmail    = infoList[1];
    const infoTema     = infoList[3];
    const infoNotif    = infoList[4];
    const infoPesan    = infoList[5];

    // Update card info saat input berubah
    usernameInput.addEventListener('input', () => {
        infoUsername.innerHTML = `<strong>Username:</strong> ${usernameInput.value}`;
    });
    emailInput.addEventListener('input', () => {
        infoEmail.innerHTML = `<strong>Email:</strong> ${emailInput.value}`;
    });
    temaSelect.addEventListener('change', () => {
        infoTema.innerHTML = `<strong>Tema:</strong> ${temaSelect.value}`;
        // Optional: langsung ubah tema halaman
        document.body.setAttribute('data-theme', temaSelect.value);
    });
    notifikasiCheckbox.addEventListener('change', () => {
        infoNotif.innerHTML = `<strong>Notifikasi Email:</strong> ${notifikasiCheckbox.checked ? 'Aktif' : 'Nonaktif'}`;
    });
    pesanTextarea.addEventListener('input', () => {
        infoPesan.innerHTML = `<strong>Pesan:</strong> ${pesanTextarea.value}`;
    });

    // Validasi form sebelum submit
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        if(usernameInput.value.trim() === '' || emailInput.value.trim() === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Username dan email wajib diisi!'
            });
        }
    });
});
</script>
