<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        // Pencarian berdasarkan judul
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->paginate(3);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $photoPath = $request->file('photo')->store('public/gallery');

        Gallery::create([
            'photo' => $photoPath,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/gallery');
            $gallery->photo = $photoPath;
        }

        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->save();

        return redirect()->route('galleries.index')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('galleries.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
