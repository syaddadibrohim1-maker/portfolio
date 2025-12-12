<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($portfolio) ? 'Edit' : 'Tambah' }} Portfolio</title>
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
            min-height: 100vh;
            padding: 40px 20px;
        }

        @keyframes meshGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
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

        .form-card {
            background: rgba(17, 34, 64, 0.6);
            border: 1px solid #1E3A5F;
            border-radius: 8px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        .form-title {
            font-size: 32px;
            font-weight: 700;
            color: #CCD6F6;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            color: #CCD6F6;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            letter-spacing: 0.3px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #1E3A5F;
            border-radius: 6px;
            background: #0A192F;
            color: #FFFFFF;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #64FFDA;
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 32px;
            border: 2px dashed #1E3A5F;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(100, 255, 218, 0.05);
        }

        .file-upload input[type="file"]:hover + .file-upload-label {
            border-color: #64FFDA;
            background: rgba(100, 255, 218, 0.1);
        }

        .file-upload-label i {
            font-size: 24px;
            color: #64FFDA;
        }

        .file-upload-text {
            text-align: center;
        }

        .file-upload-text .label {
            color: #64FFDA;
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }

        .file-upload-text .hint {
            color: #8892B0;
            font-size: 12px;
        }

        .file-preview {
            margin-top: 16px;
            text-align: center;
        }

        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 6px;
            border: 1px solid #1E3A5F;
        }

        .file-preview-text {
            color: #8892B0;
            font-size: 12px;
            margin-top: 8px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 40px;
        }

        .btn {
            flex: 1;
            padding: 14px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
            border: none;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .btn-primary {
            background: #64FFDA;
            color: #0A192F;
        }

        .btn-primary:hover {
            background: #52E8C7;
            transform: translateY(-3px);
        }

        .btn-secondary {
            background: transparent;
            color: #64FFDA;
            border: 2px solid #64FFDA;
        }

        .btn-secondary:hover {
            background: rgba(100, 255, 218, 0.1);
        }

        .error-message {
            color: #FF6B6B;
            font-size: 12px;
            margin-top: 6px;
            display: none;
        }

        .form-group input.error,
        .form-group select.error,
        .form-group textarea.error {
            border-color: #FF6B6B;
        }

        .form-group input.error ~ .error-message,
        .form-group select.error ~ .error-message,
        .form-group textarea.error ~ .error-message {
            display: block;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 24px;
            }

            .form-title {
                font-size: 24px;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('admin.portfolio.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Portfolio
        </a>

        <div class="form-card">
            <h1 class="form-title">
                {{ isset($portfolio) ? 'Edit Karya' : 'Tambah Karya Baru' }}
            </h1>

            <form action="{{ isset($portfolio) ? route('admin.portfolio.update', ['id' => $portfolio['id']]) : route('admin.portfolio.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  id="portfolioForm">
                @csrf
                @if(isset($portfolio))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="category">Kategori *</label>
                    <select id="category" name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Poster" {{ isset($portfolio) && $portfolio['category'] === 'Poster' ? 'selected' : '' }}>Poster</option>
                        <option value="Feed Instagram" {{ isset($portfolio) && $portfolio['category'] === 'Feed Instagram' ? 'selected' : '' }}>Feed Instagram</option>
                        <option value="Logo" {{ isset($portfolio) && $portfolio['category'] === 'Logo' ? 'selected' : '' }}>Logo</option>
                        <option value="Banner" {{ isset($portfolio) && $portfolio['category'] === 'Banner' ? 'selected' : '' }}>Banner</option>
                        <option value="Branding" {{ isset($portfolio) && $portfolio['category'] === 'Branding' ? 'selected' : '' }}>Branding</option>
                        <option value="Other" {{ isset($portfolio) && $portfolio['category'] === 'Other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <span class="error-message">Kategori harus dipilih</span>
                </div>

                <div class="form-group">
                    <label>Gambar Karya {{ isset($portfolio) ? '(opsional)' : '*' }}</label>
                    <div class="file-upload">
                        <input type="file" id="image" name="image" accept="image/*" @if(!isset($portfolio)) required @endif>
                        <label for="image" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-upload-text">
                                <span class="label">Pilih atau Drag Gambar</span>
                                <span class="hint">PNG, JPG, GIF (Max 5MB)</span>
                            </div>
                        </label>
                    </div>
                    <div class="file-preview" id="previewContainer" style="display: none;">
                        <img id="previewImage" src="" alt="Preview">
                        <div class="file-preview-text" id="previewText"></div>
                    </div>
                    @if(isset($portfolio) && $portfolio['image'])
                    <div class="file-preview">
                        <img src="{{ asset('uploads/portfolio/' . $portfolio['image']) }}" alt="{{ $portfolio['title'] }}">
                        <div class="file-preview-text">Gambar saat ini</div>
                    </div>
                    @endif
                </div>

                

                <div class="form-actions">
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ isset($portfolio) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const previewText = document.getElementById('previewText');

        // Handle file input change
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewText.textContent = file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle drag and drop
        const fileUploadLabel = document.querySelector('.file-upload-label');
        fileUploadLabel.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadLabel.style.borderColor = '#64FFDA';
            fileUploadLabel.style.background = 'rgba(100, 255, 218, 0.15)';
        });

        fileUploadLabel.addEventListener('dragleave', () => {
            fileUploadLabel.style.borderColor = '#1E3A5F';
            fileUploadLabel.style.background = 'rgba(100, 255, 218, 0.05)';
        });

        fileUploadLabel.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadLabel.style.borderColor = '#1E3A5F';
            fileUploadLabel.style.background = 'rgba(100, 255, 218, 0.05)';
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                imageInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>

</html>