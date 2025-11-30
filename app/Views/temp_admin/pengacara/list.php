<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Daftar Pengacara</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalTambahPengacara">
                        <i class="zmdi zmdi-plus"></i> Tambah Pengacara
                    </button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari pengacara... (nama, email, telepon, peran)">
                </div>
            </div>

            <!-- CARDS -->
            <div class="row" id="pengacaraCards">
                <?php foreach($pengacara as $p): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 pengacara-card">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <a href="#">
                                        <img class="align-self-center rounded-circle me-3" 
                                         style="width:85px; height:85px;" 
                                         alt="Foto Pengacara" 
                                         src="<?= $p['foto_pengacara'] ? base_url('uploads/pengacara/'.$p['foto_pengacara']) : base_url('images/icon/avatar-01.jpg'); ?>">

                                        </a>

                                        <div class="media-body">
                                            <h6 class="text-light mb-1 mt-3"><?= esc($p['nama']); ?></h6>
                                            <p class="mb-0 text-white-50"><?= esc($p['nama_peran'] ?? '-'); ?></p>
                                        </div>
                                        <div class="ms-auto d-flex flex-column align-items-end">
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-warning mb-1 btnEditPengacara"
                                                    data-id="<?= $p['id']; ?>"
                                                    data-nama="<?= esc($p['nama']); ?>"
                                                    data-email="<?= esc($p['email']); ?>"
                                                    data-telepon="<?= esc($p['telepon']); ?>"
                                                    data-alamat="<?= esc($p['alamat']); ?>"
                                                    data-pendidikan="<?= esc($p['pendidikan']); ?>"
                                                    data-jurusan="<?= $p['jurusan']; ?>"
                                                    data-nama_kampus="<?= esc($p['nama_kampus']); ?>"
                                                    data-peran="<?= $p['peran']; ?>"
                                                    data-foto="<?= esc($p['foto_pengacara']); ?>"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalEditPengacara">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Delete Button -->
                                            <a href="<?= base_url('admin/deletepengacara/'.$p['id']); ?>" 
                                               class="btn btn-sm btn-danger btnDeletePengacara">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="fas fa-envelope"></i> Email: <?= esc($p['email'] ?? '-'); ?></li>
                                    <li class="list-group-item"><i class="fas fa-phone"></i> Telepon: <?= esc($p['telepon'] ?? '-'); ?></li>
                                    <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> Alamat: <?= esc($p['alamat'] ?? '-'); ?></li>
                                    <li class="list-group-item"><i class="fas fa-graduation-cap"></i> <?= esc($p['pendidikan'] ?? '-'); ?>, <?= esc($p['nama_jurusan'] ?? '-'); ?></li>
                                    <li class="list-group-item"><i class="fas fa-university"></i> <?= esc($p['nama_kampus'] ?? '-'); ?></li>
                                </ul>
                            </section>
                        </aside>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<!-- MODAL TAMBAH PENGACARA -->
