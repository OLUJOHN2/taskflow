<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased text-gray-900 bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar for Desktop -->
            <aside class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                    <!-- Brand Logo -->
                    <div class="flex items-center h-16 px-6 border-b border-gray-100 bg-indigo-600">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                            <span class="text-xl font-bold tracking-tight text-white">TaskFlow</span>
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('projects.*')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            My Projects
                        </x-nav-link>

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('tasks.*')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            My Tasks
                        </x-nav-link>

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('calendar.*')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Calendar
                        </x-nav-link>
                    </nav>

                    <!-- User footer profile toggle -->
                    <div class="p-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-semibold">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Container -->
            <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
                <!-- Top Navigation Bar -->
                <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 z-10">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-lg font-semibold text-gray-800">
                            @yield('header', 'Dashboard')
                        </h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications Dropdown / Icon placeholder -->
                        <button class="p-2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </button>

                        <!-- Profile Dropdown Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 w-48 mt-2 py-1 bg-white border border-gray-200 rounded-md shadow-lg" style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mx-6 mt-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-6">
                    {{ $slot ?? '' }}
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>