<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- Header -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">List Pengguna</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                        <i class="zmdi zmdi-plus"></i> Add User
                    </button>
                </div>
            </div>

            <!-- User Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-40">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th class="text-end">Email</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($users as $user): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($user['username']); ?></td>
                                    <td><?= esc($user['nama_peran']); ?></td>
                                    <td class="text-end"><?= esc($user['email']); ?></td>
                                    <td class="text-end">
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning btn-sm btnEdit"
                                                data-id="<?= $user['id']; ?>"
                                                data-username="<?= esc($user['username']); ?>"
                                                data-email="<?= esc($user['email']); ?>"
                                                data-peran="<?= esc($user['peran']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm btnDelete"
                                                data-id="<?= $user['id']; ?>"
                                                data-username="<?= esc($user['username']); ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL TAMBAH USER -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form action="/admin/savepengguna" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username.." required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email.." required>
                </div>
                <div class="mb-3 position-relative">
                <label>Password</label>
                <input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Enter Password.." required>
                
                <!-- Icon mata di tengah vertikal -->
                <span id="togglePassword" 
                      style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                    👁️
                </span>
            </div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#kata_sandi');

    togglePassword.addEventListener('click', function () {
        // Toggle type
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle icon
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="peran" class="form-select" required>
                    <option value="">-- Pilih Peran --</option>
                    <?php foreach($peranList as $role): ?>
                        <option value="<?= $role['id']; ?>"><?= esc($role['nama_peran']); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Confirm</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT USER -->
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/admin/updatepengguna" method="POST" class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" id="edit_username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="peran" id="edit_peran" class="form-select" required>
                    <option value="">-- Pilih Peran --</option>
                    <?php foreach($peranList as $role): ?>
                        <option value="<?= $role['id']; ?>"><?= esc($role['nama_peran']); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// =======================
// Toast Success/Error
// =======================
<?php if(session()->getFlashdata('success')): ?>
Swal.fire({
    toast: true,
    icon: 'success',
    title: '<?= session()->getFlashdata('success') ?>',
    position: 'top-end',
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true
});
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
Swal.fire({
    toast: true,
    icon: 'error',
    title: '<?= session()->getFlashdata('error') ?>',
    position: 'top-end',
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true
});
<?php endif; ?>

// =======================
// Edit User
// =======================
document.querySelectorAll('.btnEdit').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('edit_id').value = this.dataset.id;
        document.getElementById('edit_username').value = this.dataset.username;
        document.getElementById('edit_email').value = this.dataset.email;
        document.getElementById('edit_peran').value = this.dataset.peran;

        // Show modal
        let modal = new bootstrap.Modal(document.getElementById('modalEditUser'));
        modal.show();
    });
});

// =======================
// Delete Confirm
// =======================
document.querySelectorAll('.btnDelete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const username = this.dataset.username;

        Swal.fire({
            title: 'Hapus User?',
            html: 'User <b>' + username + '</b> akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if(result.isConfirmed){
                window.location.href = '/admin/deletepengguna/' + id;
            }
        });
    });
});
</script>
