@extends('templates.app')

@section('title', 'Edit Post - ' . $post->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <x-card title="✏️ Edit Data Post">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Gambar (Biarkan kosong jika tidak ingin mengubah)</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @if($post->image)
                        <div class="mt-2">
                            <small class="text-muted d-block mb-1">Gambar saat ini:</small>
                            <img src="{{ asset('storage/' . $post->image) }}" class="rounded shadow-sm" style="width: 120px; height: 80px; object-fit: cover;">
                        </div>
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Post</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Konten</label>
                    <textarea name="description" id="editor" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $post->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $post->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jumlah Stok</label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $post->stock) }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
                    <button type="submit" class="btn btn-success px-4"><i class="bi bi-check-circle me-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </x-card>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endpush
