<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BookStore') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-teal-600 text-white text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <span>📦 Free Shipping on Orders Over $50</span>
            <div class="flex gap-4">
                <a href="#" class="hover:text-teal-200">Help</a>
                <a href="#" class="hover:text-teal-200">Track Order</a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <div class="w-10 h-10 bg-teal-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">BookStore</span>
                </a>

                <!-- Search -->
                <div class="flex-1 max-w-2xl">
                    <form method="GET" action="{{ route('home') }}" class="flex">
                        <div class="relative flex-1">
                            <input type="text" name="search" value="{{ request()->query('search') }}" 
                                   placeholder="Search for books, authors..." 
                                   class="w-full pl-4 pr-12 py-2.5 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" />
                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-teal-600 text-white font-medium rounded-r-lg hover:bg-teal-700 transition">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-teal-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="hidden sm:inline">My Account</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-teal-600">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Categories Nav -->
        <div class="border-t">
            <div class="max-w-7xl mx-auto px-4">
                <nav class="flex gap-8 py-3 overflow-x-auto">
                    <a href="{{ route('home') }}" class="text-teal-600 font-medium whitespace-nowrap border-b-2 border-teal-600 pb-1">All Books</a>
                    <a href="{{ route('home', ['sort' => 'created_at', 'direction' => 'desc']) }}" class="text-gray-600 hover:text-teal-600 whitespace-nowrap">New Arrivals</a>
                    <a href="{{ route('home', ['sort' => 'price', 'direction' => 'asc']) }}" class="text-gray-600 hover:text-teal-600 whitespace-nowrap">Best Sellers</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 whitespace-nowrap">Fiction</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 whitespace-nowrap">Non-Fiction</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 whitespace-nowrap">Science</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Banner -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 md:py-24">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Discover Your Next Favorite Book</h1>
                <p class="text-lg md:text-xl mb-6 text-teal-100">Explore our vast collection of books from classic literature to modern bestsellers. Free shipping on orders over $50!</p>
                <div class="flex gap-4">
                    <a href="#books" class="px-6 py-3 bg-white text-teal-600 font-semibold rounded-lg hover:bg-teal-50 transition">
                        Shop Now
                    </a>
                    <a href="#" class="px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8" id="books">
        <!-- Page Title -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">All Books</h2>
                <p class="text-gray-500">{{ $books->total() }} books available</p>
            </div>
            
            <!-- Sort Dropdown -->
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600">Sort by:</span>
                <select onchange="window.location.href=this.value" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    <option value="{{ route('home', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => 'desc'])) }}" {{ (request()->query('sort') == 'created_at' || !request()->query('sort')) ? 'selected' : '' }}>Newest First</option>
                    <option value="{{ route('home', array_merge(request()->query(), ['sort' => 'price', 'direction' => 'asc'])) }}" {{ request()->query('sort') == 'price' && request()->query('direction') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ route('home', array_merge(request()->query(), ['sort' => 'price', 'direction' => 'desc'])) }}" {{ request()->query('sort') == 'price' && request()->query('direction') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="{{ route('home', array_merge(request()->query(), ['sort' => 'title', 'direction' => 'asc'])) }}" {{ request()->query('sort') == 'title' ? 'selected' : '' }}>Title: A-Z</option>
                    <option value="{{ route('home', array_merge(request()->query(), ['sort' => 'author', 'direction' => 'asc'])) }}" {{ request()->query('sort') == 'author' ? 'selected' : '' }}>Author: A-Z</option>
                </select>
            </div>
        </div>

        <!-- Active Filters -->
        @if(request()->query('search'))
            <div class="mb-4 flex items-center gap-2">
                <span class="text-sm text-gray-600">Search results for:</span>
                <span class="px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm font-medium">
                    "{{ request()->query('search') }}"
                    <a href="{{ route('home', array_diff_key(request()->query(), ['search' => ''])) }}" class="ml-2 text-teal-500 hover:text-teal-700">×</a>
                </span>
            </div>
        @endif

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach($books as $book)
                    <a href="{{ route('books.show', $book) }}" class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 group overflow-hidden">
                        <!-- Image -->
                        <div class="relative aspect-[2/3] overflow-hidden bg-gray-100">
                            @if($book->image)
                                <img src="{{ Storage::url('books/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300" />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-10 h-10 md:w-12 md:h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <!-- Quick View Button -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="px-4 py-2 bg-white text-gray-900 rounded-lg font-medium text-sm">Quick View</span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 line-clamp-2 mb-1 group-hover:text-teal-600 transition-colors">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-500 mb-2">{{ $book->author }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-teal-600">${{ number_format($book->price, 2) }}</span>
                                <span class="text-xs text-green-600 font-medium">In Stock</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $books->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No books found</h3>
                <p class="text-gray-500 mb-4">Try adjusting your search or browse our categories</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                    View All Books
                </a>
            </div>
        @endif
    </main>

    <!-- Features Section -->
    <div class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4 0 2 2 0 010 4 0zM5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m0 0a2 2 0 110-4 0 2 2 0 010 4 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Free Shipping</h4>
                    <p class="text-sm text-gray-500">On orders over $50</p>
                </div>
                <div class="text-center">
                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Secure Payment</h4>
                    <p class="text-sm text-gray-500">100% secure checkout</p>
                </div>
                <div class="text-center">
                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0a8.003 8.003 0 004.356 1.857M7 20H2v-2c0-.656-.126-1.283-.356-1.857M7 20H16m10 0v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Easy Returns</h4>
                    <p class="text-sm text-gray-500">30-day return policy</p>
                </div>
                <div class="text-center">
                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">24/7 Support</h4>
                    <p class="text-sm text-gray-500">Dedicated support</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-teal-600 rounded-lg flex items-center justify-center">
<svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">BookStore</span>
                    </div>
                    <p class="text-gray-400 text-sm">Your destination for quality books at great prices.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white">Returns</a></li>
                        <li><a href="#" class="hover:text-white">Order Status</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-3">Subscribe for exclusive offers</p>
                    <div class="flex">
                        <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg text-white text-sm focus:outline-none focus:border-teal-500" />
                        <button class="px-4 py-2 bg-teal-600 rounded-r-lg hover:bg-teal-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                © 2024 BookStore. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>