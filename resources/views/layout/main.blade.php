<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white shadow-lg">
            <div class="p-4 border-b border-blue-700">
                <h1 class="text-xl font-bold">Sistem Pencucian Mobil</h1>
            </div>

            <nav class="mt-4">
                <div class="px-4 py-2 text-sm font-medium text-blue-200">MENU</div>

                <a href="" class="block px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 flex items-center">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>

                <a href="{{ route('VehicleType.index') }}" class="block px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 flex items-center" {{ request()->routeIs('VehicleType.*') ? 'bg-blue-100 font-semibold' : '' }}>
                    <i class="fas fa-car mr-2"></i> Vehicle Types
                </a>
            </nav>
        </div>

        <!-- Main content area -->
    <div class="flex-1 flex flex-col ">

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

    </div>
</body>
</html>
