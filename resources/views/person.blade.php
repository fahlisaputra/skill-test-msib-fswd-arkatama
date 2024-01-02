<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Skill Test Arkatama - Muhammad Fahli Saputra</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Data Person</h1>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb">
                {{-- form untuk menambahkan data --}}
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <input type="text" name="text" value="{{ old('text') }}" required>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </form>
            </div>
            {{-- table untuk menampilkan data --}}
            <table class="table table-bordered mb">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Umur</th>
                </tr>
                </thead>
                <tbody>
                @foreach($person as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->age }}</td>
                        <td>{{ $p->city }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <span>
                &copy; 2023 Muhammad Fahli Saputra.
            </span>
            <br>
            <small>
                Ditujukan untuk Skill Test Arkatama untuk posisi Full Stack Web Developer
            </small>
        </div>
    </div>
</div>
</body>
</html>
