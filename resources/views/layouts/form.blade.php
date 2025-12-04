@php
    $isEdit = isset($task);
@endphp

<h3 class="text-lg font-medium mb-2">{{ $isEdit ? 'Edit Tugas' : 'Tambah Tugas' }}</h3>

<form method="POST" action="{{ $action }}" class="space-y-3">
    @if ($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif
    @csrf

    <div>
        <label class="block text-sm font-medium">Judul</label>
        <input name="title" value="{{ old('title', $task->title ?? '') }}" class="w-full border p-2 rounded" />
        @error('title')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Deskripsi</label>
        <textarea name="description" class="w-full border p-2 rounded">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="is_completed" value="1"
                {{ old('is_completed', $task->is_completed ?? false) ? 'checked' : '' }} />
            <span class="text-sm">Tandai selesai</span>
        </label>
    </div>

    <div class="flex justify-end gap-2">
        <button type="button" onclick="document.getElementById('modalRoot').classList.add('hidden')"
            class="px-3 py-1">Batal</button>
        <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:brightness-105 transition">
            {{ $isEdit ? 'Update' : 'Simpan' }}
        </button>
    </div>
</form>
