<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>