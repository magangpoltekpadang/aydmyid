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
<body class="dark:bg-black font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200">
                Sistem Pencucian Mobil
            </a>
            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    @if(request()->is('dashboard'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
                            {{ request()->is('dashboard') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
                            hover:text-gray-800 dark:hover:text-gray-200"
                        href="/dashboard">
                        <i class="fas fa-home" role="img" aria-label="Dashboard"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    @if(request()->is('vehicle-type'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
                            {{ request()->is('vehicle-type') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
                            hover:text-gray-800 dark:hover:text-gray-200"
                        href="/vehicle-type">
                        <i class="fas fa-car" role="img" aria-label="Vehicle Type Management"></i>
                        <span class="ml-4">Vehicle Type</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    @if(request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                            {{ request()->is('role') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }} 
                            hover:text-gray-800 dark:hover:text-gray-200"
                        href="/role">
                        <i class="fa fa-user" role="img" aria-label="User"></i>
                        <span class="ml-4">Role</span>
                    </a>
                </li>
                
                <li class="relative px-6 py-3">
                    @if(request()->is('membership-package'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 
                            {{ request()->is('membership-package') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}
                            hover:text-gray-800 dark:hover:text-gray-200"
                        href="/membership-package">
                        <i class="fas fa-box" role="img" aria-label="Membership Package"></i>
                        <span class="ml-4">Membership Package</span>
                    </a>
                </li>

            </ul>
            <div class="px-6 my-6">
                <button class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Create account
                <span class="ml-2" aria-hidden="true">+</span>
                </button>
            </div>
            </div>
        </aside>

        <!-- Main content area -->
        <div class="container px-3 mx-auto grid">

        <!-- Page content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
