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

                <!-- Sidebar -->
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

                    <!-- Legend -->
                    <div class="au-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Jenis Event</h3>
                            <div class="calendar-legend">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-primary rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Meeting</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-success rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Task</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-warning rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Appointment</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-danger rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Deadline</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="legend-color bg-info rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Presentation</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="legend-color bg-secondary rounded me-2" style="width:16px; height:16px;"></div>
                                    <span class="fs-6">Custom</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Sidebar -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="eventForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Tambah / Edit Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="event-id">
          <input type="hidden" id="event-date">
          <div class="mb-3">
            <label for="event-title" class="form-label">Judul Event</label>
            <input type="text" class="form-control" id="event-title" required>
          </div>
          <div class="mb-3">
            <label for="event-start" class="form-label">Waktu Mulai</label>
            <input type="time" class="form-control" id="event-start">
          </div>
          <div class="mb-3">
            <label for="event-end" class="form-label">Waktu Selesai</label>
            <input type="time" class="form-control" id="event-end">
          </div>
          <div class="mb-3">
            <label for="event-type" class="form-label">Tipe Event</label>
            <select class="form-select" id="event-type" required>
              <option value="meeting">Meeting</option>
              <option value="task">Task</option>
              <option value="appointment">Appointment</option>
              <option value="deadline">Deadline</option>
              <option value="presentation">Presentation</option>
              <option value="custom" selected>Custom</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="event-desc" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="event-desc" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" id="delete-event-btn" class="btn btn-danger me-auto" style="display:none;">Hapus Event</button>
          <button type="submit" class="btn btn-primary">Simpan Event</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- FullCalendar & Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const upcomingEl = document.getElementById('upcoming-events');
    const eventModalEl = document.getElementById('eventModal');
    const eventModal = new bootstrap.Modal(eventModalEl);
    const eventForm = document.getElementById('eventForm');
    const deleteBtn = document.getElementById('delete-event-btn');

    function getBadgeClass(tipe) {
        switch(tipe.toLowerCase()) {
            case 'meeting': return 'bg-primary';
            case 'task': return 'bg-success';
            case 'appointment': return 'bg-warning';
            case 'deadline': return 'bg-danger';
            case 'presentation': return 'bg-info';
            case 'custom': return 'bg-secondary';
            default: return 'bg-secondary';
        }
    }

    function renderUpcoming(events) {
        if (!upcomingEl) return;
        if (events.length === 0) {
            upcomingEl.innerHTML = '<p>Tidak ada event terdekat</p>';
            return;
        }
        let html = '';
        events.forEach(e => {
            const start = new Date(e.start);
            const end = e.end ? new Date(e.end) : null;
            const month = start.toLocaleString('default', { month: 'short' }).toUpperCase();
            const day = start.getDate();
            const timeText = end ? 
                `${start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}` 
                : 'All Day';
            const tipe = e.extendedProps?.tipe || 'Custom';
            const badgeClass = getBadgeClass(tipe);

            html += `
            <div class="event-item d-flex align-items-start mb-3 p-3 border rounded">
                <div class="event-date text-center me-3">
                    <div class="fs-6 fw-bold text-primary">${month}</div>
                    <div class="fs-4 fw-bold">${day}</div>
                </div>
                <div class="event-details flex-grow-1">
                    <h6 class="mb-1">${e.title}</h6>
                    <small class="text-muted">${timeText}</small>
                    <div class="mt-1">
                        <span class="badge ${badgeClass}">${tipe}</span>
                    </div>
                </div>
            </div>`;
        });
        upcomingEl.innerHTML = html;
    }

    function loadEvents() {
        fetch('<?= base_url('admin/kalender_aktivitas') ?>', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.json())
        .then(data => {
            calendar.removeAllEvents();
            data.forEach(event => calendar.addEvent(event));
            const now = new Date();
            const upcoming = data.filter(ev => new Date(ev.start) >= now)
                                 .sort((a,b)=> new Date(a.start)-new Date(b.start))
                                 .slice(0,3);
            renderUpcoming(upcoming);
        });
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: { left:'prev,next today', center:'title', right:'dayGridMonth,timeGridWeek,timeGridDay,listWeek' },
        height: 'auto',
        eventDisplay: 'block',
        dayMaxEvents: 3,
        moreLinkText: 'lebih',
        dateClick: function(info) {
            openEventModal({dateStr: info.dateStr});
        },
        eventClick: function(info) {
            const e = info.event;
            const p = e.extendedProps;
            openEventModal({
                id: e.id || '',
                title: e.title,
                start: e.start ? e.start.toISOString().substring(11,16) : '',
                end: e.end ? e.end.toISOString().substring(11,16) : '',
                dateStr: e.start.toISOString().split('T')[0],
                tipe: p.tipe || 'custom',
                desc: p.deskripsi || ''
            });
        }
    });

    calendar.render();
    window.calendarInstance = calendar;
    loadEvents();

    function openEventModal(eventData) {
        document.getElementById('event-id').value = eventData.id || '';
        document.getElementById('event-date').value = eventData.dateStr || '';
        document.getElementById('event-title').value = eventData.title || '';
        document.getElementById('event-start').value = eventData.start || '';
        document.getElementById('event-end').value = eventData.end || '';
        document.getElementById('event-type').value = eventData.tipe || 'custom';
        document.getElementById('event-desc').value = eventData.desc || '';
        deleteBtn.style.display = eventData.id ? 'inline-block' : 'none';
        eventModal.show();
    }

    eventForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('event-id').value;
        const title = document.getElementById('event-title').value;
        const startTime = document.getElementById('event-start').value;
        const endTime = document.getElementById('event-end').value;
        const tipe = document.getElementById('event-type').value;
        const desc = document.getElementById('event-desc').value;
        const dateStr = document.getElementById('event-date').value;
        const all_day = !startTime && !endTime ? 1 : 0;

        fetch('<?= base_url('admin/kalender_tambah') ?>', {
            method: 'POST',
            headers: { 'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest' },
            body: JSON.stringify({
                id, kegiatan: title, tanggal: dateStr,
                waktu_mulai: startTime, waktu_selesai: endTime,
                all_day, tipe, deskripsi: desc
            })
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.success){
                loadEvents();
                eventModal.hide();
                alert('Event berhasil disimpan!');
            } else alert('Gagal menyimpan event.');
        });
    });

    // Fungsi hapus event
    function hapusKalender(eventId) {
        if (!eventId) {
            alert('ID event tidak ditemukan.');
            return;
        }
        if (!confirm('Apakah Anda yakin ingin menghapus event ini?')) return;

        fetch('<?= base_url('admin/kalender_hapus') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ id: eventId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadEvents();
                eventModal.hide();
                alert('Event berhasil dihapus!');
            } else {
                alert('Gagal menghapus event.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat menghapus event.');
        });
    }

    deleteBtn.addEventListener('click', function() {
        const id = document.getElementById('event-id').value;
        hapusKalender(id);
    });

    window.addNewEvent = function() {
        const today = new Date().toISOString().split('T')[0];
        openEventModal({dateStr: today});
    };

    window.hapusKalender = hapusKalender; // agar bisa dipanggil dari luar
});
</script>
