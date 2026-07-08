@extends('Admin.master')

@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">

            <h4 class="card-title">Update Employee User Account</h4>
            <form class="form-sample" action="{{ route('emp_user_update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Name & Email --}}
                <div class="row">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label">
                                Name
                            </label>

                            <div class="col-sm-9">

                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $user->name) }}">

                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label">
                                Email
                            </label>

                            <div class="col-sm-9">

                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}">

                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                </div>

                <br>

                {{-- Password --}}
                <div class="row">

                    {{-- Password --}}
                    <div class="col-md-6">
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label">
                                Password
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="emp_password">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('emp_password')">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="col-md-6">
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label">
                                Confirm Password
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation" id="emp_password_confirmation">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('emp_password_confirmation')">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <br>
                {{-- Role --}}
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label">
                                Role
                            </label>

                            <div class="col-sm-9">

                                <select class="form-control form-select" name="role">

                                    <option disabled selected>
                                        Select Role
                                    </option>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>

                                            {{ $role->name }}

                                        </option>
                                    @endforeach

                                </select>

                                @error('role')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>
                    </div>

                </div>

                <br>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary mr-2">
                    Update
                </button>

            </form>

        </div>
    </div>

    @push('scripts')
    <script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const button = field.nextElementSibling;
        const icon = button.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
    @endpush
@endsection
