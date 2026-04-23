<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">
            Atur Ulang Kata Sandi
        </h2>
        <p class="mt-3 text-sm text-gray-700">
            Langkah terakhir! Masukkan kata sandi baru Anda dengan aman.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold text-gray-800" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 font-medium text-gray-600" type="email" name="email" :value="old('email', $request->email)" required readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi Baru')" class="font-semibold text-gray-800" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="font-semibold text-gray-800" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi baru" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center text-sm font-bold uppercase tracking-widest py-3">
                {{ __('Simpan Kata Sandi Baru') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
