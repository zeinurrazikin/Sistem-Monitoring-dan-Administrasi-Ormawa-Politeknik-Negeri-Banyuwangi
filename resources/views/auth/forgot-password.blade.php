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
            <h2 class="text-2xl font-extrabold text-on-surface mb-2 font-headline">Lupa Kata Sandi?</h2>
            <p class="text-on-surface-variant text-sm opacity-80 leading-relaxed">
                Tenang, masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang kata sandi Anda.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3 text-green-700">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                <p class="text-sm font-medium">{{ session('status') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant/80 px-1">Email Terdaftar</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">mail</span>
                    </div>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com"
                        class="block w-full pl-11 pr-4 py-3.5 bg-surface-container-low border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="w-full py-4 px-6 bg-primary text-white font-bold rounded-lg shadow-lg shadow-primary/20 hover:bg-primary-container active:scale-[0.99] transition-all flex items-center justify-center gap-3">
                <span>Kirim Link Reset</span>
                <span class="material-symbols-outlined text-[20px]">send</span>
            </button>

            <div class="pt-4 text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:text-primary-container transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Kembali ke Login</span>
                </a>
            </div>
        </form>
    </div>

    <footer class="mt-8 text-center text-[10px] text-white/70">
        <p>Sistem ini khusus digunakan oleh ormawa Poliwangi</p>
        <p class="font-bold mt-2 uppercase tracking-widest text-white/50">© 2026 SUPPORT BY HEROTECH</p>
    </footer>
</x-guest-layout>
