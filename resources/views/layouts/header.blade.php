<header class="bg-white shadow">
    <div class="px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600">Halo, {{ session('nama') }}</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ ucfirst(session('role')) }}</span>
        </div>
    </div>
</header>