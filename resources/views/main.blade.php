@extends('layout.style')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('content')
    <section class="p-5">
        <div class="container p-5" style="background-color: white !important; border-radius: 10px;">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-center mb-5">Data Siswa</h1>
            <div class="d-flex">
                <a class="btn btn-primary mx-2" href="{{ route('create') }}">Tambah Siswa</a>
                <form action="{{ route('download-pdf') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Download PDF</button>
                </form>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mx-2">Logout</button>
                </form>
            </div>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nisn</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tempat Lahir</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $d->nisn }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->tempat_lahir }}</td>
                            <td>{{ $d->tanggal_lahir }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>{{ $d->telepon }}</td>
                            <td class="d-flex mx-auto">
                                <a href="{{ route('edit-siswa', $d->id) }}" class="btn btn-warning mx-auto"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('delete-siswa', $d->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection