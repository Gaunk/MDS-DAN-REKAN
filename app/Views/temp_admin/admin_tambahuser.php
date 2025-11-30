
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" data-bs-toggle="modal" data-bs-target="#staticModal">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                           
                        </div>
                        <div class="row">
                         
                         </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-40">
                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

                                <div class="table-responsive mt-4">
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
                                                <td><?= $user['username']; ?></td>
                                                <td><?= $user['role']; ?></td>
                                                <td class="text-end"><?= $user['email']; ?></td>

                                                <td class="text-end">

                                                    <!-- Button Edit -->
                                                    <a href="#" 
                                                       class="btn btn-warning btn-sm text-white me-1 editBtn"
                                                       data-id="<?= $user['id']; ?>"
                                                       data-username="<?= $user['username']; ?>"
                                                       data-role="<?= $user['role']; ?>"
                                                       data-email="<?= $user['email']; ?>"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#modalEditUser">
                                                       <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <a href="#"
                                                       class="btn btn-danger btn-sm deleteBtn"
                                                       data-id="<?= $user['id']; ?>"
                                                       data-username="<?= $user['username']; ?>">
                                                       <i class="bi bi-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>



                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

   <!-- MODAL TAMBAH USER -->

   <!-- modal static -->
			<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
			 data-backdrop="static">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticModalLabel">Tambah users</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="/admin/saveuser" method="post" class="">
                                        <div class="mb-3">
                                                <label for="nf-email" class=" form-control-label">Username</label>
                                                <input type="text" id="username" name="username" placeholder="Enter Username.." class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nf-email" class=" form-control-label">Email</label>
                                                <input type="email" id="email" name="email" placeholder="Enter Email.." class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class=" form-control-label">Password</label>
                                                <input type="password" id="password" name="password" placeholder="Enter Password.." class="form-control">
                                            </div>

                                            <div class="row mb-3">
										    <label for="role" class="col-md-3 col-form-label">Role</label>
										    <div class="col-md-9">
										        <select name="role" id="role" class="form-select form-select-lg">
										            <option>-- Pilih --</option>
										            <option value="admin">Admin</option>
										            <option value="member">Member</option>
										        </select>
										    </div>
										</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Confirm</button>
						</div>
					</div>
				</div>
				</form>
			</div>
			<!-- end modal static -->

			<?php foreach($users as $user): ?>
<!-- ================================= -->
<!-- MODAL EDIT USER -->
<!-- ================================= -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
  <div class="modal-dialog">
    <form action="/admin/updateUser" method="POST" class="modal-content">
      
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

          <input type="hidden" name="id" id="edit_id">

          <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" id="edit_username" class="form-control">
          </div>

          <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" id="edit_email" class="form-control">
          </div>

          <div class="mb-3">
              <label>Role</label>
              <select name="role" id="edit_role" class="form-select">
                  <option value="admin">Admin</option>
                  <option value="superadmin">Super Admin</option>
                  <option value="member">Editor</option>
              </select>
          </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-warning">Update</button>
      </div>

    </form>
  </div>
</div>

<?php endforeach ?>


<!-- ================================= -->
<!-- JS MENGISI DATA MODAL -->
<!-- ================================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- ==========================
     MODAL TAMBAH USER
========================== -->
<div class="modal fade" id="modalTambahUser" tabindex="-1">
  <div class="modal-dialog">
    <form action="/admin/saveUser" method="POST" class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah User Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

          <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
          </div>

          <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
          </div>

          <div class="mb-3">
              <label>Role</label>
              <select name="role" class="form-select">
                  <option value="admin">Admin</option>
                  <option value="superadmin">Super Admin</option>
                  <option value="editor">Editor</option>
              </select>
          </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
      </div>

    </form>
  </div>
</div>


<!-- ==========================
     MODAL EDIT USER
========================== -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
  <div class="modal-dialog">
    <form action="/admin/updateUser" method="POST" class="modal-content">

      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">

          <div class="mb-3">
              <label>Username</label>
              <input type="text" id="edit_username" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
              <label>Email</label>
              <input type="email" id="edit_email" name="email" class="form-control">
          </div>

          <div class="mb-3">
              <label>Role</label>
              <select name="role" id="edit_role" class="form-select">
                  <option value="admin">Admin</option>
                  <option value="superadmin">Super Admin</option>
                  <option value="editor">Editor</option>
              </select>
          </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-warning">Update</button>
      </div>

    </form>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// =======================
// SweetAlert Toast
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
// Isi Modal Edit
// =======================
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('edit_id').value       = this.dataset.id;
        document.getElementById('edit_username').value = this.dataset.username;
        document.getElementById('edit_email').value    = this.dataset.email;
        document.getElementById('edit_role').value     = this.dataset.role;
    });
});

// =======================
// Delete Confirm
// =======================
document.querySelectorAll('.deleteBtn').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();

        let id = this.dataset.id;
        let username = this.dataset.username;

        Swal.fire({
            title: "Hapus user?",
            html: "User <b>" + username + "</b> akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "/admin/deleteUser/" + id;
            }
        });
    });
});


</script>

<script>
    // Modal Edit
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.dataset.id;
            document.getElementById('edit_username').value = this.dataset.username;
            document.getElementById('edit_email').value = this.dataset.email;
            document.getElementById('edit_role').value = this.dataset.role;
        });
    });

</script>