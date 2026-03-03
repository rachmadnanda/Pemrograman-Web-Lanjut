<!DOCTYPE html>
<html>
<head>
    <title>Data User SITAMU</title>
</head>
<body>
    <h1>Data User (Eloquent ORM)</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->email }}</td>
            <td>{{ $d->role }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>