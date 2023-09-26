
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }}</title>
    @endif
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/sass/app.scss'])
    @vite(['resources/js/app.js'])
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
 
    {{-- @vite(['resources/sass/stoshi.css']) --}}
    {{-- @vite(['resources/sass/style.css']) --}}
    @livewireStyles
    @livewireScripts
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    Dashboard
  </title>
  <style>
    /* Add your own styles here */
.dark-bg-gray{
  background-color: #e5e7eb;
}
  </style>
</head>

<body  x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
  x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
  <!-- ===== Preloader Start ===== -->
  @include('livewire.layouts.include.preloader')
  <!-- ===== Preloader End ===== -->

  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <!-- ===== Sidebar Start ===== -->
    @include('livewire.layouts.include.sidebar')
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <!-- ===== Header Start ===== -->
      @include('livewire.layouts.include.header')
      <!-- ===== Header End ===== -->

      <!-- ===== Main Content Start ===== -->
      <main>
        {{ $slot }}
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->
</body>


</html>