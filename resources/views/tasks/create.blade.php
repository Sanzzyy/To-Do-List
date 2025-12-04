@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')
    <h1 class="text-3xl font-bold text-[#FFDBB6] mb-6">Tambah Tugas</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6 max-w-lg">
        @csrf

        <div>
            <label class="block mb-1 font-semibold text-[#F7A5A5]">Judul</label>
            <input type="text" name="title"
                class="w-full rounded border border-[#FFDBB6] bg-[#1A2A4F] text-[#FFF2EF] p-2 focus:outline-none focus:ring-2 focus:ring-[#F7A5A5]"
                required>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-[#F7A5A5]">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full rounded border border-[#FFDBB6] bg-[#1A2A4F] text-[#FFF2EF] p-2 focus:outline-none focus:ring-2 focus:ring-[#F7A5A5]"></textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit"
                class="bg-[#F7A5A5] hover:bg-[#FFDBB6] text-[#1A2A4F] px-6 py-2 rounded shadow-lg transition font-semibold">
                Simpan
            </button>
            <a href="{{ route('tasks.index') }}"
                class="px-6 py-2 rounded border border-[#FFDBB6] text-[#FFDBB6] hover:bg-[#1A2A4F] hover:text-[#FFF2EF] transition font-semibold">
                Batal
            </a>
        </div>
    </form>
@endsection
