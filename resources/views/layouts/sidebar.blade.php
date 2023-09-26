<!-- Sidebar -->
<div class="bg-gray-800 text-white py-4 px-6 w-64">
    <h1 class="text-2xl font-bold mb-8">Dashboard</h1>
    <ul class="space-y-1">
        <li>
            <a href="{{ url('/dashboard') }}" class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/add-user') }}" class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->is('add-user') ? 'bg-gray-700' : '' }}">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM9 12a3 3 0 11-6 0 3 3 0 016 0zM21 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Add user</span>
            </a>
        </li>
        
        <!-- Dropdown -->
        <li>
            <a href="#" class="flex items-center py-2 px-4 rounded transition duration-200 hover:bg-gray-700 toggle-dropdown">
                <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <span>Dropdown</span>
            </a>
            <ul class="pl-4 mt-2 space-y-1 hidden">
                <li>
                    <a href="#" class="flex items-center py-2 px-4 rounded transition duration-200 hover:bg-gray-700">Dropdown Item 1</a>
                </li>
                <li>
                    <a href="#" class="flex items-center py-2 px-4 rounded transition duration-200 hover:bg-gray-700">Dropdown Item 2</a>
                </li>
                <li>
                    <a href="#" class="flex items-center py-2 px-4 rounded transition duration-200 hover:bg-gray-700">Dropdown Item 3</a>
                </li>
            </ul>
        </li>
    </ul>
  </div>
  
  <script>
    // Toggle Dropdown Menu
    const toggleDropdown = document.querySelector('.toggle-dropdown');
    const dropdownMenu = document.querySelector('.pl-4');
  
    toggleDropdown.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });
  </script>
  