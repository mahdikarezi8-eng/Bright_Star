@extends('Admin.master')

@section('content')
    <style>
        .password-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .password-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            color: white;
        }

        .password-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .password-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }

        .password-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid #e1e5eb;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-change-password {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-change-password:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .alert-success {
            background: linear-gradient(135deg, #28c76f 0%, #1ea97c 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 15px;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .icon-lock {
            font-size: 48px;
            margin-bottom: 15px;
        }
    </style>
    <section class="section">
        <div class="container-fluid">
            <!-- Title -->
            <div class="title-wrapper pt-30 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Change Password</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="password-card">
                        <div class="password-header text-center">
                            <i class="fas fa-lock icon-lock"></i>
                            <h2>Change Password</h2>
                            <p>Secure your account with a strong password</p>
                        </div>
                        <div class="password-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <!-- Current Password -->
                                <div class="form-group">
                                    <label for="current_password">
                                        <i class="fas fa-key me-2"></i>Current Password
                                    </label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" autocomplete="current-password"
                                        placeholder="Enter your current password" required>
                                    @error('updatePassword.current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="form-group">
                                    <label for="password">
                                        <i class="fas fa-shield-alt me-2"></i>New Password
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        autocomplete="new-password" placeholder="Enter your new password" required>
                                    @error('updatePassword.password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">
                                        <i class="fas fa-check-circle me-2"></i>Confirm Password
                                    </label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" autocomplete="new-password"
                                        placeholder="Confirm your new password" required>
                                    @error('updatePassword.password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sync-alt me-2"></i>Change Password
                                    </button>
                                </div>

                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success mt-3">
                                        <i class="fas fa-check-circle me-2"></i>Password changed successfully!
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
