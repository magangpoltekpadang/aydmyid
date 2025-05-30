
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

<body class="font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
            <div class="py-2">
            <!-- logo dan nama sistem-->
            <div class="flex items-center space-x-3 relative px-6">
                <img src="/img/hybrid-car.png" alt="Icon Cuci Mobil" class="w-12 h-16">
                <h3 class="text-lg font-bold text-gray-800">Pencucian Mobil</h3>
            </div>
            <ul class="mt-6">
                <!-- Dashboard Menu -->
                <li class="relative px-6 py-3">
                    @if (request()->is('/'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                        {{ request()->is('/') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                        hover:text-purple-600 dark:hover:text-purple-600"
                        href="/">
                        <i class="fas fa-home" role="img" aria-label="Dashboard"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>

                {{-- <li class="relative px-6 py-3">
                @if (request()->is('vehicle-type'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                        {{ request()->is('vehicle-type') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                        hover:text-purple-600 dark:hover:text-purple-600"
                    href="/vehicle-type">
                    <i class="fas fa-users" role="img" aria-label="Vehicle Type Management"></i>
                    <span class="ml-4">Customer</span>
                </a>
            </li> --}}

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('vehicle-type'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('vehicle-type') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/vehicle-type">
                        <i class="fas fa-money-bill-wave" role="img" aria-label="Vehicle Type Management"></i>
                        <span class="ml-4">Expense</span>
                    </a>
                </li> --}}

                <!-- Membership Package Menu -->
                <li class="relative px-6 py-3">
                    @if (request()->is('membership-package'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                        {{ request()->is('membership-package') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                        hover:text-purple-600 dark:hover:text-purple-600"
                        href="/membership-package">
                        <i class="fas fa-box" role="img" aria-label="Membership Package"></i>
                        <span class="ml-4">Membership Package</span>
                    </a>
                </li>

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('membership-package'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('membership-package') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/membership-package">
                        <i class="fas fa-user-check" role="img" aria-label="Membership Package"></i>
                        <span class="ml-4">Member Transaction</span>
                    </a>
                </li> --}}

                <!-- Notifications Menu -->
                <li class="relative px-6 py-3" x-data="{ isOpen: {{ request()->is('notification') || request()->is('notification-status') || request()->is('notification-type') ? 'true' : 'false' }} }">
                    <button @click="isOpen = !isOpen"
                        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 
                        {{ request()->is('notification') || request()->is('notification-status') || request()->is('notification-type') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }}
                        hover:text-purple-600 dark:hover:text-purple-600">
                        <div class="inline-flex items-center">
                            <i class="fas fa-bell" role="img" aria-label="Notification"></i>
                            <span class="ml-4">Notifications</span>
                        </div>
                        <!-- Arrow -->
                        <svg class="w-4 h-4 transition-transform duration-200 transform"
                            :class="{ 'rotate-90': isOpen }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6L14 10L6 14V6Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown submenu -->
                    <ul x-show="isOpen" x-transition class="mt-2 space-y-2 pl-6">
                        <li>
                            <a href="/notification"
                                class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 
                                {{ request()->is('notification') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-400' }} 
                                hover:text-purple-600 dark:hover:text-purple-600">
                                <i class="fas fa-bell"></i>
                                <span class="ml-2">Notification</span>
                            </a>
                        </li>
                        <li>
                            <a href="/notification-status"
                                class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 
                                {{ request()->is('notification-status') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-400' }} 
                                hover:text-purple-600 dark:hover:text-purple-600">
                                <i class="fas fa-envelope"></i>
                                <span class="ml-2">Notification Status</span>
                            </a>
                        </li>
                        <li>
                            <a href="/notification-type"
                                class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 
                                {{ request()->is('notification-type') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-400' }} 
                                hover:text-purple-600 dark:hover:text-purple-600">
                                <i class="fas fa-info-circle"></i>
                                <span class="ml-2">Notification Type</span>
                            </a>
                        </li>
                    </ul>
                </li>

            
                <!-- Outlet Menu -->
                <li class="relative px-6 py-3">
                    @if (request()->is('outlet'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                        {{ request()->is('outlet') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                        hover:text-purple-600 dark:hover:text-purple-600"
                        href="/outlet">
                        <i class="fas fa-store" role="img" aria-label="Notification Status"></i>
                        <span class="ml-4">Outlet</span>
                    </a>
                </li>

                <!-- Payments Menu -->
                <li class="relative px-6 py-3" x-data="{ isOpen: {{ request()->is('payment-method') || request()->is('payment-method') ? 'true' : 'false' }} }">
                    <button @click="isOpen = !isOpen"
                        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 
                        {{ request()->is('payment-method') || request()->is('payment-method') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }}
                        hover:text-purple-600 dark:hover:text-purple-600">
                        <div class="inline-flex items-center">
                            <i class="fas fa-credit-card" role="img" aria-label="Payment"></i>
                            <span class="ml-4">Payments</span>
                        </div>
                        <!-- Arrow -->
                        <svg class="w-4 h-4 transition-transform duration-200 transform"
                            :class="{ 'rotate-90': isOpen }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6L14 10L6 14V6Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown submenu -->
                    <ul x-show="isOpen" x-transition class="mt-2 space-y-2 pl-6">
                        <li>
                            <a href="/payment-method"
                                class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 
                                {{ request()->is('payment-method') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-400' }} 
                                hover:text-purple-600 dark:hover:text-purple-600">
                                <i class="fas fa-credit-card"></i>
                                <span class="ml-2">Payment Method</span>
                            </a>
                        </li>
                        <li>
                            <a href="/payment-status"
                                class="inline-flex items-center w-full text-sm font-medium transition-colors duration-150 
                                {{ request()->is('payment-status') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-400' }} 
                                hover:text-purple-600 dark:hover:text-purple-600">
                                <i class="fas fa-receipt"></i>
                                <span class="ml-2">Payment Status</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Role Menu -->
                <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                        {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                        hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fa fa-user" role="img" aria-label="User"></i>
                        <span class="ml-4">Role</span>
                    </a>
                </li>

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fas fa-concierge-bell" role="img" aria-label="User"></i>
                        <span class="ml-4">Service</span>
                    </a>
                </li> --}}

                <li class="relative px-6 py-3">
                    @if (request()->is('service-type'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('service-type') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/service-type">
                        <i class="fas fa-tags" role="img" aria-label="User"></i>
                        <span class="ml-4">Service Type</span>
                    </a>
                </li>

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fas fa-clock" role="img" aria-label="User"></i>
                        <span class="ml-4">Shift</span>
                    </a>
                </li> --}}

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fas fa-user-tie" role="img" aria-label="User"></i>
                        <span class="ml-4">Staff</span>
                    </a>
                </li> --}}

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fas fa-exchange-alt" role="img" aria-label="User"></i>
                        <span class="ml-4">Transaction</span>
                    </a>
                </li> --}}

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fas fa-wallet" role="img" aria-label="User"></i>
                        <span class="ml-4">Transaction Payment</span>
                    </a>
                </li> --}}

                {{-- <li class="relative px-6 py-3">
                    @if (request()->is('role'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                            {{ request()->is('role') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                            hover:text-purple-600 dark:hover:text-purple-600"
                        href="/role">
                        <i class="fas fa-clipboard-list" role="img" aria-label="User"></i>
                        <span class="ml-4">Transaction Service</span>
                    </a>
                </li> --}}

                <!-- Vehicle Type Menu -->
                <li class="relative px-6 py-3">
                    @if (request()->is('vehicle-type'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  
                        {{ request()->is('vehicle-type') ? 'text-purple-600 dark:text-purple-600' : 'text-gray-600 dark:text-gray-700' }} 
                        hover:text-purple-600 dark:hover:text-purple-600"
                        href="/vehicle-type">
                        <i class="fas fa-car" role="img" aria-label="Vehicle Type Management"></i>
                        <span class="ml-4">Vehicle Type</span>
                    </a>
                </li>
            </ul>
            <div class="px-6 my-6">
                <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create account
                    <span class="ml-2" aria-hidden="true">+</span>
                </button>
            </div>
            </div>
        </aside>

        <!-- Main content area -->
        <div class="container px-3 mx-auto grid bg-gray-100 dark:bg-gray-200">

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-5">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
