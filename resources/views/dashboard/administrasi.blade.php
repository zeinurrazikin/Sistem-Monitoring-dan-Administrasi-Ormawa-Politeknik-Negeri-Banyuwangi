<x-app-layout>
    <!-- === TOP BAR / NAVBAR === -->
    <header class="sticky top-0 z-40 h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex justify-between items-center px-4 md:px-8">
        <div class="flex items-center gap-2 md:gap-4 flex-1">
            <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-600 hover:bg-slate-50 rounded-xl">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="relative w-full max-w-[150px] sm:max-w-xs md:max-w-md">
                <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                <input type="text" id="tableSearch" onkeyup="searchTable()" class="w-full bg-slate-50 border-slate-200 border rounded-full py-1.5 pl-8 md:pl-10 pr-4 text-[10px] md:text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" placeholder="Cari data...">
            </div>
        </div>
        
        <div class="flex items-center gap-2 md:gap-4">
            <!-- FITUR NOTIFIKASI LONCENG -->
            <div class="relative" x-data="{ openNotif: false }">
                <button @click="openNotif = !openNotif" class="p-2 text-slate-500 hover:bg-slate-50 rounded-full relative transition-all">
                    <span class="material-symbols-outlined">notifications</span>
                    @if(session('notification'))
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                    @endif
                </button>
                <div x-show="openNotif" @click.away="openNotif = false" x-transition class="absolute right-0 mt-3 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden z-[60]" style="display: none;">
                    <div class="p-4 bg-slate-50 border-b border-slate-100 font-bold text-[10px] uppercase tracking-widest text-slate-400">Notifikasi Terbaru</div>
                    <div class="max-h-60 overflow-y-auto p-4 text-center">
                        @if(session('notification'))
                            <div class="text-left p-2 bg-blue-50/50 rounded-xl mb-2">
                                <p class="text-xs font-bold text-slate-900">{{ session('notification')['title'] }}</p>
                                <p class="text-[10px] text-slate-500 mt-0.5">{{ session('notification')['message'] }}</p>
                            </div>
                        @else
                            <p class="text-[11px] text-slate-400 py-4">Tidak ada aktivitas baru.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="h-8 w-[1px] bg-slate-100 hidden sm:block"></div>
            <img class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-blue-50 object-cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0037b0&color=fff">
        </div>
    </header>

    <!-- === TOAST NOTIFICATION === -->
    @if(session('notification'))
    <div id="toast-notif" class="fixed bottom-6 left-6 right-6 md:left-auto md:right-8 z-[110] animate-bounce-in">
        <div class="bg-slate-900 text-white p-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-white/10 min-w-[280px]">
            <div class="p-2 {{ session('notification')['type'] == 'danger' ? 'bg-red-500' : 'bg-blue-600' }} rounded-xl shadow-lg">
                <span class="material-symbols-outlined block text-[20px]">{{ session('notification')['icon'] ?? 'info' }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[10px] font-extrabold uppercase text-blue-400 tracking-wider leading-none mb-1">{{ session('notification')['title'] }}</p>
                <p class="text-[11px] text-slate-300">{{ session('notification')['message'] }}</p>
            </div>
            <button onclick="document.getElementById('toast-notif').remove()" class="text-slate-500 hover:text-white transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    </div>
    <script>setTimeout(() => { document.getElementById('toast-notif')?.remove() }, 5000);</script>
    @endif

    <main class="p-4 md:p-8 space-y-6">
        <!-- Title & Action -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-extrabold text-slate-900">Pengajuan Surat</h2>
                <p class="text-slate-500 text-xs md:text-sm">Kelola dan pantau pengajuan berkas organisasi anda.</p>
            </div>
            <a href="{{ route('administrasi.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-bold text-sm shadow-xl active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                Ajukan Surat
            </a>
        </div>

        <!-- Statistik Grid -->
        <div class="grid grid-cols-3 gap-2 md:gap-4">
            @foreach(['Total' => [$stats['total'], 'blue', 'send'], 'Revisi' => [$stats['revisi'], 'orange', 'warning'], 'Disetujui' => [$stats['disetujui'], 'green', 'verified']] as $label => $data)
            <div class="bg-white p-3 md:p-4 rounded-xl md:rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-center md:gap-4 text-center md:text-left transition-transform hover:scale-[1.02]">
                <div class="p-2 bg-{{ $data[1] }}-50 text-{{ $data[1] }}-600 rounded-xl mb-1 md:mb-0">
                    <span class="material-symbols-outlined block text-[18px] md:text-[22px]">{{ $data[2] }}</span>
                </div>
                <div>
                    <p class="text-[8px] md:text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $label }}</p>
                    <p class="text-sm md:text-xl font-bold text-slate-900 leading-none">{{ $data[0] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- DAFTAR PENGAJUAN SECTION -->
        <div class="space-y-4 pt-2">
            <div class="flex items-center gap-2 px-1">
                <span class="w-1.5 h-5 bg-blue-600 rounded-full"></span>
                <h3 class="text-sm md:text-base font-extrabold text-slate-800 uppercase tracking-wide">Daftar Pengajuan</h3>
            </div>

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden md:block bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <table id="submissionTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-[11px] text-slate-500 uppercase font-bold border-b border-slate-100">
                            <th class="px-6 py-4 text-center w-12">No</th>
                            <th class="px-6 py-4">Nama Kegiatan</th>
                            <th class="px-6 py-4">Jenis</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($submissions as $index => $sub)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-center text-slate-400 text-xs">{{ ($submissions->currentPage() - 1) * $submissions->perPage() + $index + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-slate-900 text-sm leading-tight">{{ $sub->nama_kegiatan }}</td>
                            <td class="px-6 py-4 text-slate-600 text-sm">{{ $sub->jenis_surat }}</td>
                            <td class="px-6 py-4 text-slate-500 text-sm">{{ \Carbon\Carbon::parse($sub->tanggal_pengajuan)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[9px] font-bold border 
                                    {{ $sub->status == 'Disetujui' ? 'bg-green-50 text-green-700 border-green-100' : ($sub->status == 'Revisi' ? 'bg-orange-50 text-orange-700 border-orange-100' : 'bg-blue-50 text-blue-700 border-blue-100') }}">
                                    {{ $sub->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button 
                                        data-id="{{ $sub->id }}" 
                                        data-kegiatan="{{ $sub->nama_kegiatan }}"
                                        data-jenis="{{ $sub->jenis_surat }}"
                                        data-tanggal="{{ \Carbon\Carbon::parse($sub->tanggal_pengajuan)->format('d M Y') }}"
                                        data-status="{{ strtolower($sub->status) }}"
                                        data-file="{{ basename($sub->file_path) }}"
                                        data-filepath="{{ $sub->file_path }}"
                                        data-catatan="{{ $sub->revision_note }}"
                                        onclick="openModal(this)" 
                                        class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-[18px] block">{{ $sub->status == 'Revisi' ? 'cloud_upload' : 'visibility' }}</span>
                                    </button>
                                    <form action="{{ route('administrasi.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Hapus pengajuan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-[18px] block">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- MOBILE CARD VIEW -->
            <div class="md:hidden space-y-4">
                @foreach($submissions as $index => $sub)
                <div class="bg-white p-5 rounded-[2rem] border border-slate-200 shadow-sm space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 bg-slate-100 rounded-xl flex items-center justify-center text-[10px] font-bold text-slate-500">{{ ($submissions->currentPage() - 1) * $submissions->perPage() + $index + 1 }}</span>
                            <div class="min-w-0">
                                <h4 class="font-extrabold text-slate-900 text-sm truncate">{{ $sub->nama_kegiatan }}</h4>
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mt-0.5">{{ $sub->jenis_surat }}</p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold border 
                            {{ $sub->status == 'Disetujui' ? 'bg-green-50 text-green-700 border-green-100' : ($sub->status == 'Revisi' ? 'bg-orange-50 text-orange-700 border-orange-100' : 'bg-blue-50 text-blue-700 border-blue-100') }}">
                            {{ $sub->status }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between pt-3 border-t border-slate-50">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($sub->tanggal_pengajuan)->format('d M Y') }}</span>
                        <div class="flex items-center gap-2">
                            <button 
                                data-id="{{ $sub->id }}" data-kegiatan="{{ $sub->nama_kegiatan }}" data-jenis="{{ $sub->jenis_surat }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($sub->tanggal_pengajuan)->format('d M Y') }}" data-status="{{ strtolower($sub->status) }}"
                                data-file="{{ basename($sub->file_path) }}" data-filepath="{{ $sub->file_path }}" data-catatan="{{ $sub->revision_note }}"
                                onclick="openModal(this)" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl text-[10px] font-bold flex items-center gap-2 shadow-lg shadow-blue-100">
                                <span class="material-symbols-outlined text-[16px]">{{ $sub->status == 'Revisi' ? 'cloud_upload' : 'visibility' }}</span>
                                {{ $sub->status == 'Revisi' ? 'Revisi' : 'Detail' }}
                            </button>
                            <form action="{{ route('administrasi.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Hapus pengajuan?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl border border-red-50">
                                    <span class="material-symbols-outlined text-[18px] block">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- PAGINATION -->
            @if ($submissions->hasPages())
            <div class="mt-8 flex items-center justify-center gap-2">
                @if (!$submissions->onFirstPage())
                    <a href="{{ $submissions->previousPageUrl() }}" class="p-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm"><span class="material-symbols-outlined block">chevron_left</span></a>
                @endif
                @foreach ($submissions->getUrlRange(1, $submissions->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-xl font-bold text-xs transition-all {{ $page == $submissions->currentPage() ? 'bg-blue-600 text-white shadow-lg' : 'bg-white border border-slate-200 text-slate-400 hover:text-blue-600' }}">{{ $page }}</a>
                @endforeach
                @if ($submissions->hasMorePages())
                    <a href="{{ $submissions->nextPageUrl() }}" class="p-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm"><span class="material-symbols-outlined block">chevron_right</span></a>
                @endif
            </div>
            @endif
        </div>
    </main>

    <!-- === MODAL OVERLAY (Vanilla JS Structure) === -->
    <div id="modal-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-all duration-300 opacity-0" role="dialog" aria-modal="true">
        <div id="modal-content" class="modal-container w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[90vh] transform scale-95 opacity-0 transition-all duration-300">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0 z-10">
                <div>
                    <h3 id="modal-title-text" class="font-extrabold text-slate-900 text-[18px]">Detail Pengajuan</h3>
                    <p id="modal-subtitle" class="text-[12px] text-slate-500 font-medium">Informasi lengkap terkait surat yang diajukan.</p>
                </div>
                <button onclick="closeModal()" class="p-2 hover:bg-slate-50 rounded-full text-slate-400 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <!-- MODAL BODY (View Mode) -->
            <div id="modal-view-body" class="p-6 overflow-y-auto space-y-6 text-on-surface">
                <!-- ⚠️ Revision Notes (Conditional) -->
                <div id="revision-note-container" class="hidden bg-orange-50 border-l-4 border-orange-500 p-4 rounded-r-xl flex gap-4">
                    <div class="flex-shrink-0">
                        <span class="material-symbols-outlined text-orange-600 bg-white rounded-full p-1 shadow-sm">warning</span>
                    </div>
                    <div>
                        <h4 class="text-orange-900 font-bold text-xs uppercase tracking-widest mb-1">Catatan Revisi</h4>
                        <p id="revision-text" class="text-orange-700 text-xs leading-relaxed italic"></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 text-left">
                    <div>
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Kegiatan</label>
                        <p id="modal-kegiatan" class="text-sm font-bold text-slate-900 leading-tight">-</p>
                        <p id="modal-id" class="text-[11px] text-blue-500 font-bold mt-1 uppercase">ID: -</p>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Jenis Surat</label>
                        <p id="modal-jenis" class="text-sm font-bold text-slate-900">-</p>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Diajukan</label>
                        <p id="modal-tanggal" class="text-sm font-bold text-slate-900">-</p>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Status Saat Ini</label>
                        <span id="modal-status-badge" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-bold border">
                            <span class="material-symbols-outlined text-[14px]"></span>
                            <span id="status-text">-</span>
                        </span>
                    </div>
                </div>
                
                <div>
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-3 ml-1">Dokumen Terlampir</label>
                    <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 rounded-2xl group hover:border-blue-400 transition-all">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center border border-slate-200 shadow-sm text-red-500">
                                <span class="material-symbols-outlined">picture_as_pdf</span>
                            </div>
                            <p id="modal-file-name" class="text-xs font-bold text-slate-800 truncate pr-4">-</p>
                        </div>
                        <a id="download-link" href="#" class="p-2.5 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-all" download>
                            <span class="material-symbols-outlined text-[20px]">download</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- MODAL BODY (Revisi Form Mode) -->
            <form id="modal-revisi-form" action="" method="POST" enctype="multipart/form-data" class="hidden p-6 space-y-6">
                @csrf
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl">
                    <p class="text-blue-800 text-xs font-bold leading-relaxed italic">Silakan unggah dokumen PDF/DOCX baru sebagai revisi untuk data ini.</p>
                </div>
                <div class="border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-3xl p-12 flex flex-col items-center justify-center relative group bg-slate-50 transition-all">
                    <span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-blue-500 mb-2 transition-colors">cloud_upload</span>
                    <p id="file-name-display" class="text-xs font-bold text-slate-600 mt-2">Klik untuk pilih berkas baru</p>
                    <input type="file" name="file_revisi" class="absolute inset-0 opacity-0 cursor-pointer" required onchange="updateFileName(this)">
                </div>
            </form>
            
            <!-- Footer -->
            <div class="px-6 py-5 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row gap-3 justify-end items-center">
                <button class="w-full sm:w-auto px-6 py-2.5 text-slate-500 font-bold text-[10px] uppercase tracking-widest hover:text-slate-700" onclick="closeModal()">Tutup Jendela</button>
                <button id="btn-revisi-start" class="hidden w-full sm:w-auto bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold text-sm shadow-xl shadow-blue-100 active:scale-95 transition-all" onclick="showUploadForm()">Upload Revisi Sekarang</button>
                <button id="btn-revisi-submit" type="submit" form="modal-revisi-form" class="hidden w-full sm:w-auto bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold text-sm shadow-xl active:scale-95 transition-all">Kirim Berkas Perbaikan</button>
            </div>
        </div>
    </div>

    <!-- === SCRIPTS === -->
    <script>
        const overlay = document.getElementById('modal-overlay');
        const modal = document.getElementById('modal-content');
        const viewBody = document.getElementById('modal-view-body');
        const uploadForm = document.getElementById('modal-revisi-form');
        const btnStart = document.getElementById('btn-revisi-start');
        const btnSubmit = document.getElementById('btn-revisi-submit');

        window.openModal = function(btn) {
            const d = btn.dataset;

            // 1. Inject Data ke DOM
            document.getElementById('modal-id').textContent = `ID: PRJ-2024-${String(d.id).padStart(3, '0')}`;
            document.getElementById('modal-kegiatan').textContent = d.kegiatan;
            document.getElementById('modal-jenis').textContent = d.jenis;
            document.getElementById('modal-tanggal').textContent = d.tanggal;
            document.getElementById('modal-file-name').textContent = d.file;
            document.getElementById('download-link').href = `/storage/${d.filepath}`;
            
            updateStatusBadge(d.status);

            // 2. Logika Revisi
            const revBox = document.getElementById('revision-note-container');
            if (d.status === 'revisi') {
                revBox.classList.remove('hidden');
                revBox.classList.add('flex');
                btnStart.classList.remove('hidden');
                document.getElementById('revision-text').textContent = d.catatan || 'Perbaiki dokumen segera.';
                uploadForm.action = `/administrasi/${d.id}/revision`;
            } else {
                revBox.classList.add('hidden');
                revBox.classList.remove('flex');
                btnStart.classList.add('hidden');
            }

            // 3. Reset UI state ke View Mode
            document.getElementById('modal-title-text').innerText = 'Informasi Pengajuan';
            viewBody.classList.remove('hidden');
            uploadForm.classList.add('hidden');
            btnSubmit.classList.add('hidden');

            // 4. Animation In
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            setTimeout(() => {
                overlay.classList.add('opacity-100');
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.body.style.overflow = 'hidden';
        }

        window.showUploadForm = function() {
            document.getElementById('modal-title-text').innerText = 'Kirim Revisi';
            viewBody.classList.add('hidden');
            uploadForm.classList.remove('hidden');
            btnStart.classList.add('hidden');
            btnSubmit.classList.remove('hidden');
        }

        window.closeModal = function() {
            overlay.classList.remove('opacity-100');
            modal.classList.remove('scale-100', 'opacity-100');
            modal.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
                document.body.style.overflow = '';
            }, 300);
        }

        function updateStatusBadge(status) {
            const badge = document.getElementById('modal-status-badge');
            const icon = badge.querySelector('.material-symbols-outlined');
            const text = document.getElementById('status-text');
            const config = {
                'disetujui': { bg: 'bg-green-50', text: 'text-green-700', border: 'border-green-100', icon: 'check_circle', label: 'Disetujui' },
                'revisi': { bg: 'bg-orange-50', text: 'text-orange-700', border: 'border-orange-100', icon: 'warning', label: 'Perlu Revisi' },
                'diajukan': { bg: 'bg-blue-50', text: 'text-blue-700', border: 'border-blue-100', icon: 'schedule', label: 'Diajukan' }
            };
            const s = config[status] || config['diajukan'];
            badge.className = `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold border ${s.bg} ${s.text} ${s.border}`;
            icon.textContent = s.icon;
            text.textContent = s.label;
        }

        function updateFileName(input) {
            if (input.files && input.files[0]) {
                document.getElementById('file-name-display').innerText = "Berkas: " + input.files[0].name;
            }
        }

        function searchTable() {
            let filter = document.getElementById("tableSearch").value.toUpperCase();
            document.querySelectorAll("#submissionTable tbody tr, .md\\:hidden > div").forEach(el => {
                el.style.display = el.innerText.toUpperCase().includes(filter) ? "" : "none";
            });
        }

        overlay.addEventListener('click', (e) => { if(e.target === overlay) closeModal(); });
        document.addEventListener('keydown', (e) => { if(e.key === 'Escape') closeModal(); });
    </script>
</x-app-layout>