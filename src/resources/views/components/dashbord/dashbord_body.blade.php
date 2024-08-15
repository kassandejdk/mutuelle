@props([
  'membre'=>false
])

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
      <meta name="author" content="NobleUI">
      <meta name="keywords" content="Gestion mutuelle,ESI,Pret,Remboursement,Rapports financiers">
      <title>GestMutuelle</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('admin/assets/vendors/core/core.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/assets/css/demo2/style.css') }}">
      <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
    </head>

    <body>
      <div class="main-wrapper">
        
        
        @if ($membre)
          @include('inc.dashbord.sidebar-membre')
        @else
          @include('inc.dashbord.sidebar')
        @endif

        <div class="page-wrapper">
   
        @include('inc.dashbord.navbar');
        
        <div class="page-content">
          {{ $slot }}
        </div>
          @include('inc.dashbord.footer')
        
        </div>
      </div>
      <script src="{{ asset('admin/assets/vendors/core/core.js') }}"></script>
      {{-- <script src="{{ asset('admin/assets/vendors/core/script.js') }}"></script> --}}
      <script src="{{ asset('admin/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
      <script src="{{ asset('admin/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
      <script src="{{ asset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
      <script src="{{ asset('admin/assets/js/template.js') }}"></script>
      <script src="{{ asset('admin/assets/js/dashboard-dark.js') }}"></script>
    </body>
  </html>    