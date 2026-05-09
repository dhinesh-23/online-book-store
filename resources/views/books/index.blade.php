<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
            <a href="{{ route('admin.books.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                + Add Book
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Search & Sort Form -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <form method="GET" action="{{ route('admin.books.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <x-text-input id="search" class="w-full" type="text" name="search" value="{{ request()->query('search') }}" placeholder="Search by title or author..." />
                    </div>
                    <input type="hidden" name="sort" value="{{ request()->query('sort', 'created_at') }}">
                    <input type="hidden" name="direction" value="{{ request()->query('direction', 'desc') }}">
                    <x-primary-button class="whitespace-nowrap">Search</x-primary-button>
                </form>
            </div>

            <!-- Sort Options -->
            <div class="bg-white rounded-lg shadow-sm p-3 mb-6 flex flex-wrap gap-2 items-center">
                <span class="text-sm text-gray-600 mr-2">Sort by:</span>
                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="px-3 py-1 text-sm rounded {{ request()->query('sort') == 'title' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Title {{ request()->query('sort') == 'title' ? (request()->query('direction') == 'asc' ? '↑' : '↓') : '' }}
                </a>
                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'author', 'direction' => request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="px-3 py-1 text-sm rounded {{ request()->query('sort') == 'author' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Author {{ request()->query('sort') == 'author' ? (request()->query('direction') == 'asc' ? '↑' : '↓') : '' }}
                </a>
                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'price', 'direction' => request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="px-3 py-1 text-sm rounded {{ request()->query('sort') == 'price' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Price {{ request()->query('sort') == 'price' ? (request()->query('direction') == 'asc' ? '↑' : '↓') : '' }}
                </a>
                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => 'desc'])) }}" class="px-3 py-1 text-sm rounded {{ request()->query('sort') == 'created_at' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Newest {{ request()->query('sort') == 'created_at' ? (request()->query('direction') == 'asc' ? '↑' : '↓') : '' }}
                </a>
            </div>

            <!-- Table (Hidden on mobile) -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden hidden md:block">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">
                                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => request()->query('sort') == 'title' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center gap-1 hover:text-indigo-600">
                                    Title @if(request()->query('sort') == 'title'){{ request()->query('direction') == 'asc' ? '↑' : '↓' }}@endif
                                </a>
                            </th>
                            <th class="px-4 py-3">
                                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'author', 'direction' => request()->query('sort') == 'author' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center gap-1 hover:text-indigo-600">
                                    Author @if(request()->query('sort') == 'author'){{ request()->query('direction') == 'asc' ? '↑' : '↓' }}@endif
                                </a>
                            </th>
                            <th class="px-4 py-3">
                                <a href="{{ route('admin.books.index', array_merge(request()->query(), ['sort' => 'price', 'direction' => request()->query('sort') == 'price' && request()->query('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center gap-1 hover:text-indigo-600">
                                    Price @if(request()->query('sort') == 'price'){{ request()->query('direction') == 'asc' ? '↑' : '↓' }}@endif
                                </a>
                            </th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    @if ($book->image)
                                        <img src="{{ Storage::url('books/' . $book->image) }}" alt="{{ $book->title }}" class="w-14 h-20 object-cover object-top rounded" />
                                    @else
                                        <div class="w-14 h-20 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $book->title }}</td>
                                <td class="px-4 py-3">{{ $book->author }}</td>
                                <td class="px-4 py-3">${{ number_format($book->price, 2) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">No books found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4">
                @forelse ($books as $book)
                    <div class="bg-white rounded-lg shadow-sm p-4 flex gap-4">
                        <div class="shrink-0">
                            @if ($book->image)
                                <img src="{{ Storage::url('books/' . $book->image) }}" alt="{{ $book->title }}" class="w-16 h-22 object-cover object-top rounded" />
                            @else
                                <div class="w-16 h-22 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium text-gray-900 truncate">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $book->author }}</p>
                            <p class="text-sm font-semibold text-gray-800 mt-1">${{ number_format($book->price, 2) }}</p>
                            <div class="flex gap-3 mt-2">
                                <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">
                        No books found.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>