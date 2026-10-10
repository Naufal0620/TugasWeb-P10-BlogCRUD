<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 1. INDEX: Menampilkan daftar data dengan pagination dan fitur pencarian
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $posts = Post::latest()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString();

        return view('posts.index', compact('posts', 'search'));
    }

    // 2. CREATE: Menampilkan form tambah post
    public function create(): View
    {
        return view('posts.create');
    }

    // 3. STORE: Validasi form, simpan file gambar, dan create record di database
    public function store(Request $request): RedirectResponse
    {
        // Validasi input data dari form
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'image.image' => 'File yang diunggah wajib berupa format gambar!',
            'image.max' => 'Ukuran gambar maksimal 2MB!',
            'title.required' => 'Judul artikel/produk wajib diisi!',
            'description.required' => 'Deskripsi artikel wajib diisi minimal 10 karakter!',
            'price.required' => 'Harga wajib diisi dengan angka valid!',
            'stock.required' => 'Stok wajib diisi dengan bilangan bulat!',
        ]);

        // Proses unggah file gambar ke storage/app/public/posts
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        // Simpan ke database via Mass Assignment
        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Data Post berhasil disimpan ke database!');
    }

    // 4. SHOW: Menampilkan detail data menggunakan Route Model Binding
    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }

    // 5. EDIT: Menampilkan form edit dengan data terikat
    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    // 6. UPDATE: Validasi, update file gambar jika ada yang baru, lalu perbarui data di database
    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Cek jika ada unggahan gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage publik jika ada
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        // Perbarui data record
        $post->update($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Data Post berhasil diperbarui!');
    }

    // 7. DESTROY: Hapus record dari database dan file gambar terkait
    public function destroy(Post $post): RedirectResponse
    {
        // Hapus file gambar jika ada
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Data Post berhasil dihapus!');
    }
}
