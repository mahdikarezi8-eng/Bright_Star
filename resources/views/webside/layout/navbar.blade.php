 <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
     <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
         <h2 class="m-0 text-primary"><i class="fa fa-star me-3"></i>Bright Star</h2>
     </a>
     <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
         <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav ms-auto p-4 p-lg-0">
             <a href="{{ route('home_page') }}" class="nav-item nav-link active">Home</a>
             <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
             <a href="{{ route('course') }}" class="nav-item nav-link">Courses</a>
             <a href="{{ route('testimonial') }}" class="nav-item nav-link">Testimonial</a>
             {{-- <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                 <div class="dropdown-menu fade-down m-0">
                     <a href="team.html" class="dropdown-item">Our Team</a>
                     <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                     <a href="404.html" class="dropdown-item">404 Page</a>
                 </div>
             </div> --}}
             <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
         </div>
         @if (auth()->check())
             <a href="{{ route('dashboard') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Dashboard<i
                     class="fa fa-arrow-right ms-3"></i></a>
         @else
             <a href="{{ route('login') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Login<i
                     class="fa fa-arrow-right ms-3"></i></a>
         @endif
     </div>
 </nav>
 <!-- Carousel Start -->
 <div class="container-fluid p-0 mb-5">
     <div class="owl-carousel header-carousel position-relative">
         <div class="owl-carousel-item position-relative">
             <img class="img-fluid" src="webside/img/carousel-1.jpeg" alt="">
             <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                 style="background: rgba(24, 29, 56, .7);">
                 <div class="container">
                     <div class="row justify-content-start">
                         <div class="col-sm-10 col-lg-8">
                             <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best English Courses
                             </h5>
                             <h1 class="display-3 text-white animated slideInDown">The Best Course For Learning English
                             </h1>
                             <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                 stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                 eirmod elitr.</p>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         {{-- <div class="owl-carousel-item position-relative">
             <img class="img-fluid" src="webside/img/carousel-2.jpg" alt="">
             <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                 style="background: rgba(24, 29, 56, .7);">
                 <div class="container">
                     <div class="row justify-content-start">
                         <div class="col-sm-10 col-lg-8">
                             <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best English Course
                             </h5>
                             <h1 class="display-3 text-white animated slideInDown">Get Best Educated Here.
                             </h1>
                             <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                 stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                 eirmod elitr.</p>

                         </div>
                     </div>
                 </div>
             </div>
         </div> --}}
     </div>
 </div>
 <!-- Carousel End -->
