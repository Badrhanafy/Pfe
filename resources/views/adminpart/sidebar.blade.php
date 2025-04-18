{{-- Sidebar --}}
<div class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white overflow-y-auto">
    <div class="flex items-center justify-center h-20">
        <h1 class="text-2xl font-bold">Admin Panel</h1>
    </div>
    <nav class="mt-10">
        <ul>
            <li class="mb-4">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                    <i class="fas fa-tachometer-alt mr-4"></i>
                    Dashboard
                </a>
            </li>
            <li class="mb-4">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                    <i class="fas fa-file-alt mr-4"></i>
                    Manage Posts
                </a>
            </li>
            <li class="mb-4">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                    <i class="fas fa-users mr-4"></i>
                    Manage Users
                </a>
            </li>
            <li class="mb-4">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                    <i class="fas fa-comments mr-4"></i>
                    Manage Comments
                </a>
            </li>
            <li class="mb-4">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                    <i class="fas fa-cog mr-4"></i>
                    Settings
                </a>
            </li>
            <li class="mb-4">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-4"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>