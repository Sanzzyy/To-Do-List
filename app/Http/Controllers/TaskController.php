<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    // menampilkan list + filter
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // all | pending | completed

        $tasks = Task::when($filter === 'pending', fn($q) => $q->where('is_completed', false))
            ->when($filter === 'completed', fn($q) => $q->where('is_completed', true))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // jika request ajax (untuk SPA/modal) bisa kirim partial
        return view('tasks.index', compact('tasks', 'filter'));
    }

    // menyimpan task baru
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['is_completed'] = $request->has('is_completed') ? (bool)$request->is_completed : false;
        $task = Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    // menampilkan form edit (jika pake modal, mungkin return json)
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // update tugas
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $data['is_completed'] = $request->has('is_completed') ? (bool)$request->is_completed : false;
        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function create()
    {
        return view('tasks.create');
    }


    // hapus tugas
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    // toggle status via route khusus (AJAX friendly)
    public function toggle(Task $task)
    {
        $task->is_completed = ! $task->is_completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Status tugas diperbarui.');
    }
}
