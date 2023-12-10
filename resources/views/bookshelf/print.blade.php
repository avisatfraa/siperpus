<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <h1 class="text-center">Data Rak Buku</h1>
        <p class="text-center">Laporan Data Rak Buku Tahun {{date('Y')}}</p>
        <br/>
        <table id="table-data" class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Kode Rak Buku</th>
                    <th>Nama Rak Buku</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($bookshelves as $bookshelf)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $bookshelf->code }}</td>
                    <td>{{ $bookshelf->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
