@extends('webside.master')
@section('content')
    <style>
        .team-item {
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            position: relative;
        }

        .team-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 50%, #43e97b 100%);
        }

        .team-item:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(79, 172, 254, 0.25);
        }

        .team-item img {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            height: 280px;
            object-fit: cover;
            width: 100%;
        }

        .team-item:hover img {
            transform: scale(1.15);
        }

        .team-item h5 {
            color: #2c3e50;
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .team-item small {
            color: #4facfe;
            font-weight: 700;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
        }
    </style>
    <div class="container-xxl py-5 mt-n5">
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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4">

                @foreach ($teachers as $teacher)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item">
                            <div class="overflow-hidden">
                                <img src="{{ asset('images/teachers/' . $teacher->image) }}"
                                    alt="">
                            </div>
                            <div class="text-center p-4">
                                <h5 class="mb-0">{{ $teacher->first_name }} {{ $teacher->last_name }}</h5>
                                <small>Score: {{ $teacher->talent_score }}%</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
