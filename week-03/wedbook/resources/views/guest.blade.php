<!DOCTYPE html>
<html>
<head>
    <title>Data Tamu SITAMU</title>
</head>
<body>
    <h1>Data Tamu (Query Builder)</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Tamu</th>
            <th>Kategori</th>
            <th>QR Token</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->category }}</td>
            <td>{{ $d->qr_token }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>