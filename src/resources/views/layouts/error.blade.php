<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
        <meta name="author" content="NobleUI">
        <meta name="keywords" content="Gestion mutuelle, Mutuelle, ESI">
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
            <div class="page-wrapper full-page">
                <div class="page-content d-flex align-items-center justify-content-center">
                    @yield('content')
                </div>
            </div>
        </div>
        
    </body>

</html>
