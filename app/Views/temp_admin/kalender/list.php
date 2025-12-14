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
                <!-- Kalender -->
                <div class="col-lg-9">
                    <div class="au-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-40">Jadwal Kalender</h3>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3">
                    <!-- Event Terdekat -->
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Event Terdekat</h3>
                            <div id="upcoming-events">
                                <p>Memuat event...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="au-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-30">Jenis Event</h3>
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
          <h5 class="modal-title" id="eventModalLabel">Tambah / Edit Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="event-id" name="id">
          <input type="hidden" id="event-date" name="tanggal">

          <div class="mb-3">
            <label>Judul Event</label>
            <input type="text" id="event-title" name="kegiatan" class="form-control" required>
          </div>

          <div class="row">
            <div class="col">
              <label>Waktu Mulai</label>
              <input type="time" id="event-start" name="waktu_mulai" class="form-control">
            </div>
            <div class="col">
              <label>Waktu Selesai</label>
              <input type="time" id="event-end" name="waktu_selesai" class="form-control">
            </div>
          </div>

          <div class="mt-3">
            <label>Tipe Event</label>
            <select id="event-type" name="tipe" class="form-select">
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
            <textarea id="event-desc" name="deskripsi" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cancel-btn" data-bs-dismiss="modal">Batal</button>
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
    document.getElementById('cancel-btn').addEventListener('click', function() {
    // Ganti URL sesuai halaman yang ingin dituju
    window.location.href = '<?= base_url("admin/kalender_aktivitas") ?>';
});

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const upcomingEl = document.getElementById('upcoming-events');
    const eventModalEl = document.getElementById('eventModal');
    const eventModal = new bootstrap.Modal(eventModalEl);
    const eventForm = document.getElementById('eventForm');
    const deleteBtn = document.getElementById('delete-event-btn');

    function getBadgeClass(tipe) {
        switch((tipe||'').toLowerCase()) {
            case 'meeting': return 'bg-primary';
            case 'task': return 'bg-success';
            case 'appointment': return 'bg-warning';
            case 'deadline': return 'bg-danger';
            case 'presentation': return 'bg-info';
            default: return 'bg-secondary';
        }
    }

    function renderUpcoming(events) {
        if (!upcomingEl) return;
        if (!events.length) {
            upcomingEl.innerHTML = '<p>Tidak ada event terdekat</p>';
            return;
        }
        upcomingEl.innerHTML = events.map(e=>{
            const start = new Date(e.start);
            const end = e.end ? new Date(e.end) : null;
            const month = start.toLocaleString('default',{month:'short'}).toUpperCase();
            const day = start.getDate();
            const timeText = end ? 
                `${start.toLocaleTimeString([], {hour:'2-digit',minute:'2-digit'})} - ${end.toLocaleTimeString([], {hour:'2-digit',minute:'2-digit'})}` 
                : 'All Day';
            const tipe = e.extendedProps?.tipe || 'Custom';
            return `
            <div class="event-item d-flex align-items-start mb-3 p-3 border rounded">
                <div class="text-center me-3">
                    <div class="fw-bold text-primary">${month}</div>
                    <div class="fs-4 fw-bold">${day}</div>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">${e.title}</h6>
                    <small class="text-muted">${timeText}</small>
                    <div class="mt-1">
                        <span class="badge ${getBadgeClass(tipe)}">${tipe}</span>
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    async function loadEvents() {
        try {
            const res = await fetch('/admin/kalender_aktivitas', { headers:{ 'X-Requested-With':'XMLHttpRequest' }});
            const data = await res.json();
            calendar.removeAllEvents();
            data.forEach(ev=>calendar.addEvent(ev));

            const now = new Date();
            renderUpcoming(
                data.filter(e=>new Date(e.start)>=now)
                    .sort((a,b)=>new Date(a.start)-new Date(b.start))
                    .slice(0,3)
            );
        } catch(e) {
            console.error('Gagal load events:', e);
        }
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView:'dayGridMonth',
        headerToolbar:{left:'prev,next today',center:'title',right:'dayGridMonth,timeGridWeek,timeGridDay,listWeek'},
        height:'auto',
        dateClick: info => openEventModal({dateStr: info.dateStr}),
        eventClick: info => {
            const e = info.event;
            const p = e.extendedProps;
            openEventModal({
                id: e.id || '',
                title: e.title,
                start: e.start?.toISOString().substring(11,16) || '',
                end: e.end?.toISOString().substring(11,16) || '',
                dateStr: e.start.toISOString().split('T')[0],
                tipe: p.tipe || 'custom',
                desc: p.deskripsi || ''
            });
        }
    });

    calendar.render();
    loadEvents();

    function openEventModal(data={}) {
        document.getElementById('event-id').value = data.id || '';
        document.getElementById('event-date').value = data.dateStr || '';
        document.getElementById('event-title').value = data.title || '';
        document.getElementById('event-start').value = data.start || '';
        document.getElementById('event-end').value = data.end || '';
        document.getElementById('event-type').value = data.tipe || 'custom';
        document.getElementById('event-desc').value = data.desc || '';
        deleteBtn.style.display = data.id ? 'inline-block' : 'none';
        eventModal.show();
    }

    eventForm.addEventListener('submit', async function(e){
        e.preventDefault();
        const id = document.getElementById('event-id').value;
        const title = document.getElementById('event-title').value;
        const startTime = document.getElementById('event-start').value;
        const endTime = document.getElementById('event-end').value;
        const tipe = document.getElementById('event-type').value;
        const desc = document.getElementById('event-desc').value;
        const dateStr = document.getElementById('event-date').value;
        const all_day = !startTime && !endTime ? 1 : 0;

        const url = id ? '/admin/kalender_update' : '/admin/kalender_tambah';

        try {
            const res = await fetch(url, {
                method:'POST',
                headers:{ 'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest' },
                body: JSON.stringify({ id, kegiatan:title, tanggal:dateStr, waktu_mulai:startTime, waktu_selesai:endTime, all_day, tipe, deskripsi:desc })
            });
            const result = await res.json();
            if(result.success){
                loadEvents();
                eventModal.hide();
                alert(id ? 'Event berhasil diupdate!' : 'Event berhasil ditambahkan!');
            } else alert(result.message || 'Gagal menyimpan event.');
        } catch(err) {
            console.error(err);
            alert('Terjadi kesalahan saat menyimpan event.');
        }
    });

    deleteBtn.addEventListener('click', async function(){
        const id = document.getElementById('event-id').value;
        if(!id || !confirm('Hapus event ini?')) return;
        try {
            const res = await fetch('/admin/kalender_hapus', {
                method:'POST',
                headers:{ 'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest' },
                body: JSON.stringify({ id })
            });
            const result = await res.json();
            if(result.success){
                loadEvents();
                eventModal.hide();
                alert('Event berhasil dihapus!');
            } else alert(result.message || 'Gagal menghapus event.');
        } catch(err) {
            console.error(err);
            alert('Terjadi kesalahan saat menghapus event.');
        }
    });

    window.addNewEvent = ()=> openEventModal({ dateStr: new Date().toISOString().split('T')[0] });
});
</script>
