@extends('webside.master')
@section('content')
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">About</h6>
                <h1 class="mb-5">About Us</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100"
                            src="{{ asset('images/about/' . $about->image) }}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">{{ $about->title }}</h1>
                    <p class="mb-4">{{ $about->description }}.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Categories Start -->

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($classes as $class)
                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light h-100">
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                <img class="img-fluid w-100 h-100" src="{{ asset('images/class/' . $class->image) }}"
                                    alt="" style="object-fit: cover;">
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">{{ $class->fees }} AFG</h3>
                                <div class="mb-3">


                                </div>
                                <h5 class="mb-4">{{ $class->class_name }}</h5>
                            </div>
                            <div class="d-flex border-top">

                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-user text-primary me-2"></i>{{ $class->capacity }}
                                    Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($teachers as $teacher)
                    <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light h-100">
                            <div class="overflow-hidden" style="height: 250px;">
                                <img class="img-fluid w-100 h-100" src="{{ asset('images/teachers/' . $teacher->image) }}"
                                    alt="" style="object-fit: cover;">
                            </div>

                            <div class="text-center p-4">
                                <h5 class="mb-0">Name: {{ $teacher->first_name }} {{ $teacher->last_name }}</h5>
                                <small>Score: {{ $teacher->talent_score }}%</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->
    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-item text-center">
                        <img class="border rounded-circle p-2 mx-auto mb-3"
                            src="{{ asset('images/testimonial/' . $testimonial->image) }}"
                            style="width: 80px; height: 80px;">
                        <h5 class="mb-0">{{ $testimonial->name }}</h5>
                        <p>{{ $testimonial->position }}</p>
                        <div class="testimonial-text bg-light text-center p-4">
                            <p class="mb-0">{{ $testimonial->message }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
