 <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
     <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
         <h2 class="m-0 text-primary"><i class="fa fa-star me-3"></i>Bright Star</h2>
     </a>
     
     <!-- Live Clock for Website -->
     <div class="website-clock d-none d-lg-flex align-items-center ms-3">
         <div class="clock-container">
             <div id="websiteClock" class="website-digital-clock">
                 <span id="webHours">00</span>
                 <span class="colon">:</span>
                 <span id="webMinutes">00</span>
                 <span class="colon">:</span>
                 <span id="webSeconds">00</span>
                 <span class="ampm" id="webAmpm">AM</span>
             </div>
             <div id="webDateDisplay" class="website-date-display"></div>
         </div>
     </div>
     
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

<style>
    /* Website Clock Styles */
    .website-clock {
        margin-left: 20px;
    }

    .clock-container {
        background: transparent;
        border: none;
        padding: 8px 16px;
        box-shadow: none;
    }

    .website-digital-clock {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #20c997;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    .website-digital-clock .colon {
        animation: webBlink 1s infinite;
    }

    .website-digital-clock .ampm {
        font-size: 0.7rem;
        margin-left: 6px;
        font-weight: 600;
    }

    .website-date-display {
        display: none;
    }

    @keyframes webBlink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0.3; }
    }

    @media (max-width: 992px) {
        .website-clock {
            display: none !important;
        }
    }
</style>

<script>
    // Website Clock Function
    function updateWebsiteClock() {
        const now = new Date();
        
        // Get time components
        let hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        
        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12;
        
        // Add leading zeros
        const hoursStr = hours.toString().padStart(2, '0');
        const minutesStr = minutes.toString().padStart(2, '0');
        const secondsStr = seconds.toString().padStart(2, '0');
        
        // Update clock display
        document.getElementById('webHours').textContent = hoursStr;
        document.getElementById('webMinutes').textContent = minutesStr;
        document.getElementById('webSeconds').textContent = secondsStr;
        document.getElementById('webAmpm').textContent = ampm;
        
        // Update date display
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateStr = now.toLocaleDateString('en-US', options);
        document.getElementById('webDateDisplay').textContent = dateStr;
    }
    
    // Initialize clock and update every second
    document.addEventListener('DOMContentLoaded', function() {
        updateWebsiteClock();
        setInterval(updateWebsiteClock, 1000);
    });
</script>

