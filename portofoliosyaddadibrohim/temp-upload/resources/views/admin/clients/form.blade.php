<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tambah Klien</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#071126;color:#fff;padding:24px}
        .container{max-width:700px;margin:0 auto}
        .card{background:rgba(255,255,255,0.03);padding:20px;border-radius:8px}
        .form-group{margin-bottom:12px}
        input[type=text], input[type=file]{width:100%;padding:8px;border-radius:6px;border:1px solid rgba(255,255,255,0.06);background:transparent;color:#fff}
        .btn{background:#64FFDA;color:#072;display:inline-block;padding:8px 12px;border-radius:6px;text-decoration:none}
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.clients.index') }}" style="color:#64FFDA;text-decoration:none">&larr; Kembali</a>
        <h1>Tambah Klien</h1>
        <div class="card">
            <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Klien</label>
                    <input type="text" name="client_name" placeholder="Nama klien">
                </div>
                <div class="form-group">
                    <label>Logo Klien *</label>
                    <input type="file" name="client_logo" accept="image/*" required>
                </div>
                <button class="btn">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>