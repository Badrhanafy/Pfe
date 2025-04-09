@extends('layouts.master') {{-- Assuming you have a master layout --}}

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-500">You're logged in as an admin. Here's a quick overview of your admin dashboard.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Key Metrics --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold text-lg">Total Posts</h3>
                <p class="text-2xl font-bold"></p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold text-lg">Total Users</h3>
                <p class="text-2xl font-bold"></p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold text-lg">Total Comments</h3>
                <p class="text-2xl font-bold"></p>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="font-semibold text-lg mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="" class="text-blue-500">Manage Posts</a></li>
                <li><a href="" class="text-blue-500">Manage Users</a></li>
                <li><a href="" class="text-blue-500">Manage Comments</a></li>
            </ul>
        </div>

        {{-- Recent Activity --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="font-semibold text-lg mb-4">Recent Activity</h3>
            <div class="space-y-3">
                {{-- @foreach($recentPosts as $post)
                    <div class="flex items-center justify-between">
                        <p class="text-gray-700"></p>
                        <span class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                @endforeach --}}
            </div>
        </div>

        {{-- Chart or Graph --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-semibold text-lg mb-4">Activity Over Time</h3>
            <div id="graphContainer">
                <!-- Optionally include a graph (e.g., using Chart.js) -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include graph JS like Chart.js here -->
@endpush
