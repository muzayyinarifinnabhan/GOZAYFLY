@extends('layouts.landing')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-10 md:py-14">

    {{-- PAGE HEADER --}}
    <header class="mb-10">
        <div class="inline-flex items-center gap-2 mb-3 px-3 py-1.5 rounded-full bg-[#FFF0E3] text-[#E65F00] text-[11px] font-extrabold">
            <span class="material-symbols-outlined text-[16px]">account_circle</span>
            AKUN SAYA
        </div>
        <h1 class="m-0 mb-2.5 text-[36px] leading-tight tracking-[-0.035em] font-extrabold text-[#1C1917]">Profil Saya</h1>
        <p class="m-0 max-w-[720px] text-[15px] leading-relaxed font-medium text-[#6B625C]">
            Kelola data diri, kata sandi, dan keamanan akun GoZay Anda.
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_360px] gap-7 items-start">

        {{-- RIGHT (sidebar profil singkat) --}}
        <div class="lg:order-2 flex flex-col gap-7">
            <div class="p-6 text-center bg-white border border-[#E9E1DB] rounded-[22px] shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                <div class="w-[100px] h-[100px] mx-auto rounded-full overflow-hidden bg-[#FFF0E3]">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                    @else
                        <div class="flex items-center justify-center h-full text-[#FF7200] text-3xl font-extrabold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h5 class="font-extrabold mb-1 mt-3 text-[#1C1917]">{{ $user->name }}</h5>
                <small class="text-[#938A83]">{{ $user->email }}</small>
                <div class="mt-4 pt-4 border-t border-[#E9E1DB] text-left">
                    <div class="flex justify-between py-1.5 text-xs"><span class="font-bold text-[#938A83]">NIK</span><span class="font-extrabold text-[#1C1917]">{{ $user->nik }}</span></div>
                    <div class="flex justify-between py-1.5 text-xs"><span class="font-bold text-[#938A83]">No. HP</span><span class="font-extrabold text-[#1C1917]">{{ $user->phone }}</span></div>
                    <div class="flex justify-between py-1.5 text-xs"><span class="font-bold text-[#938A83]">Bergabung</span><span class="font-extrabold text-[#1C1917]">{{ $user->created_at->translatedFormat('d M Y') }}</span></div>
                </div>
            </div>
        </div>

        {{-- LEFT (form) --}}
        <div class="lg:order-1 flex flex-col gap-7">

            {{-- UBAH PROFIL --}}
            <div class="overflow-hidden bg-white border border-[#E9E1DB] rounded-[22px] shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                <div class="px-6 py-4 flex items-center gap-2.5 border-b border-[#E9E1DB] text-[15px] font-extrabold text-[#1C1917]">
                    <span class="material-symbols-outlined text-[20px] text-[#FF7200]">person_edit</span>
                    Ubah Profil
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">NIK (16 digit)</label>
                                <input type="text" name="nik" maxlength="16" value="{{ old('nik', $user->nik) }}" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                                <small class="block mt-1.5 text-[#938A83] text-xs">Perubahan email perlu verifikasi ulang OTP.</small>
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">No. HP / WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Foto Profil (opsional)</label>
                                <input type="file" name="avatar" accept="image/*"
                                       class="w-full px-4 py-3 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#6B625C] file:mr-3 file:px-4 file:py-2 file:rounded-[10px] file:border-0 file:bg-[#FFF0E3] file:text-[#E65F00] file:text-xs file:font-extrabold hover:file:bg-[#FFD4B5] focus:outline-none focus:border-[#FF7200] transition-all">
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mt-4 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3">
                                <ul class="m-0 ps-3 text-xs font-semibold text-[#DC2626]">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="text-right mt-6">
                            <button type="submit" class="inline-flex items-center justify-center gap-2 min-h-[42px] px-6 rounded-[11px] border border-[#FF7200] bg-[#FF7200] text-white text-[11px] font-extrabold shadow-[0_8px_20px_rgba(255,114,0,0.18)] hover:bg-[#E65F00] hover:-translate-y-px transition-all">
                                <span class="material-symbols-outlined text-[17px]">check_circle</span>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- UBAH PASSWORD --}}
            <div class="overflow-hidden bg-white border border-[#E9E1DB] rounded-[22px] shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                <div class="px-6 py-4 flex items-center gap-2.5 border-b border-[#E9E1DB] text-[15px] font-extrabold text-[#1C1917]">
                    <span class="material-symbols-outlined text-[20px] text-[#FF7200]">shield_lock</span>
                    Ubah Password
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Password Saat Ini</label>
                                <input type="password" name="current_password" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Password Baru</label>
                                <input type="password" name="password" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                            </div>
                            <div>
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Konfirmasi</label>
                                <input type="password" name="password_confirmation" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#E9E1DB] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#FF7200] focus:ring-2 focus:ring-[#FF7200]/15 transition-all">
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="inline-flex items-center justify-center gap-2 min-h-[42px] px-6 rounded-[11px] border border-[#FFD4B5] bg-white text-[#E65F00] text-[11px] font-extrabold hover:bg-[#FFF0E3] hover:border-[#FF7200] transition-all">
                                <span class="material-symbols-outlined text-[17px]">key</span>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- HAPUS AKUN --}}
            <div class="overflow-hidden border border-[#FECACA] rounded-[22px] bg-white shadow-[0_12px_35px_rgba(83,45,18,0.07)]">
                <div class="px-6 py-4 flex items-center gap-2.5 border-b border-[#FECACA] text-[15px] font-extrabold text-[#DC2626]">
                    <span class="material-symbols-outlined text-[20px]">warning</span>
                    Hapus Akun
                </div>
                <div class="p-6">
                    <p class="m-0 mb-4 text-xs leading-relaxed font-medium text-[#6B625C]">
                        Menghapus akun akan menghapus seluruh data booking Anda. Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="flex flex-col sm:flex-row gap-4 items-end">
                            <div class="flex-grow w-full sm:w-auto">
                                <label class="block mb-2 text-[11px] font-bold text-[#938A83]">Ketik password untuk konfirmasi</label>
                                <input type="password" name="password" required
                                       class="w-full px-4 py-3.5 rounded-[16px] border border-[#FECACA] bg-[#FFFDFC] text-sm font-semibold text-[#1C1917] placeholder:text-[#938A83] focus:outline-none focus:border-[#DC2626] focus:ring-2 focus:ring-[#DC2626]/15 transition-all">
                            </div>
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus akun Anda?')"
                                    class="inline-flex items-center justify-center gap-2 min-h-[42px] px-6 rounded-[11px] border border-[#DC2626] bg-[#DC2626] text-white text-[11px] font-extrabold shadow-[0_8px_20px_rgba(220,38,38,0.18)] hover:bg-[#B91C1C] hover:-translate-y-px transition-all">
                                <span class="material-symbols-outlined text-[17px]">delete</span>
                                Hapus Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
