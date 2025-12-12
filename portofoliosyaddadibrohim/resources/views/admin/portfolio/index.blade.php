<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(-45deg, #0A192F 0%, #1a2a4a 25%, #0f3a5f 50%, #1a2a4a 75%, #0A192F 100%);
            background-size: 400% 400%;
            animation: meshGradient 15s ease infinite;
            color: #FFFFFF;
            overflow-x: hidden;
            line-height: 1.6;
        }

        @keyframes meshGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 36px;
            font-weight: 700;
            color: #CCD6F6;
        }

        .btn {
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
            border: none;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: #64FFDA;
            color: #0A192F;
        }

        .btn-primary:hover {
            background: #52E8C7;
            transform: translateY(-3px);
        }

        .btn-danger {
            background: #FF6B6B;
            color: #FFFFFF;
            padding: 8px 16px;
            font-size: 12px;
        }

        .btn-danger:hover {
            background: #FF5252;
        }

        .btn-secondary {
            background: #112240;
            color: #64FFDA;
            border: 1px solid #64FFDA;
            padding: 8px 16px;
            font-size: 12px;
        }

        .btn-secondary:hover {
            background: #64FFDA;
            color: #0A192F;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .portfolio-card {
            background: #112240;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #1E3A5F;
            transition: all 0.3s;
        }

        .portfolio-card:hover {
            border-color: #64FFDA;
            box-shadow: 0 10px 40px rgba(100, 255, 218, 0.2);
        }

        .portfolio-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1E3A5F 0%, #112240 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64FFDA;
            font-size: 48px;
            overflow: hidden;
        }

        .portfolio-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .portfolio-info {
            padding: 20px;
        }

        .portfolio-title {
            font-size: 16px;
            font-weight: 600;
            color: #CCD6F6;
            margin-bottom: 8px;
        }

        .portfolio-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 12px;
            color: #8892B0;
        }

        .portfolio-category {
            display: inline-block;
            background: rgba(100, 255, 218, 0.1);
            color: #64FFDA;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }

        .portfolio-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .portfolio-actions .btn {
            flex: 1;
            text-align: center;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.2);
            border-left: 4px solid #4CAF50;
            color: #81C784;
        }

        .alert-error {
            background: rgba(255, 107, 107, 0.2);
            border-left: 4px solid #FF6B6B;
            color: #FF8787;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #64FFDA;
            margin-bottom: 20px;
        }

        .empty-state h2 {
            color: #CCD6F6;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #8892B0;
            margin-bottom: 30px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64FFDA;
            text-decoration: none;
            margin-bottom: 30px;
            transition: all 0.3s;
        }

        .back-link:hover {
            gap: 12px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="/" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

        <div class="header">
            <h1>Kelola Portfolio</h1>
            <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Karya
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(count($portfolios) > 0)
        <div class="portfolio-grid">
            @foreach($portfolios as $portfolio)
            <div class="portfolio-card">
                <div class="portfolio-image">
                    @if(isset($portfolio['image']) && $portfolio['image'])
                    <img src="{{ asset('uploads/portfolio/' . $portfolio['image']) }}" alt="{{ $portfolio['title'] }}">
                    @else
                    <i class="fas fa-image"></i>
                    @endif
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">{{ $portfolio['title'] }}</div>
                    <div class="portfolio-meta">
                        <span class="portfolio-category">{{ $portfolio['category'] }}</span>
                        <span>{{ $portfolio['year'] }}</span>
                    </div>
                    <div class="portfolio-actions">
                        <a href="{{ route('admin.portfolio.edit', ['id' => $portfolio['id']]) }}" class="btn btn-secondary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.portfolio.destroy', ['id' => $portfolio['id']]) }}" method="POST" style="flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Yakin ingin menghapus karya ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <h2>Belum ada karya</h2>
            <p>Mulai tambahkan karya portfolio Anda sekarang</p>
            <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Karya Pertama
            </a>
        </div>
        @endif
    </div>
</body>

</html>