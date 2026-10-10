@extends('templates.app')

@section('title', 'Daftar Post & Produk')

@section('content')
<div class="row">
    <div class="col-md-12">
        <x-card>
            <x-slot:header>
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h4 class="fw-bold mb-0">📦 Data Post & Produk</h4>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm px-3">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Data Baru
                    </a>
                </div>
            </x-slot:header>

            <!-- Form Pencarian (Bonus) -->
            <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul atau deskripsi..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
                    @if($search)
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-danger">Reset</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Gambar</th>
                            <th>Judul Post</th>
                            <th style="width: 15%">Harga</th>
                            <th style="width: 10%">Stok</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $p)
                            <tr>
                                <td class="text-center font-monospace">{{ $loop->iteration + ($posts->currentPage() - 1) * $posts->perPage() }}</td>
                                <td class="text-center">
                                    @if ($p->image)
                                        <img src="{{ asset('storage/' . $p->image) }}" class="rounded shadow-sm" style="width: 90px; height: 60px; object-fit: cover;" alt="{{ $p->title }}">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $p->title }}</td>
                                <td class="text-end font-monospace">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $p->stock < 5 ? 'bg-danger' : 'bg-success' }}">{{ $p->stock }} unit</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('posts.show', $p->id) }}" class="btn btn-sm btn-dark me-1" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('posts.edit', $p->id) }}" class="btn btn-sm btn-warning me-1 text-white" title="Edit Post"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('posts.destroy', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(event)" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <x-alert type="warning">Belum ada data post yang tersedia di sistem.</x-alert>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Dinamis -->
            <div class="mt-4 d-flex justify-content-end">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </x-card>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(event) {
    event.preventDefault();
    const form = event.target.closest('form');
    Swal.fire({
        title: 'Konfirmasi Hapus Data',
        text: "Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus Data!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endpush
