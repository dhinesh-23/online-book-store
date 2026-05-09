<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $book->title }} - BookStore</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header (Same as home) -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">BookStore</span>
                </a>

                <div class="flex-1 max-w-xl">
                    <form method="GET" action="{{ route('home') }}" class="flex">
                        <div class="relative flex-1">
                            <input type="text" name="search" placeholder="Search for books, authors..." class="w-full pl-4 pr-12 py-2.5 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-indigo-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-r-lg hover:bg-indigo-700 transition">
                            Search
                        </button>
                    </form>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-indigo-600">My Account</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600">Home</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600">Books</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 font-medium truncate">{{ $book->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Product Section -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <!-- Image Section -->
            <div class="sticky top-24">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    @if($book->image)
                        <img src="{{ Storage::url('books/' . $book->image) }}" alt="{{ $book->title }}" class="w-full aspect-[3/4] object-cover" />
                    @else
                        <div class="w-full aspect-[3/4] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Details Section -->
            <div>
                <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8">
                    <!-- Title & Author -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-lg text-gray-600 mb-4">by <span class="text-indigo-600 font-medium">{{ $book->author }}</span></p>

                    <!-- Rating -->
                    <div class="flex items-center gap-2 mb-6">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-gray-500 text-sm">(12 reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-indigo-600">${{ number_format($book->price, 2) }}</span>
                        <span class="text-gray-500 ml-2">+ Free shipping</span>
                    </div>

                    <!-- Stock Status -->
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="text-green-600 font-medium">In Stock</span>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-500">15 sold</span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 mb-8">
                        <button class="flex-1 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                        <button class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-indigo-600 hover:text-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Description -->
                    <div class="border-t pt-6">
                        <h3 class="font-semibold text-gray-900 mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <!-- Product Details -->
                    <div class="border-t mt-6 pt-6">
                        <h3 class="font-semibold text-gray-900 mb-3">Product Details</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Author</span>
                                <span class="text-gray-900 font-medium">{{ $book->author }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Format</span>
                                <span class="text-gray-900 font-medium">Paperback</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Publisher</span>
                                <span class="text-gray-900 font-medium">BookStore Publications</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">ISBN</span>
                                <span class="text-gray-900 font-medium">978-3-16-148410-0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Books Section -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">You May Also Like</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @for($i = 1; $i <= 5; $i++)
                    <a href="#" class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 group overflow-hidden">
                        <div class="aspect-[2/3] bg-gray-100 relative">
                            <div class="absolute inset-0 flex items-center justify-center text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-gray-900 text-sm line-clamp-1">Similar Book {{ $i }}</h4>
                            <p class="text-indigo-600 font-semibold text-sm mt-1">${{ number_format(rand(999, 2999)/100, 2) }}</p>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>

    <!-- Footer (Same as home) -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center text-gray-400 text-sm">
                © 2024 BookStore. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>