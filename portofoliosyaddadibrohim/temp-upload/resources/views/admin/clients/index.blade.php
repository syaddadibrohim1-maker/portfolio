<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Klien - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#071126;color:#fff;padding:24px}
        .container{max-width:900px;margin:0 auto}
        .card{background:rgba(255,255,255,0.03);padding:20px;border-radius:8px}
        .clients-grid{display:flex;gap:12px;flex-wrap:wrap}
        .client{width:120px;text-align:center}
        .client img{max-width:100%;height:70px;object-fit:contain}
        .actions{margin-top:12px}
        .btn{background:#64FFDA;color:#072;display:inline-block;padding:8px 12px;border-radius:6px;text-decoration:none}
        .danger{background:#FF6B6B}
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.portfolio.index') }}" style="color:#64FFDA;text-decoration:none">&larr; Kembali</a>
        <h1>Kelola Klien</h1>
        <div class="card">
            <a href="{{ route('admin.clients.create') }}" class="btn">Tambah Logo Klien</a>
            <div class="clients-grid" style="margin-top:16px">
                @forelse($clients as $client)
                <div class="client">
                    <img src="{{ $client['logo'] }}" alt="{{ $client['name'] }}">
                    <div style="font-size:13px;margin-top:6px">{{ $client['name'] }}</div>
                    <div class="actions">
                        <form action="{{ route('admin.clients.destroy', ['id' => $client['id']]) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn danger" onclick="return confirm('Hapus logo klien?')">Hapus</button>
                        </form>
                    </div>
                </div>
                @empty
                <p>Tidak ada klien.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>