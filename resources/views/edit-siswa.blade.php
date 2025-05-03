@extends('layout.style')
@section('style')
    
@endsection
@section('content')
<section class="p-5">
    <div class="container p-5" style="background-color: white !important; border-radius: 10px;">
        <h1 class="text-center mb-5">Edit Siswa</h1>
        <form action="{{ route('update-siswa', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nisn">Nisn</label>
                <input type="text" value="{{ $siswa->nisn }}" class="form-control" id="nisn" name="nisn" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" value="{{ $siswa->nama }}" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" value="{{ $siswa->tempat_lahir }}" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" value="{{ $siswa->tanggal_lahir }}" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" value="{{ $siswa->alamat }}" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor telepon</label>
                <input type="text" value="{{ $siswa->telepon }}" class="form-control" id="telepon" name="telepon" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Edit Data</button>
        </form>
    </div>
</section>
@endsection
@section('script')