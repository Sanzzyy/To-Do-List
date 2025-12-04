@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-[#FFDBB6]">Daftar Tugas</h1>

        <a href="{{ route('tasks.create') }}"
            class="bg-[#F7A5A5]/80 hover:bg-gradient-to-r hover:from-[#F7A5A5]/90 hover:to-[#FFDBB6]/90
              text-[#1A2A4F] px-5 py-2 rounded-lg shadow-md border border-[#FFDBB6]/70 font-semibold
              transition duration-300 ease-in-out w-full sm:w-auto text-center">
            + Tambah Tugas
        </a>
    </div>

    @if (session('success'))
        <div
            class="bg-[#FFDBB6] bg-opacity-50 text-[#1A2A4F] p-3 rounded mb-4 shadow-inner font-semibold max-w-full overflow-auto">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 max-w-full overflow-auto">
        <form method="GET" class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
            <label for="filter" class="text-[#F7A5A5] font-semibold whitespace-nowrap">Filter:</label>
            <select name="filter" id="filter"
                class="border border-[#F7A5A5] bg-[#1A2A4F] text-[#FFF2EF] rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#FFDBB6] w-full sm:w-auto">
                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Semua</option>
                <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="completed" {{ $filter === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button
                class="bg-[#F7A5A5] hover:bg-[#FFDBB6] transition px-4 py-1 rounded text-[#1A2A4F] shadow-sm font-semibold w-full sm:w-auto">
                Terapkan
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($tasks as $task)
            <div
                class="p-4 rounded border border-[#FFDBB6] flex flex-col justify-between bg-[#1A2A4F] bg-opacity-60 hover:bg-opacity-80 transition-shadow shadow-sm">

                <div class="mb-4">
                    <h2
                        class="text-lg font-semibold 
                    {{ $task->is_completed ? 'line-through text-[#F7A5A5]' : 'text-[#FFF2EF]' }}">
                        {{ $task->title }}
                    </h2>

                    @if ($task->description)
                        <p class="text-[#FFDBB6] text-sm mt-1 break-words">{{ $task->description }}</p>
                    @endif
                </div>

                <div class="flex flex-wrap gap-3 justify-end">
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST"
                        class="inline-block w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto px-4 py-2 rounded font-semibold text-[#1A2A4F]
            transition duration-300 ease-in-out
            {{ $task->is_completed
                ? 'bg-[#FFDBB6] cursor-default'
                : 'bg-white hover:bg-[#FFDBB6] hover:shadow-md cursor-pointer' }}">
                            {{ $task->is_completed ? 'Selesai' : 'Pending' }}
                        </button>

                    </form>

                    <a href="{{ route('tasks.edit', $task->id) }}"
                        class="w-full sm:w-auto px-4 py-2 rounded shadow-sm font-semibold text-[#1A2A4F]
               bg-[#F7A5A5] hover:bg-[#FFDBB6] transition duration-300 ease-in-out
               cursor-pointer focus:ring-4 focus:ring-[#FFDBB6]/50 text-center">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                        class="inline-block w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                            class="w-full sm:w-auto px-4 py-2 rounded shadow-sm font-semibold text-[#1A2A4F]
                   bg-[#F7A5A5] hover:bg-[#FFDBB6] transition duration-300 ease-in-out
                   cursor-pointer focus:ring-4 focus:ring-[#FFDBB6]/50">
                            Hapus
                        </button>
                    </form>
                </div>


            </div>
        @empty
            <p class="text-[#F7A5A5] text-center col-span-full">Belum ada tugas.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
@endsection
