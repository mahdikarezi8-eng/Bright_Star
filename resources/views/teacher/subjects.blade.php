@extends('Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-book me-2"></i>My Subjects</h5>
                </div>
                <div class="card-body">
                    @if($subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Name</th>
                                        <th>Author</th>
                                        <th>Classes</th>
                                        <th>Total Students</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $subject->subject_name }}</strong></td>
                                            <td>{{ $subject->authore ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $subject->classes->count() }} Classes</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $subject->classes->sum(function($class) { return $class->students->count(); }) }} Students</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>No subjects assigned yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