<div class="modal fade" id="modalTambahPengacara" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="/admin/savepengacara" method="POST" class="modal-content" enctype="multipart/form-data">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Pengacara</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Form fields -->
                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                        <span>pakai gelar(wajib)</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Pendidikan</label>
                        <input type="text" name="pendidikan" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                         <label>Jurusan</label>
                        <select name="jurusan" class="form-select">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php foreach($jurusanList as $j): ?>
                                <option value="<?= $j['id']; ?>"><?= esc($j['nama_jurusan']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nama Kampus</label>
                        <input type="text" name="nama_kampus" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Peran</label>
                        <select name="peran" class="form-select" required>
                            <option value="">-- Pilih Peran --</option>
                            <?php foreach($peranList as $role): ?>
                                <option value="<?= $role['id']; ?>"><?= esc($role['nama_peran']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto_pengacara" class="form-control" id="fotoInput">
                        <img id="fotoPreview" src="images/icon/avatar-01.jpg" 
                             alt="Preview Foto" style="width:100px; height:100px; object-fit:cover; border-radius:50%; margin-top:10px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT PENGACARA -->
<div class="modal fade" id="modalEditPengacara" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="/admin/updatepengacara" method="POST" class="modal-content" enctype="multipart/form-data">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Pengacara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_nama">Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_email">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_telepon">Telepon</label>
                        <input type="text" name="telepon" id="edit_telepon" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_alamat">Alamat</label>
                        <input type="text" name="alamat" id="edit_alamat" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_pendidikan">Pendidikan</label>
                        <input type="text" name="pendidikan" id="edit_pendidikan" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_jurusan">Jurusan</label>
                        <select name="jurusan" id="edit_jurusan" class="form-select">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php foreach($jurusanList as $j): ?>
                                <option value="<?= $j['id']; ?>"><?= esc($j['nama_jurusan']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_nama_kampus">Nama Kampus</label>
                        <input type="text" name="nama_kampus" id="edit_nama_kampus" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_peran">Peran</label>
                        <select name="peran" id="edit_peran" class="form-select" required>
                            <option value="">-- Pilih Peran --</option>
                            <?php foreach($peranList as $role): ?>
                                <option value="<?= $role['id']; ?>"><?= esc($role['nama_peran']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="edit_foto">Foto</label>
                        <input type="file" name="foto_pengacara" id="edit_foto" class="form-control" accept="image/*">
                        <img id="edit_foto_preview" src="images/icon/avatar-01.jpg" 
                             alt="Preview Foto" style="width:100px; height:100px; object-fit:cover; border-radius:50%; margin-top:10px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT PREVIEW FOTO -->
<script>
document.getElementById('edit_foto').addEventListener('change', function(e) {
    const preview = document.getElementById('edit_foto_preview');
    const file = e.target.files[0];
    if(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = 'images/icon/avatar-01.jpg';
    }
});
</script>


<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Toast function
function showToast(message, icon = 'success') {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}

// PHP flashdata toast
<?php if(session()->getFlashdata('success')): ?>
showToast("<?= session()->getFlashdata('success'); ?>", 'success');
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
showToast("<?= session()->getFlashdata('error'); ?>", 'error');
<?php endif; ?>

// Edit Pengacara
const editButtons = document.querySelectorAll('.btnEditPengacara');
editButtons.forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const email = this.dataset.email;
        const telepon = this.dataset.telepon;
        const alamat = this.dataset.alamat;
        const pendidikan = this.dataset.pendidikan;
        const jurusan = this.dataset.jurusan;
        const nama_kampus = this.dataset.nama_kampus;
        const peran = this.dataset.peran;
        const foto = this.dataset.foto;

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_telepon').value = telepon;
        document.getElementById('edit_alamat').value = alamat;
        document.getElementById('edit_pendidikan').value = pendidikan;
        document.getElementById('edit_jurusan').value = jurusan;
        document.getElementById('edit_nama_kampus').value = nama_kampus;
        document.getElementById('edit_peran').value = peran;

        document.getElementById('edit_foto_preview').src = foto ? foto : 'images/icon/avatar-01.jpg';
    });
});

// Preview foto tambah
const fotoInput = document.getElementById('fotoInput');
fotoInput.addEventListener('change', function() {
    const file = this.files[0];
    const fotoPreview = document.getElementById('fotoPreview');
    if(file){
        const reader = new FileReader();
        reader.onload = e => fotoPreview.src = e.target.result;
        reader.readAsDataURL(file);
    } else {
        fotoPreview.src = 'images/icon/avatar-01.jpg';
    }
});

// Preview foto edit
const editFotoInput = document.getElementById('edit_foto');
editFotoInput.addEventListener('change', function() {
    const file = this.files[0];
    const fotoPreview = document.getElementById('edit_foto_preview');
    if(file){
        const reader = new FileReader();
        reader.onload = e => fotoPreview.src = e.target.result;
        reader.readAsDataURL(file);
    }
});

// Search pengacara
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let cards = document.querySelectorAll('.pengacara-card');
    cards.forEach(card => {
        card.style.display = card.innerText.toLowerCase().includes(keyword) ? '' : 'none';
    });
});

// Delete pengacara dengan SweetAlert
document.querySelectorAll('.btnDeletePengacara').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();
        const href = this.getAttribute('href');

        Swal.fire({
            title: 'Yakin ingin menghapus pengacara ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = href;
            }
        });
    });
});
</script>
