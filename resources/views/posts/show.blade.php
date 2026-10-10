@extends('templates.app')

@section('title', 'Detail Post - ' . $post->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <x-card title="🔍 Detail Post / Produk">
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded shadow" alt="{{ $post->title }}">
                    @else
                        <div class="bg-light p-5 border rounded text-muted">Tidak Ada Gambar</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3 class="fw-bold text-slate-900">{{ $post->title }}</h3>
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6 font-monospace me-2">Rp {{ number_format($post->price, 0, ',', '.') }}</span>
                        <span class="badge bg-success fs-6">Stok: {{ $post->stock }} unit</span>
                    </div>
                    <hr>
                    <div class="post-content text-slate-700 lh-lg mb-4">
                        {!! $post->description !!}
                    </div>
                    <div class="text-muted small mb-4">
                        <p class="mb-1"><i class="bi bi-clock me-1"></i> Dibuat: {{ $post->created_at->format('d M Y, H:i') }} WIB</p>
                        <p class="mb-0"><i class="bi bi-pencil-square me-1"></i> Terakhir Diperbarui: {{ $post->updated_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali ke Daftar</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil"></i> Edit Post</a>
                </div>
            </div>
        </x-card>
    </div>
</div>
@endsection
