<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembagian</title>
</head>
<body>
    <h3>Matematika Sederhana</h3>
    <form action="{{ route('bagi-action') }}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="text" name="angka1" placeholder="Masukkan Angka" required>
        <br><br>
        <label for="">Angka 2</label>
        <input type="text" name="angka2" placeholder="Masukkan Angka" required>
        <br><br>
        <button>Bagikan</button>
    </form>
    <h3>Hasilnya: {{ $pembagian ?? 0 }}</h3>
</body>
</html>