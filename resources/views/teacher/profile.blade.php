@extends('Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-gradient-primary text-white mb-4">
                <div class="card-body text-center">
                    @if($teacher->image)
                        <img src="{{ asset('images/teachers/' . $teacher->image) }}" class="img-fluid rounded-circle mb-3" style="max-height: 180px; border: 5px solid rgba(255,255,255,0.3); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                    @else
                        <img src="{{ asset('backend/assets/images/user.png') }}" class="img-fluid rounded-circle mb-3" style="max-height: 180px; border: 5px solid rgba(255,255,255,0.3); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                    @endif
                    <h3 class="card-title">{{ $teacher->first_name }} {{ $teacher->last_name }}</h3>
                    <p class="mb-2">{{ $teacher->education_degree }}</p>
                    <span class="badge bg-light text-primary">Teacher</span>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-light btn-sm mt-4"><i class="fas fa-arrow-left me-1"></i> Back to Dashboard</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-address-card me-2"></i>Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="fas fa-phone me-2 text-primary"></i>Phone:</strong>
                        <span>{{ $teacher->phone }}</span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-envelope me-2 text-primary"></i>Email:</strong>
                        <span>{{ $teacher->email ?? 'N/A' }}</span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-map-marker-alt me-2 text-primary"></i>Address:</strong>
                        <span>{{ $teacher->curent_address }}</span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-id-card me-2 text-primary"></i>NIC:</strong>
                        <span>{{ $teacher->nic }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-user me-2"></i>Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>First Name:</strong>
                                <span class="float-end">{{ $teacher->first_name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Last Name:</strong>
                                <span class="float-end">{{ $teacher->last_name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Father's Name:</strong>
                                <span class="float-end">{{ $teacher->father_name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Gender:</strong>
                                <span class="float-end">{{ $teacher->gender ? 'Male' : 'Female' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Birth Year:</strong>
                                <span class="float-end">{{ $teacher->birth_year }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-graduation-cap me-2"></i>Education Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Degree:</strong>
                                <span class="float-end">{{ $teacher->education_degree }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>University:</strong>
                                <span class="float-end">{{ $teacher->education_university }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Graduation Year:</strong>
                                <span class="float-end">{{ $teacher->education_year }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Talent Score:</strong>
                                <span class="float-end">{{ $teacher->talnet_score }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-briefcase me-2"></i>Employment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Gross Salary:</strong>
                                <span class="float-end">{{ $teacher->gross_salary }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Food Allowance:</strong>
                                <span class="float-end">{{ $teacher->food ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <strong>Registration Date:</strong>
                                <span class="float-end">{{ $teacher->reg_date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
