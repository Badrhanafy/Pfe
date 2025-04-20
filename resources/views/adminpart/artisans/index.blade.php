@extends('layouts.admin')
@section('adminWorld')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <div class="min-h-screen bg-gray-50 font-sans">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-toggle" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-lg">
            <i class="fas fa-bars text-indigo-600"></i>
        </button>

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-indigo-300 to-purple-400 text-gray-900 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex items-center justify-center h-16 bg-indigo-400">
                <span class="text-xl font-bold tracking-tight">Admin Panel</span>
            </div>

            <nav class="flex-grow p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('Admindashboard') }}"
                            class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users') }}"
                            class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                            <i class="fa-solid fa-users-gear mr-3"></i> Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Artisans') }}"
                            class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                            <i class="fa-solid fa-image mr-3"></i> Manage Artisans
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('AllPosts') }}"
                            class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                            <i class="fa-solid fa-image mr-3"></i> Manage Posts
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                            <i class="fa-solid fa-comment mr-3"></i> Manage Comments
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile Footer -->
            <div class="p-4 border-t border-indigo-300 bg-indigo-100 fixed bottom-0 w-64">
                <div class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                        alt="">
                    <div>
                        <p class="text-sm font-medium truncate">{{ Auth::user()->email }}</p>
                        <p class="text-xs text-gray-600">Admin</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="md:ml-64 transition-all duration-300">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm sticky top-0">
                <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex-1 max-w-xs">
                            <div class="relative">
                                <input type="text" placeholder="Search..."
                                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <img class="h-12 w-42" src="http://127.0.0.1:8000/images/logo.png" alt="User avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Artisans Management Section -->
            <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
                <!-- Filters -->
                <div class="mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                    <div class="flex gap-3 flex-wrap">
                        <form method="GET" action="{{ route('Artisans') }}" class="flex gap-3 flex-wrap">
                            <select name="location" class="rounded-lg border border-gray-300 px-4 py-2">
                                <option value="">All Locations</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location }}"
                                        {{ request('location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="sort" class="rounded-lg border border-gray-300 px-4 py-2">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First
                                </option>
                                <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>
                                    Highest Rated</option>
                                <option value="most_experience"
                                    {{ request('sort') == 'most_experience' ? 'selected' : '' }}>Most Experience</option>
                            </select>

                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Artisans Table -->
                <div class="bg-white rounded-xl shadow overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6">Name
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6 hidden md:table-cell">
                                    Profession</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6">Location
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6">
                                    Experience</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6">Rating
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6 hidden sm:table-cell">
                                    Joined</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase sm:px-6">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($artisans->count() > 0)
                                @forelse($artisans as $artisan)
                                    <tr>
                                        <!-- Name Column -->
                                        <td class="px-4 py-4 whitespace-nowrap sm:px-6">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ $artisan->photo ? asset('storage/' . $artisan->photo) : asset('images/default-avatar.png') }}"
                                                    alt="{{ $artisan->name }}">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $artisan->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500 md:hidden">{{ $artisan->profession }}
                                                    </div>
                                                    <div class="text-sm text-gray-500 sm:hidden">{{ $artisan->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Profession Column -->
                                        <td
                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 sm:px-6 hidden md:table-cell">
                                            {{ $artisan->profession }}
                                        </td>

                                        <!-- Location Column -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 sm:px-6">
                                            <span class="md:hidden">{{ Str::limit($artisan->address, 15) }}</span>
                                            <span class="hidden md:inline">{{ $artisan->address }}</span>
                                        </td>

                                        <!-- Experience Column -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 sm:px-6">
                                            {{ $artisan->experience_years }}y
                                        </td>

                                        <!-- Rating Column -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 sm:px-6">
                                            @if ($artisan->reviews_avg_rating)
                                                <span
                                                    class="{{ $artisan->reviews_avg_rating >= 4 ? 'text-green-600' : ($artisan->reviews_avg_rating >= 2.5 ? 'text-yellow-600' : 'text-red-600') }}">
                                                    {{ number_format($artisan->reviews_avg_rating, 1) }}★
                                                </span>
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>

                                        <!-- Joined Date Column -->
                                        <td
                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 sm:px-6 hidden sm:table-cell">
                                            {{ $artisan->created_at->format('M d, Y') }}
                                        </td>

                                        <!-- Actions Column -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium sm:px-6">
                                            <div class="flex space-x-4">
                                                <button onclick="openModal()"
                                                    class="text-blue-600 hover:underline">Edit</button>

                                                <button class="text-red-600 hover:text-red-900 delete-artisan"
                                                    data-artisan-id="{{ $artisan->id }}"
                                                    data-artisan-name="{{ $artisan->name }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No artisans found
                                        </td>
                                    </tr>
                                @endforelse
                            @endif
                            
                        </tbody>
                       
                    </table>
                    @empty($artisans)
                    <p class="shadow-md text-blue-300 bg-white w-18 text-center">No artisans found yet !</p>
                    @endempty

                    <!-- Pagination -->
                    @if ($artisans->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $artisans->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Delete Confirmation Modal -->
            <div id="deleteModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Confirm Delete</h2>
                    <p class="mb-4 text-gray-600">Are you sure you want to delete <span id="artisanName"
                            class="font-bold"></span>?</p>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="closeModal()"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Artisan Modal -->
            <!-- Modal Container -->
            <div id="updateArtisanModal"
     class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-auto overflow-hidden">

        <!-- Modal Header -->
        <div class="flex justify-between items-center bg-blue-600 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Update Artisan</h2>
            <button type="button" onclick="closeUModal()" class="text-white hover:text-gray-200 w-10 h-10">&times;</button>
        </div>

        <!-- Modal Body (Landscape Layout) -->
        <form method="POST" action="{{ route('update.artisan') }}" enctype="multipart/form-data"
              class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-6 space-y-6">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $artisan->id }}">

            @if ($artisans->count() > 0)
                <!-- Image + Form Section -->
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Profile Image -->
                    <div class="md:w-1/3 flex flex-col items-center">
                        <img id="preview-img"
                             src="{{ $artisan->photo ? asset('storage/' . $artisan->photo) : asset('images/default-avatar.png') }}"
                             alt="Photo Preview"
                             class="w-32 h-32 object-cover rounded-full border-4 border-blue-200 mb-4 shadow-md">
                        <input type="file" name="photo"
                               class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                               file:rounded-full file:border-0 file:font-medium
                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    </div>

                    <!-- Inputs -->
                    <div class="md:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ $artisan->name }}"
                                   class="mt-1 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ $artisan->email }}"
                                   class="mt-1 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        </div>

                        <div>
                            <label for="profession" class="block text-sm font-semibold text-gray-700">Profession</label>
                            <input type="text" name="profession" value="{{ $artisan->profession }}"
                                   class="mt-1 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700">Location</label>
                            <input type="text" name="address" value="{{ $artisan->address }}"
                                   class="mt-1 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        </div>

                        <div class="col-span-2">
                            <label for="experience_years" class="block text-sm font-semibold text-gray-700">Experience
                                (years)</label>
                            <input type="number" name="experience_years" value="{{ $artisan->experience_years }}"
                                   class="mt-1 w-full rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeUModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Save</button>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    // Open modal
    function openModal() {
        const modal = document.getElementById('updateArtisanModal');
        modal.style.display = 'block';  // Show the modal by setting display to block
    }

    // Close modal
    function closeUModal() {
        const modal = document.getElementById('updateArtisanModal');
        modal.style.display = 'none';  // Hide the modal by setting display to none
    }

    // Optional: Update preview image when uploading
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.querySelector('input[type="file"]');
        const preview = document.getElementById('preview-img');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);  // Update preview image with selected file
            }
        });
    });
</script>

                

                    <!-- Modal Footer -->
                   

                </div>
            </div>


        </main>

    </div>


    </div>

    <script>
        const deleteButtons = document.querySelectorAll('.delete-artisan');
        const deleteModal = document.getElementById('deleteModal');
        const artisanNameSpan = document.getElementById('artisanName');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const artisanId = button.getAttribute('data-artisan-id');
                const artisanName = button.getAttribute('data-artisan-name');
                artisanNameSpan.textContent = artisanName;
                deleteForm.action =
                `/admin/artisans/${artisanId}`; // غيّر هاد المسار إلا كنتي كاتب route مختلف
                deleteModal.classList.remove('hidden');
            });
        });

        function closeModal() {
            deleteModal.classList.add('hidden');
        }
    </script>


@endsection
