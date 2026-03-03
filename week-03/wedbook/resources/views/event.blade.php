<!DOCTYPE html>
<html>
<head>
    <title>Data Event SITAMU</title>
</head>
<body>
    <h1>Data Event (DB Facade)</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Mempelai</th>
            <th>Tanggal Acara</th>
            <th>Lokasi</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->groom_name }} & {{ $d->bride_name }}</td>
            <td>{{ $d->event_date }}</td>
            <td>{{ $d->location_name }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>