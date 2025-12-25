<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Error - Sumedang Creative Center')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .error-card {
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .gradient-red {
            background: linear-gradient(135deg, #DC2626 0%, #7F1D1D 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        @yield('content')
        
        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">
                © {{ date('Y') }} Sumedang Creative Center
            </p>
            <div class="mt-4">
                <a href="{{ route('home') }}" 
                   class="text-red-600 hover:text-red-700 text-sm font-medium inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>