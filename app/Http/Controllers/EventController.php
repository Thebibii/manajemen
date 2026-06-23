<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // $query = Event::query();
        $query = Event::query()->where('user_id', auth()->id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        match ($request->input('sort')) {
            'waktu_terjauh' => $query->orderBy('tanggal', 'desc'),
            'nama_az'       => $query->orderBy('nama', 'asc'),
            'nama_za'       => $query->orderBy('nama', 'desc'),
            default         => $query->orderBy('tanggal', 'asc'),
        };

        $events = $query->paginate(5)->withQueryString();

        return view('pages.panitia.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);
        $sudahDaftar = null;

        if (auth()->check() && auth()->user()->isMahasiswa()) {
            $sudahDaftar = $event->registrations()->where('user_id', auth()->id())->first();
        }

        return view('events.show', compact('event', 'sudahDaftar'));
    }

    public function create()
    {
        return view('pages.panitia.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('events', 'public');
        }


        $data['user_id'] = auth()->id();
        Event::create($data);

        return redirect()->route('panitia.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        return view('pages.panitia.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if ($event->gambar && Storage::disk('public')->exists($event->gambar)) {
                Storage::disk('public')->delete($event->gambar);
            }

            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('panitia.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();

        return redirect()->route('panitia.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
