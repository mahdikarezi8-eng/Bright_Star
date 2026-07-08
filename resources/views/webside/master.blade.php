<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="webside/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="webside/lib/animate/animate.min.css" rel="stylesheet">
    <link href="webside/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="webside/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="webside/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    @include('webside.layout.navbar')
    <!-- Navbar End -->
    @yield('content')
   
    <!-- Footer Start -->
    @include('webside.layout.footer')
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="webside/lib/wow/wow.min.js"></script>
    <script src="webside/lib/easing/easing.min.js"></script>
    <script src="webside/lib/waypoints/waypoints.min.js"></script>
    <script src="webside/lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="webside/js/main.js"></script>
</body>
</html>
