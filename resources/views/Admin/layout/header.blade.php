<header class="header bg-primary" style="height:70px; padding:10px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">

                    {{-- <div class="menu-toggle-btn mr-15">
                        <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div> --}}
                    <div class="menu-toggle-btn mr-15">
                        <button id="menu-toggle"
                            class="btn btn-outline-light rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                            <i class="fa-solid fa-bars"></i>
                            <span>Menu</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info">
                                    @php
                                        $user = Auth::user();
                                        $image = asset('backend/assets/images/profile/profile-image.png');
                                        if ($user->role == 'staff' && $user->employee && $user->employee->image) {
                                            $image = asset('images/employee/' . $user->employee->image);
                                        }

                                        if ($user->role == 'teacher' && $user->teacher && $user->teacher->image) {
                                            $image = asset('images/teachers/' . $user->teacher->image);
                                        }
                                    @endphp

                                    <div
                                        class="image rounded-circle overflow-hidden d-flex align-items-center justify-content-center">
                                        <img src="{{ $image }}" alt="profile image" class="img-fluid"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="fw-500">
                                            @if (Auth::check())
                                                <span>{{ Auth::user()->name }}</span>
                                            @endif
                                        </h6>
                                        <p>{{ Auth::user()->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                            <li>
                                <div class="author-info flex items-center">
                                    <div class="image">
                                        <img src="{{ $image }}" alt="image">
                                    </div>
                                    <div class="content">
                                        <h4 class="text-sm">
                                            @php
                                                $user = Auth::user();
                                                $full_name = '';

                                                if ($user->role == 'staff' && $user->employee) {
                                                    $full_name =
                                                        $user->employee->first_name . ' ' . $user->employee->last_name;
                                                }

                                                if ($user->role == 'teacher' && $user->teacher) {
                                                    $full_name =
                                                        $user->teacher->first_name . ' ' . $user->teacher->last_name;
                                                }
                                            @endphp
                                            {{ $full_name }}
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#0">
                                    <i class="lni lni-user"></i> View Profile
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                    <i class="lni lni-alarm"></i> Notifications
                                </a>
                            </li>
                            <li>
                                <a href="#0"> <i class="lni lni-inbox"></i> Messages </a>
                            </li>

                            <li>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="lni lni-lock"></i> Change Password
                                </a>
                            </li>
                            {{-- <li>
                                <a href="#" class="p-0">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button id="log" style="border:none; background-color:transparent">
                                            <i class="lni lni-exit ml-2 pull-left"></i>
                                            <i class="text-gray">Sign Out</i>
                                        </button>
                                    </form>
                                </a>
                            </li> --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="lni lni-cog"></i> Sign Out
                                    </a>
                                </form>
                            </li>

                            <!-- Authentication -->
                            {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form> --}}



                        </ul>
                    </div>
                    <!-- profile end -->
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px 10px 0 0; border-bottom: none;">
                <h5 class="modal-title text-white" id="changePasswordModalLabel" style="font-weight: 600;">
                    <i class="fa fa-lock"></i> Change Password
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form id="changePasswordForm" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="current_password" class="form-label" style="font-weight: 500; color: #333;">Current
                            Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8f9fa; border-color: #e0e0e0;"><i
                                    class="fa fa-key text-primary"></i></span>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required style="border-color: #e0e0e0;" placeholder="Enter current password">
                            <button class="btn btn-outline-secondary toggle-password-btn" type="button"
                                onclick="togglePassword('current_password')"
                                style="border-color: #e0e0e0; background: #f8f9fa; transition: all 0.3s;">
                                <i class="fa fa-eye" style="color: #667eea;"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="text-danger small mt-1" style="font-weight: 500;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label" style="font-weight: 500; color: #333;">New
                            Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8f9fa; border-color: #e0e0e0;"><i
                                    class="fa fa-lock text-primary"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required
                                style="border-color: #e0e0e0;" placeholder="Enter new password">
                            <button class="btn btn-outline-secondary toggle-password-btn" type="button"
                                onclick="togglePassword('password')"
                                style="border-color: #e0e0e0; background: #f8f9fa; transition: all 0.3s;">
                                <i class="fa fa-eye" style="color: #667eea;"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1" style="font-weight: 500;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label"
                            style="font-weight: 500; color: #333;">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8f9fa; border-color: #e0e0e0;"><i
                                    class="fa fa-lock text-primary"></i></span>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required style="border-color: #e0e0e0;"
                                placeholder="Confirm new password">
                            <button class="btn btn-outline-secondary toggle-password-btn" type="button"
                                onclick="togglePassword('password_confirmation')"
                                style="border-color: #e0e0e0; background: #f8f9fa; transition: all 0.3s;">
                                <i class="fa fa-eye" style="color: #667eea;"></i>
                            </button>
                        </div>
                    </div>

                    <div class="alert alert-info"
                        style="background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); border: 1px solid #667eea30; border-radius: 8px;">
                        <strong style="color: #667eea;">Password Requirements:</strong>
                        <ul class="mb-0 mt-2 small" style="color: #555;">
                            <li>Minimum 3 characters</li>
                            <li>At least one English letter (a-z or A-Z)</li>
                            <li>Special characters are optional</li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e0e0e0; padding: 20px 30px;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="border-radius: 8px; padding: 10px 25px; font-weight: 500;">
                    <i class="fa fa-times-circle"></i> Cancel
                </button>
                <button type="submit" form="changePasswordForm" class="btn btn-primary"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 8px; padding: 10px 25px; font-weight: 500;">
                    <i class="fa fa-check-circle"></i> Change Password
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .toggle-password-btn:hover {
        background: #667eea !important;
        border-color: #667eea !important;
    }

    .toggle-password-btn:hover i {
        color: white !important;
    }
</style>

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

    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (!currentPassword) {
            e.preventDefault();
            alert('Please enter your current password');
            return;
        }

        if (!newPassword) {
            e.preventDefault();
            alert('Please enter a new password');
            return;
        }

        if (newPassword.length < 3) {
            e.preventDefault();
            alert('Password must be at least 3 characters');
            return;
        }

        if (!/[a-zA-Z]/.test(newPassword)) {
            e.preventDefault();
            alert('Password must contain at least one English letter');
            return;
        }

        if (newPassword !== confirmPassword) {
            e.preventDefault();
            alert('New password and confirmation do not match');
            return;
        }

        // Form will submit, show success message after redirect
        this.submit();
    });

    // Check for success message and show alert
    window.addEventListener('load', function() {
        @if (session('status') === 'password-updated')
            // Show success message
            const successDiv = document.createElement('div');
            successDiv.style.cssText =
                'position: fixed; top: 20px; right: 20px; background: linear-gradient(135deg, #28c76f 0%, #1ebe57 100%); color: white; padding: 15px 25px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); z-index: 9999; font-weight: 500; animation: slideIn 0.5s ease-out;';
            successDiv.innerHTML = '<i class="fa fa-check-circle"></i> Password changed successfully!';
            document.body.appendChild(successDiv);

            // Remove after 3 seconds
            setTimeout(function() {
                successDiv.style.animation = 'slideOut 0.5s ease-out';
                setTimeout(function() {
                    successDiv.remove();
                }, 500);
            }, 3000);
        @endif
    });

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
    document.head.appendChild(style);
</script>
