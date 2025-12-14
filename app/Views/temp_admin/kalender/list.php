<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap"></div>
                </div>
            </div>

            <div class="row m-t-25">
                <!-- Kalender -->
                <div class="col-lg-9">
                    <div class="au-card">
                        <div class="au-card-inner">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3">
                    <!-- Event Terdekat -->
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Terdekat</h3>
                            <div id="upcoming-events">
                                <p>Memuat event...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="au-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Info Jadwal</h3>
                            <div class="calendar-legend">
                                <div class="mb-2"><span class="badge bg-primary">Meeting</span></div>
                                <div class="mb-2"><span class="badge bg-success">Task</span></div>
                                <div class="mb-2"><span class="badge bg-warning">Appointment</span></div>
                                <div class="mb-2"><span class="badge bg-danger">Deadline</span></div>
                                <div class="mb-2"><span class="badge bg-info">Presentation</span></div>
                                <div><span class="badge bg-secondary">Custom</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="eventForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah / Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="event-id" name="id">
                    <input type="hidden" id="event-date" name="tanggal">

                    <div class="mb-3">
                        <label>Judul Event</label>
                        <input type="text" id="edit_kegiatan" name="kegiatan" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Waktu Mulai</label>
                            <input type="time" id="edit_waktu_mulai" name="waktu_mulai" class="form-control">
                        </div>
                        <div class="col">
                            <label>Waktu Selesai</label>
                            <input type="time" id="edit_waktu_selesai" name="waktu_selesai" class="form-control">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Tipe Event</label>
                        <select id="edit_tipe" name="tipe" class="form-select">
                            <option value="meeting">Meeting</option>
                            <option value="task">Task</option>
                            <option value="appointment">Appointment</option>
                            <option value="deadline">Deadline</option>
                            <option value="presentation">Presentation</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label>Deskripsi</label>
                        <textarea id="edit_deskripsi" name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="delete-event-btn" class="btn btn-danger me-auto" style="display:none;">Hapus Event</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- FullCalendar & Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
    const eventForm = document.getElementById('eventForm');
    const deleteBtn = document.getElementById('delete-event-btn');
    const upcomingEl = document.getElementById('upcoming-events');

    // ==========================
    // Inisialisasi Kalender
    // ==========================
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        editable: false, // edit hanya lewat modal
        events: [],
        dateClick: function(info) { kalendertambah(info.dateStr); },
        eventClick: function(info) { kalenderupdate(info.event); },
        eventDidMount: function(info) {
            const tipe = info.event.extendedProps.tipe || 'custom';
            const colors = {
                meeting: '#0d6efd',
                task: '#198754',
                appointment: '#ffc107',
                deadline: '#dc3545',
                presentation: '#0dcaf0',
                custom: '#6c757d'
            };
            info.el.style.backgroundColor = colors[tipe];
        }
    });
    calendar.render();

    // ==========================
    // Load Events dari Server
    // ==========================
    async function loadEvents() {
        const res = await fetch('/admin/kalender_aktivitas', { headers: {'X-Requested-With':'XMLHttpRequest'} });
        const data = await res.json();

        calendar.removeAllEvents();
        data.forEach(e => calendar.addEvent({
            id: e.id,
            title: e.title,
            start: e.start,
            end: e.end,
            allDay: e.allDay,
            extendedProps: e.extendedProps
        }));
        updateUpcoming();
    }

    // ==========================
    // Sidebar Upcoming Events
    // ==========================
    function updateUpcoming() {
        const events = calendar.getEvents()
            .filter(e => new Date(e.start) >= new Date())
            .sort((a,b) => new Date(a.start) - new Date(b.start))
            .slice(0,5);

        if(events.length === 0) {
            upcomingEl.innerHTML = '<p>Belum ada event.</p>';
            return;
        }

        let html = '<ul class="list-unstyled">';
        events.forEach(e => {
            const start = new Date(e.start);
            const time = start.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
            html += `<li><span class="badge bg-${getBadge(e.extendedProps.tipe)} me-1">${e.extendedProps.tipe || 'custom'}</span> ${time} - ${e.title}</li>`;
        });
        html += '</ul>';
        upcomingEl.innerHTML = html;
    }

    function getBadge(type) {
        switch(type) {
            case 'meeting': return 'primary';
            case 'task': return 'success';
            case 'appointment': return 'warning';
            case 'deadline': return 'danger';
            case 'presentation': return 'info';
            default: return 'secondary';
        }
    }

    // ==========================
    // Tambah Event
    // ==========================
    function kalendertambah(tanggal) {
        eventForm.reset();
        deleteBtn.style.display = 'none';
        document.getElementById('event-id').value = '';
        document.getElementById('event-date').value = tanggal;
        eventModal.show();
    }

    // ==========================
    // Update Event
    // ==========================
    function kalenderupdate(event) {
        document.getElementById('event-id').value = event.id;
        document.getElementById('event-date').value = event.startStr.split('T')[0];
        document.getElementById('edit_kegiatan').value = event.title;
        document.getElementById('edit_waktu_mulai').value = event.extendedProps.waktu_mulai || '';
        document.getElementById('edit_waktu_selesai').value = event.extendedProps.waktu_selesai || '';
        document.getElementById('edit_tipe').value = event.extendedProps.tipe || 'custom';
        document.getElementById('edit_deskripsi').value = event.extendedProps.deskripsi || '';
        deleteBtn.style.display = 'inline-block';
        eventModal.show();
    }

    // ==========================
// Hapus Event dengan SweetAlert2
// ==========================
async function kalenderhapus(id) {
    // Konfirmasi sebelum hapus
    const result = await Swal.fire({
        title: 'Hapus Event?',
        text: "Apakah Anda yakin ingin menghapus event ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    });

    if (!result.isConfirmed) return;

    try {
        const res = await fetch('<?= base_url('/admin/kalender_hapus') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        const data = await res.json();

        if (data.success) {
            await loadEvents(); // reload semua event dari database
            eventModal.hide();
            Swal.fire({
                icon: 'success',
                title: 'Terhapus!',
                text: 'Event berhasil dihapus',
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Gagal menghapus event'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan server'
        });
    }
}

    // ==========================
    // Submit Event (Tambah / Update)
    // ==========================
    eventForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('event-id').value;
        const data = {
            id: id || null,
            kegiatan: document.getElementById('edit_kegiatan').value,
            tanggal: document.getElementById('event-date').value,
            waktu_mulai: document.getElementById('edit_waktu_mulai').value || null,
            waktu_selesai: document.getElementById('edit_waktu_selesai').value || null,
            tipe: document.getElementById('edit_tipe').value,
            deskripsi: document.getElementById('edit_deskripsi').value,
            all_day: 0
        };

        const url = id ? '/admin/kalender_update' : '/admin/kalender_tambah';
        const res = await fetch(url, {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify(data)
        });
        const result = await res.json();

        if(result.success) {
            await loadEvents();
            eventModal.hide();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: result.message || 'Gagal menyimpan event'
            });
        }
    });

    // Tombol Hapus Event
    deleteBtn.addEventListener('click', function() {
        const id = document.getElementById('event-id').value;
        if(id) kalenderhapus(id);
    });

    // Load events pertama kali
    loadEvents();
});
</script>
