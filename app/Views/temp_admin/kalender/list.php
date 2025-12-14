<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Kalender</h2>
                        <button class="au-btn au-btn-icon au-btn--blue" onclick="addNewEvent()">
                            <i class="zmdi zmdi-plus"></i> Tambah Event
                        </button>
                    </div>
                </div>
            </div>

            <div class="row m-t-25">
                <!-- Kalender Utama -->
                <div class="col-lg-9">
                    <div class="au-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-40">Jadwal Kalender</h3>
                            <div id="calendar" class="calendar-container"></div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Event Terdekat & Legend -->
                <div class="col-lg-3">

                    <!-- Event Terdekat -->
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Event Terdekat</h3>
                            <div class="upcoming-events" id="upcoming-events">
                                <p>Memuat event...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Legend Jenis Event -->
                    <div class="au-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Jenis Event</h3>
                            <div class="calendar-legend">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-primary rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Rapat</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-success rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Tugas</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-warning rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Janji</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-danger rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Deadline</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="legend-color bg-info rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Presentasi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End Sidebar -->
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar v6+ JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const upcomingEl = document.getElementById('upcoming-events');

    if (!calendarEl) return;

    // Fungsi render sidebar event terdekat
    function renderUpcoming(events) {
        if (!upcomingEl) return;
        if (events.length === 0) {
            upcomingEl.innerHTML = '<p>Tidak ada event terdekat</p>';
            return;
        }

        let html = '';
        events.forEach(e => {
            let start = new Date(e.start);
            let end = e.end ? new Date(e.end) : null;
            let waktuText = end ? `${start.toLocaleString()} - ${end.toLocaleString()}` : start.toLocaleString();
            html += `<div class="upcoming-event-item mb-2">
                        <strong>${e.title}</strong><br>
                        <small>${waktuText}</small>
                    </div>`;
        });
        upcomingEl.innerHTML = html;
    }

    // Load semua event dari server
    function loadEvents() {
        fetch('<?= base_url('admin/kalender_aktivitas') ?>', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            // Render ke FullCalendar
            calendar.removeAllEvents();
            data.forEach(event => calendar.addEvent(event));

            // Ambil 5 event terdekat
            const now = new Date();
            const upcoming = data
                .filter(ev => new Date(ev.start) >= now)
                .sort((a, b) => new Date(a.start) - new Date(b.start))
                .slice(0, 5);
            renderUpcoming(upcoming);
        });
    }

    // Inisialisasi FullCalendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        height: 'auto',
        eventDisplay: 'block',
        dayMaxEvents: 3,
        moreLinkText: 'lebih',

        // Klik event untuk info
        eventClick: function(info) {
            const e = info.event;
            const p = e.extendedProps;
            alert(`Event: ${e.title}\nJenis: ${p.tipe || 'N/A'}\nDeskripsi: ${p.deskripsi || 'Tidak ada deskripsi'}\nMulai: ${e.start ? e.start.toLocaleString() : 'N/A'}\nSelesai: ${e.end ? e.end.toLocaleString() : 'N/A'}`);
        },

        // Klik tanggal untuk tambah event
        dateClick: function(info) {
            const title = prompt('Masukkan judul event:');
            if (!title) return;

            const waktu_mulai = prompt('Masukkan waktu mulai (HH:MM), kosong = all day') || null;
            const waktu_selesai = prompt('Masukkan waktu selesai (HH:MM), kosong = all day') || null;
            const all_day = (!waktu_mulai && !waktu_selesai) ? 1 : 0;

            fetch('<?= base_url('admin/kalender_tambah') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({
                    kegiatan: title,
                    tanggal: info.dateStr,
                    waktu_mulai: waktu_mulai,
                    waktu_selesai: waktu_selesai,
                    all_day: all_day,
                    tipe: 'custom',
                    deskripsi: 'Event buatan pengguna'
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    calendar.addEvent(data.event);
                    loadEvents(); // update sidebar
                    alert('Event berhasil ditambahkan!');
                } else {
                    alert('Gagal menambahkan event.');
                }
            });
        },

        windowResize: function() { calendar.updateSize(); }
    });

    calendar.render();
    window.calendarInstance = calendar;

    // Load data awal
    loadEvents();
});

// Tombol tambah event manual
function addNewEvent() {
    const title = prompt('Masukkan judul event:');
    if (!title) return;

    const today = new Date();
    const waktu_mulai = prompt('Masukkan waktu mulai (HH:MM), kosong = all day') || null;
    const waktu_selesai = prompt('Masukkan waktu selesai (HH:MM), kosong = all day') || null;
    const all_day = (!waktu_mulai && !waktu_selesai) ? 1 : 0;

    fetch('<?= base_url('admin/kalender_tambah') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({
            kegiatan: title,
            tanggal: today.toISOString().split('T')[0],
            waktu_mulai: waktu_mulai,
            waktu_selesai: waktu_selesai,
            all_day: all_day,
            tipe: 'custom',
            deskripsi: 'Event buatan pengguna'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.calendarInstance.addEvent(data.event);
            // Refresh sidebar
            fetch('<?= base_url('admin/kalender_aktivitas') ?>', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.json())
                .then(events => {
                    const now = new Date();
                    const upcoming = events
                        .filter(ev => new Date(ev.start) >= now)
                        .sort((a, b) => new Date(a.start) - new Date(b.start))
                        .slice(0, 5);
                    const upcomingEl = document.getElementById('upcoming-events');
                    if (upcomingEl) {
                        let html = '';
                        upcoming.forEach(e => {
                            let start = new Date(e.start);
                            let end = e.end ? new Date(e.end) : null;
                            let waktuText = end ? `${start.toLocaleString()} - ${end.toLocaleString()}` : start.toLocaleString();
                            html += `<div class="upcoming-event-item mb-2">
                                        <strong>${e.title}</strong><br>
                                        <small>${waktuText}</small>
                                    </div>`;
                        });
                        upcomingEl.innerHTML = html;
                    }
                });
            alert('Event berhasil ditambahkan!');
        } else {
            alert('Gagal menambahkan event.');
        }
    });
}
</script>
