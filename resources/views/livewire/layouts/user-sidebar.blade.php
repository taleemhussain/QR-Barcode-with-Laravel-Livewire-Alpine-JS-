<!-- Sidebar -->
<div class="bg-gray-800 text-white py-4 px-6 w-64">
    <h1 class="text-2xl font-bold mb-8">Dashboard</h1>
    <ul class="space-y-1">
        <li>
            <a href="{{ url('dashboard') }}" class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button type="submit" class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->is('add-user') ? 'bg-gray-700' : '' }}">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM9 12a3 3 0 11-6 0 3 3 0 016 0zM21 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>logout</span>
            </button>
            </form>
        </li>
    </ul>
  </div>
  