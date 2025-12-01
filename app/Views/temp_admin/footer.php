
<!-- Jquery JS-->
    <script src="<?= base_url('temp_admin/')?>js/vanilla-utils.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url('temp_admin/')?>vendor/bootstrap-5.3.8.bundle.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?= base_url('temp_admin/')?>vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.min.js"></script>
    <script src="<?= base_url('temp_admin/')?>vendor/chartjs/chart.umd.js-4.5.0.min.js"></script>
    
    <!-- Main JS-->
    <script src="<?= base_url('temp_admin/')?>js/bootstrap5-init.js"></script>
    <script src="<?= base_url('temp_admin/')?>js/main-vanilla.js"></script>
    <script src="<?= base_url('temp_admin/')?>js/swiper-bundle-11.2.10.min.js"></script>
    <script src="<?= base_url('temp_admin/')?>js/aos.js"></script>
    <script src="<?= base_url('temp_admin/')?>js/modern-plugins.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#perkaraTable').DataTable({
        "pageLength": 10,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    // Hubungkan form input dengan DataTables
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>

</body>

</html>
<!-- end document-->
