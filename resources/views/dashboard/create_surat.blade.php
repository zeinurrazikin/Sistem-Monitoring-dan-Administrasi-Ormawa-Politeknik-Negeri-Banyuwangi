<x-app-layout>
    <div class="py-2 md:py-6 px-3">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                
                <!-- Header Minimalis -->
                <div class="px-5 py-3 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-[20px]">add_task</span>
                        </div>
                        <h1 class="text-sm md:text-lg font-bold text-slate-900">Form Pengajuan</h1>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="px-5 pt-3">
                        <div class="p-2 bg-red-50 border-l-4 border-red-500 text-red-700 text-[10px] rounded-r-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('administrasi.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-3">
                    @csrf
                    
                    <!-- Nama Kegiatan -->
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Kegiatan</label>
                        <input name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" class="w-full px-4 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-blue-500 transition-all outline-none text-sm font-semibold" placeholder="Nama kegiatan..." required/>
                    </div>

                    <!-- Jenis & Tanggal (Grid 2 Kolom) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Jenis Surat</label>
                            <input type="text" name="jenis_surat" value="{{ old('jenis_surat') }}" class="w-full px-4 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-blue-500 transition-all outline-none text-sm font-semibold" placeholder="Contoh: Proposal" required/>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tanggal</label>
                            <input name="tanggal_pengajuan" value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}" class="w-full px-4 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-blue-500 transition-all outline-none text-sm font-semibold" type="date" required/>
                        </div>
                    </div>

                    <!-- Keterangan (Dibuat Pendek) -->
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="w-full px-4 py-2 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-blue-500 transition-all outline-none text-sm resize-none" rows="1">{{ old('keterangan') }}</textarea>
                    </div>

                    <!-- Upload Area Ultra-Compact -->
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Berkas (PDF/DOCX)</label>
                        <div class="relative">
                            <div class="border-2 border-dashed border-slate-200 rounded-xl p-3 flex items-center justify-center gap-3 bg-slate-50 hover:bg-blue-50 hover:border-blue-400 transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-slate-400 text-[20px]">cloud_upload</span>
                                <p id="file-label" class="text-xs font-bold text-slate-600 truncate">Pilih Dokumen</p>
                                <input name="file_dokumen" class="absolute inset-0 opacity-0 cursor-pointer" type="file" required onchange="displayFileName(this)"/>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-2 pt-2">
                        <button class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-100 active:scale-95 transition-all text-sm" type="submit">
                            Kirim Pengajuan
                        </button>
                        <a href="{{ route('administrasi.index') }}" class="px-6 py-3 text-center text-slate-400 font-bold hover:text-slate-600 transition-all text-sm uppercase tracking-widest">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const label = document.getElementById('file-label');
            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
                label.classList.add('text-blue-600');
            }
        }
    </script>
</x-app-layout>