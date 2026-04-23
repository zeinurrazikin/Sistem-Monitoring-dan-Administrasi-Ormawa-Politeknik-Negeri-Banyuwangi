<x-guest-layout>
    <div class="mb-10 flex flex-col items-center text-center">
        <div class="mb-6 flex justify-center items-center gap-8">
            <img src="{{ asset('images/abaef91d-bb7c-436f-8df6-f9b05449f6c3_removalai_preview.png') }}" class="h-24 w-auto object-contain drop-shadow-lg">
            <img src="{{ asset('images/20260423_165510.png') }}" class="h-24 w-auto object-contain drop-shadow-lg">
        </div>
        <h1 class="font-headline font-extrabold text-white text-2xl drop-shadow-lg tracking-tight">
            Sistem Monitoring dan Administrasi Ormawa <br> 
            <span class="text-xl opacity-90">Politeknik Negeri Banyuwangi</span>
        </h1>
    </div>

    <div class="bg-white/95 backdrop-blur-xl border border-white/20 rounded-xl shadow-2xl p-8 md:p-10">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-extrabold text-on-surface mb-2 font-headline">Selamat Datang</h2>
            <p class="text-on-surface-variant text-sm opacity-80">Silakan masuk untuk mengelola organisasi Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="nim" class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant/80 px-1">NIM</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">person</span>
                    </div>
                    <input id="nim" name="nim" type="text" value="{{ old('nim') }}" required autofocus placeholder="Masukkan NIM"
                        class="block w-full pl-11 pr-4 py-3.5 bg-surface-container-low border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center px-1">
                    <label for="password" class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant/80">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-primary hover:underline">Lupa sandi?</a>
                    @endif
                </div>
                <div class="relative group" x-data="{ show: false }">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">lock</span>
                    </div>
                    <input id="password" name="password" :type="show ? 'text' : 'password'" required placeholder="••••••••"
                        class="block w-full pl-11 pr-12 py-3.5 bg-surface-container-low border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-outline-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'"></span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <button type="submit" class="w-full py-4 px-6 bg-primary text-white font-bold rounded-lg shadow-lg shadow-primary/20 hover:bg-primary-container active:scale-[0.99] transition-all flex items-center justify-center gap-3">
                <span>Masuk ke Dashboard</span>
                <span class="material-symbols-outlined text-[20px]">login</span>
            </button>
        </form>
    </div>

    <footer class="mt-8 text-center text-[10px] text-white/70">
        <p>Sistem ini khusus digunakan oleh ormawa Poliwangi</p>
        <p class="font-bold mt-2 uppercase tracking-widest text-white/50">© 2026 SUPPORT BY HEROTECH</p>
    </footer>
</x-guest-layout>