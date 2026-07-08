@extends('webside.master')
@section('content')
    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($classes as $class)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ asset('images/class/' . $class->image) }}" alt="">
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">{{ $class->fees }} AFG</h3>
                                <div class="mb-3">


                                </div>
                                <h5 class="mb-4">{{ $class->class_name }}</h5>
                            </div>
                            <div class="d-flex border-top bg-light">

                                <small class="flex-fill text-center py-3"><i
                                        class="fa fa-user me-2"></i>{{ $class->capacity }}
                                    Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->
@endsection
