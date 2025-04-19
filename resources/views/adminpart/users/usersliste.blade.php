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
    <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-indigo-300 to-purple-400 text-gray-900 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-center h-16 bg-indigo-400">
            <span class="text-xl font-bold tracking-tight">Admin Panel</span>
        </div>
        
        <nav class="flex-grow p-4 overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('Admindashboard') }}" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fa-solid fa-users-gear mr-3"></i> Manage Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('AllPosts') }}" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fa-solid fa-image mr-3"></i> Manage Posts
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-3 bg-indigo-200 hover:bg-indigo-300 rounded-lg transition-colors">
                        <i class="fa-solid fa-comment mr-3"></i> Manage Comments
                    </a>
                </li>
            </ul>
        </nav>
    
        <!-- User Profile Footer -->
        <div class="p-4 border-t border-indigo-300 bg-indigo-100 fixed bottom-0 w-64">
            <div class="flex items-center space-x-3">
                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="">
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
                            <img class="h-12 w-42" 
                                 src="http://127.0.0.1:8000/images/logo.png" 
                                 alt="User avatar">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Enhanced Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Users Management</h2>
        
            <div class="overflow-x-auto rounded-lg shadow-xl">
                <table class="min-w-full bg-white border-collapse">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-700">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-700">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-700">Password</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-700">Account Type</th>
                            <th colspan="2" class="px-6 py-4 text-left text-sm font-semibold text-indigo-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap relative">
                                <div class="relative">
                                    <input type="password" value="{{ $user->password }}" 
                                           id="password-{{ $user->id }}" 
                                           class="w-48 pl-3 pr-8 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all"
                                           readonly>
                                    <button onclick="togglePassword({{ $user->id }})" 
                                            class="absolute right-2 top-2.5 text-gray-400 hover:text-indigo-600 transition-colors">
                                        <i id="eye-icon-{{ $user->id }}" class="fas fa-eye text-sm"></i>
                                    </button>
                                </div>
                            </td>
                            <td>{{ $user->role }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <button onclick="openModal('{{ $user->id }}')" 
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg 
                                               transform transition-all duration-150 ease-in-out 
                                               hover:scale-105 active:scale-95 shadow-md">
                                               <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Enhanced Landscape Modal -->
        @foreach ($users as $user)
        <div id="modal-{{ $user->id }}" 
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 backdrop-animation">
            <div class="modal-animation bg-white rounded-xl shadow-2xl w-full max-w-2xl p-6 mx-4 
                        transform transition-all relative">
                <div class="flex justify-between items-center mb-4 border-b pb-4">
                    <h3 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-user-edit mr-2 text-indigo-600"></i>
                        Edit User: {{ $user->name }}
                    </h3>
                    <button onclick="closeModal('{{ $user->id }}')" 
                            class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form action="{{ route('profileUpdate', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <div class="relative">
                                    <input type="text" name="name" value="{{ $user->name }}" 
                                           class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 
                                                  focus:ring-indigo-500 focus:border-transparent 
                                                  transition-all placeholder-gray-400">
                                    <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <div class="relative">
                                    <input type="email" name="email" value="{{ $user->email }}" 
                                           class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 
                                                  focus:ring-indigo-500 focus:border-transparent 
                                                  transition-all placeholder-gray-400">
                                    <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                    <input type="text" name="password" value="{{ $user->password }}" 
                                           class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 
                                                  focus:ring-indigo-500 focus:border-transparent 
                                                  transition-all placeholder-gray-400">
                                    <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <div class="relative">
                                    <input type="text" name="role" value="{{ $user->role }}" 
                                           class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 
                                                  focus:ring-indigo-500 focus:border-transparent 
                                                  transition-all placeholder-gray-400">
                                    <i class="fas fa-shield-alt absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Status Section -->
                    <div class="pt-4 border-t border-gray-200">
                        <label class="block text-sm font-medium text-gray-700 mb-4">Account Status</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center space-x-3 p-4 border rounded-lg 
                                        hover:bg-indigo-50 transition-colors cursor-pointer">
                                <input type="radio" name="is_blocked" value="0" 
                                       class="h-5 w-5 text-indigo-600 focus:ring-indigo-500"
                                       {{ $user->is_blocked ? '' : 'checked' }}>
                                <div>
                                    <span class="block text-gray-700 font-medium">Active</span>
                                    <span class="block text-sm text-gray-500">User can access the system</span>
                                </div>
                            </label>
                            
                            <label class="flex items-center space-x-3 p-4 border rounded-lg 
                                        hover:bg-indigo-50 transition-colors cursor-pointer">
                                <input type="radio" name="is_blocked" value="1" 
                                       class="h-5 w-5 text-indigo-600 focus:ring-indigo-500"
                                       {{ $user->is_blocked ? 'checked' : '' }}>
                                <div>
                                    <span class="block text-gray-700 font-medium">Blocked</span>
                                    <span class="block text-sm text-gray-500">User cannot login</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <button type="button" onclick="closeModal('{{ $user->id }}')" 
                                class="px-6 py-2.5 text-gray-600 hover:text-gray-800 
                                       hover:bg-gray-100 rounded-lg transition-colors font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 
                                       rounded-lg transition-colors shadow-md hover:shadow-lg font-medium
                                       flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

        <script>
            // Toggle Password Visibility
            function togglePassword(id) {
                const input = document.getElementById(`password-${id}`);
                const icon = document.getElementById(`eye-icon-${id}`);
                
                input.type = input.type === 'password' ? 'text' : 'password';
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                
                input.parentElement.classList.add('animate-pulse');
                setTimeout(() => {
                    input.parentElement.classList.remove('animate-pulse');
                }, 200);
            }

            // Modal Handling
            function openModal(id) {
                const modal = document.getElementById(`modal-${id}`);
                modal.classList.remove('hidden');
                modal.querySelector('.modal-animation').classList.add('modal-animation');
            }

            function closeModal(id) {
                const modal = document.getElementById(`modal-${id}`);
                modal.querySelector('.modal-animation').classList.remove('modal-animation');
                setTimeout(() => modal.classList.add('hidden'), 150);
            }
        </script>

        <style>
            @keyframes modalEntry {
                0% { opacity: 0; transform: translateY(-20px) scale(0.95); }
                100% { opacity: 1; transform: translateY(0) scale(1); }
            }
            @keyframes backdropFade {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            .modal-animation { animation: modalEntry 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            .backdrop-animation { animation: backdropFade 0.2s ease-out; }
        </style>
    </main>
</div>
@endsection