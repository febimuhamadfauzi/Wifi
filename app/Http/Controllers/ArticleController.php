<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $articles = Article::where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->paginate(3);

        return view('admin.articles.index', compact('articles', 'search'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/articles');
        }

        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($article->photo) {
                Storage::delete($article->photo);
            }
            $photoPath = $request->file('photo')->store('public/articles');
            $article->photo = $photoPath;
        }

        $article->title = $request->title;
        $article->description = $request->description;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        // Hapus foto dari storage jika ada
        if ($article->photo) {
            Storage::delete($article->photo);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
