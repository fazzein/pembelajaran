<!DOCTYPE html>
<html>
<head>
    <title>Siswa Login</title>
</head>
<body>
    <form method="POST" action="{{ url('siswa/login') }}">
        @csrf
        <div>
            <label for="nis">NISN:</label>
            <input type="text" id="nis" name="nis" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
