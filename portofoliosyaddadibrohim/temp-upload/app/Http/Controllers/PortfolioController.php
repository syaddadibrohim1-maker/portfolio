<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    private $portfolioPath = 'portfolios.json';

    private function getPortfolios()
    {
        $path = storage_path($this->portfolioPath);
        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true) ?? [];
        }
        return [];
    }

    private function savePortfolios($portfolios)
    {
        $path = storage_path($this->portfolioPath);
        file_put_contents($path, json_encode($portfolios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function getNextId()
    {
        $portfolios = $this->getPortfolios();
        if (empty($portfolios)) {
            return 1;
        }
        return max(array_column($portfolios, 'id')) + 1;
    }

    private function getProfilePhoto()
    {
        $imageDir = public_path('images');
        $photoFiles = ['foto-formal.png', 'profile.png', 'foto.png', 'ps.png'];
        
        foreach ($photoFiles as $file) {
            $filePath = $imageDir . '/' . $file;
            if (file_exists($filePath) && filesize($filePath) > 0) {
                return asset('images/' . $file);
            }
        }
        
        // Jika tidak ada file, return default
        return asset('images/ps.png');
    }

    public function index()
    {
        $portfolios = $this->getPortfolios();
        // Show newest items first (reverse array to get highest IDs first)
        $portfolios = array_reverse($portfolios);
        
        $data = [
            'name' => 'Moh Syaddad Ibrohim',
            'title' => 'Graphic Designer Specialist',
            'company' => 'Founder Philo Design',
            'tagline' => 'Wujudkan Idea Anda',
            'status' => 'Available for Freelance',
            'experience' => '3+ Years Experience',
            'email' => 'syaddadibrohim1@gmail.com',
            'phone' => '081233181095',
            'location' => 'Probolinggo, Jawa Timur',
            'photo' => $this->getProfilePhoto(),
            
            'about' => 'Halo! Saya Moh Syaddad Ibrohim, seorang Graphic Designer yang berfokus pada penciptaan visual branding yang kuat dan memorable. Sebagai Founder dari Philo Design, saya telah membantu berbagai brand dan bisnis untuk membangun identitas visual mereka melalui desain yang modern, clean, dan strategis.',
            
            'skills' => [
                [
                    'title' => 'BRANDING',
                    'description' => 'Membangun identitas visual yang konsisten dan memorable untuk brand Anda'
                ],
                [
                    'title' => 'POSTER DESIGN',
                    'description' => 'Menciptakan poster yang eye-catching dan komunikatif untuk berbagai kebutuhan'
                ],
                [
                    'title' => 'LOGO DESIGN',
                    'description' => 'Merancang logo yang unik, timeless, dan merepresentasikan nilai brand'
                ],
                [
                    'title' => 'SOCIAL MEDIA CONTENT',
                    'description' => 'Mendesain konten visual yang engaging dan optimized untuk platform digital'
                ],
            ],
            
            'tools' => [
                ['name' => 'Adobe Photoshop', 'description' => 'Photo editing & digital imaging', 'logo' => asset('assets/photoshop-logo.svg')],
                ['name' => 'Adobe InDesign', 'description' => 'Layout design & publication', 'logo' => asset('assets/indesign-logo.svg')],
                ['name' => 'CorelDraw', 'description' => 'Vector illustration & design', 'logo' => asset('assets/coreldraw-logo.svg')],
                ['name' => 'Canva', 'description' => 'Social media & graphic design', 'logo' => asset('assets/canva-logo.svg')],
            ],
            
            'portfolios' => array_slice($portfolios, 0, 6),
            
            'social' => [
                'facebook' => 'https://facebook.com/syaddadibrohim',
                'instagram' => 'https://instagram.com/syaddaddd',
                'behance' => 'https://behance.net/syaddadibrohim',
                'pinterest' => 'https://pinterest.com/syaddadibrohim',
            ]
            ,
            'clients' => $this->getClients()
        ];
        
        return view('portfolio', $data);
    }
    
    public function allPortfolio()
    {
        $portfolios = $this->getPortfolios();
        
        $data = [
            'name' => 'Moh Syaddad Ibrohim',
            'title' => 'Graphic Designer Specialist',
            'company' => 'Founder Philo Design',
            'email' => 'syaddadibrohim1@gmail.com',
            'phone' => '081233181095',
            'location' => 'Probolinggo, Jawa Timur',
            
            'portfolios' => $portfolios,
            'clients' => $this->getClients()
        ];
        
        return view('portfolio-all', $data);
    }

    private function getClients()
    {
        $path = storage_path('clients.json');
        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true) ?? [];
        }
        return [];
    }

    private function saveClients($clients)
    {
        $path = storage_path('clients.json');
        file_put_contents($path, json_encode($clients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function adminIndex()
    {
        $portfolios = $this->getPortfolios();
        
        return view('admin.portfolio.index', [
            'portfolios' => $portfolios
        ]);
    }

    public function create()
    {
        return view('admin.portfolio.form');
    }

    // Admin Clients
    public function adminClientsIndex()
    {
        $clients = $this->getClients();
        return view('admin.clients.index', ['clients' => $clients]);
    }

    public function createClient()
    {
        return view('admin.clients.form');
    }

    public function storeClient(Request $request)
    {
        $request->validate([
            'client_name' => 'nullable|string|max:255',
            'client_logo' => 'required|image|max:5120'
        ]);

        $cfile = $request->file('client_logo');
        $cname = time() . '_' . $cfile->getClientOriginalName();
        $dir = public_path('uploads/clients');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        $cfile->move($dir, $cname);

        $clients = $this->getClients();
        $clients[] = [
            'id' => (count($clients) ? (max(array_column($clients, 'id')) + 1) : 1),
            'name' => $request->input('client_name') ?? '',
            'logo' => asset('uploads/clients/' . $cname)
        ];
        $this->saveClients($clients);

        return redirect()->route('admin.clients.index')->with('success', 'Logo klien berhasil ditambahkan');
    }

    public function destroyClient($id)
    {
        $clients = $this->getClients();
        $deleted = false;
        foreach ($clients as $key => $c) {
            if ($c['id'] == $id) {
                // delete file if local
                if (!empty($c['logo'])) {
                    $path = str_replace(asset(''), '', $c['logo']);
                    $local = public_path(ltrim($path, '/'));
                    if (file_exists($local)) {
                        @unlink($local);
                    }
                }
                unset($clients[$key]);
                $deleted = true;
                break;
            }
        }
        if ($deleted) {
            $this->saveClients(array_values($clients));
            return redirect()->route('admin.clients.index')->with('success', 'Logo klien dihapus');
        }
        return redirect()->route('admin.clients.index')->with('error', 'Klien tidak ditemukan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'image' => 'required|image|max:5120'
        ]);

        $portfolios = $this->getPortfolios();

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // if file larger than 2MB, compress/convert before saving
            if ($file->getSize() > 2 * 1024 * 1024) {
                $imageName = $this->processAndSaveImage($file);
            } else {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/portfolio'), $imageName);
            }
        }

        $portfolio = [
            'id' => $this->getNextId(),
            'title' => $request->title ?? ($imageName ? pathinfo($imageName, PATHINFO_FILENAME) : 'Untitled'),
            'category' => $request->category,
            'year' => $request->year ?? date('Y'),
            'description' => $request->description ?? '',
            'image' => $imageName
        ];

        $portfolios[] = $portfolio;
        $this->savePortfolios($portfolios);
        

        return redirect()->route('admin.portfolio.index')->with('success', 'Karya berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $portfolios = $this->getPortfolios();
        $portfolio = null;

        foreach ($portfolios as $item) {
            if ($item['id'] == $id) {
                $portfolio = $item;
                break;
            }
        }

        if (!$portfolio) {
            return redirect()->route('admin.portfolio.index')->with('error', 'Karya tidak ditemukan');
        }

        return view('admin.portfolio.form', [
            'portfolio' => $portfolio
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string',
            'image' => 'nullable|image|max:5120'
        ]);

        $portfolios = $this->getPortfolios();
        $updated = false;

        foreach ($portfolios as &$item) {
            if ($item['id'] == $id) {
                if ($request->filled('title')) {
                    $item['title'] = $request->title;
                }
                $item['category'] = $request->category;
                if ($request->filled('year')) {
                    $item['year'] = $request->year;
                }
                if ($request->filled('description')) {
                    $item['description'] = $request->description;
                }

                // Handle image upload if provided
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    if ($file->getSize() > 2 * 1024 * 1024) {
                        $imageName = $this->processAndSaveImage($file);
                    } else {
                        $imageName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/portfolio'), $imageName);
                    }
                    // Delete old image
                    if (!empty($item['image']) && file_exists(public_path('uploads/portfolio/' . $item['image']))) {
                        @unlink(public_path('uploads/portfolio/' . $item['image']));
                    }
                    $item['image'] = $imageName;
                }

                $updated = true;
                break;
            }
        }

        if ($updated) {
            $this->savePortfolios($portfolios);
            return redirect()->route('admin.portfolio.index')->with('success', 'Karya berhasil diperbarui!');
        }

        return redirect()->route('admin.portfolio.index')->with('error', 'Karya tidak ditemukan');
    }

    public function destroy($id)
    {
        $portfolios = $this->getPortfolios();
        $deleted = false;

        foreach ($portfolios as $key => $item) {
            if ($item['id'] == $id) {
                // Delete image file
                if ($item['image'] && file_exists(public_path('uploads/portfolio/' . $item['image']))) {
                    unlink(public_path('uploads/portfolio/' . $item['image']));
                }

                unset($portfolios[$key]);
                $deleted = true;
                break;
            }
        }

        if ($deleted) {
            $this->savePortfolios(array_values($portfolios));
            return redirect()->route('admin.portfolio.index')->with('success', 'Karya berhasil dihapus!');
        }

        return redirect()->route('admin.portfolio.index')->with('error', 'Karya tidak ditemukan');
    }
    
    public function downloadCV()
    {
        // Path ke file CV di folder public
        $file = public_path('downloads/CV-Syaddad-Ibrohim.pdf');
        
        if (file_exists($file)) {
            return response()->download($file);
        }
        
        return back()->with('error', 'File CV tidak ditemukan');
    }
    
    public function downloadPortfolio()
    {
        // Path ke file Portfolio di folder public
        $file = public_path('downloads/Portfolio-Syaddad-Ibrohim.pdf');
        
        if (file_exists($file)) {
            return response()->download($file);
        }
        
        return back()->with('error', 'File Portfolio tidak ditemukan');
    }

    /**
     * Process (optionally resize/convert) an uploaded image and save as jpg compressed file.
     * Returns the saved filename or null on failure.
     */
    private function processAndSaveImage($file)
    {
        try {
            $imgData = file_get_contents($file->getRealPath());
            $src = @imagecreatefromstring($imgData);
            if (!$src) {
                // fallback: move original file
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/portfolio'), $name);
                return $name;
            }

            $width = imagesx($src);
            $height = imagesy($src);

            $maxWidth = 2000;
            if ($width > $maxWidth) {
                $ratio = $height / $width;
                $newWidth = $maxWidth;
                $newHeight = (int) round($newWidth * $ratio);
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }

            $dst = imagecreatetruecolor($newWidth, $newHeight);
            // preserve transparency for PNG/GIF by filling background white
            $white = imagecolorallocate($dst, 255, 255, 255);
            imagefill($dst, 0, 0, $white);

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // ensure uploads dir
            $dir = public_path('uploads/portfolio');
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }

            $savedName = time() . '_' . uniqid() . '.jpg';
            $savedPath = $dir . DIRECTORY_SEPARATOR . $savedName;

            // save as JPEG with iterative quality/dimension reduction until <= 2MB
            $targetBytes = 2 * 1024 * 1024; // 2MB
            $quality = 85;
            imagejpeg($dst, $savedPath, $quality);

            $currentSize = filesize($savedPath);

            // If file still too large, reduce quality first, then downscale if needed
            while ($currentSize > $targetBytes && $quality >= 30) {
                $quality -= 5;
                imagejpeg($dst, $savedPath, $quality);
                clearstatcache(true, $savedPath);
                $currentSize = filesize($savedPath);
            }

            // If still too large, progressively downscale dimensions and retry
            $minWidth = 500;
            while ($currentSize > $targetBytes && $newWidth > $minWidth) {
                $newWidth = (int) max($minWidth, round($newWidth * 0.85));
                $newHeight = (int) round($newWidth * ($height / $width));

                $resized = imagecreatetruecolor($newWidth, $newHeight);
                $white = imagecolorallocate($resized, 255, 255, 255);
                imagefill($resized, 0, 0, $white);
                imagecopyresampled($resized, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                // try saving with moderate quality and reduce if needed
                $quality = 80;
                imagejpeg($resized, $savedPath, $quality);
                imagedestroy($resized);

                clearstatcache(true, $savedPath);
                $currentSize = filesize($savedPath);

                while ($currentSize > $targetBytes && $quality >= 30) {
                    $quality -= 5;
                    // recreate smaller image at same dimensions to avoid reusing old resource
                    $resized2 = imagecreatetruecolor($newWidth, $newHeight);
                    $white2 = imagecolorallocate($resized2, 255, 255, 255);
                    imagefill($resized2, 0, 0, $white2);
                    imagecopyresampled($resized2, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($resized2, $savedPath, $quality);
                    imagedestroy($resized2);
                    clearstatcache(true, $savedPath);
                    $currentSize = filesize($savedPath);
                }
            }

            imagedestroy($src);
            imagedestroy($dst);

            return $savedName;
        } catch (\Exception $e) {
            return null;
        }
    }
}