<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Kalender Aktivitas</h2>
                </div>
            </div>

            <!-- KALENDER -->
            <div id="calendar"></div>

        </div>
    </div>
</div>


<!-- =============================================================== -->
<!-- FULLCALENDAR JS -->
<!-- =============================================================== -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,

        // Ambil event dari controller
        events: "<?= base_url('pengacara/kalender_aktivitas'); ?>",

        eventClick: function(info) {
            alert("Kegiatan: " + info.event.title + "\nTanggal: " + info.event.start.toLocaleDateString());
        }
    });

    calendar.render();
});
</script>
