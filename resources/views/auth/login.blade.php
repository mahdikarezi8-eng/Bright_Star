<x-guest-layout>
    <div class="log-in">
        <div class="container-login">
            <div class="wrap-login">
                <form class="login-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login-form-title p-b-48">
                        <img src="assets/images/mobio-logoaa.png">
                    </span>
                    <div class="log-head">
                        <h2 style="color: #1c5293;">Welcome Back!</h2>
                    </div>

                    <!-- Email Address -->

                    <div>
                        <div class="wrap-input validate-input" data-validate = "Valid email is: a@b.c">
                            <input type="email" class="form-control" id="email"
                                placeholder="Enter Email"name="email" :value="old('email')">
                            @error('email')
                                <span class="text-danger float-left mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <!-- Password -->
                    <div>
                        <div class="wrap-input validate-input" data-validate="Enter password">
                            <input type="password" class="form-control" id="pwd" placeholder="Enter Password"
                                name="password">
                            @error('password')
                                <span class="text-danger float-left mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div>
                        <label for="remember_me" class="inline-flex items-left contact-form-checkbox">
                            <input id="remember_me" type="checkbox" class="input-checkbox float-left mt-2 big-checkbox"
                                name="remember" style="scale: 1.3; hover::pointed;">
                            <lebel class="lebel-checkbox float-left ml-2  text-muted">{{ __('Remember me') }}
                            </lebel>
                        </label>
                    </div>
                    <div class="d-inline">
                        @if (Route::has('password.request'))
                            <a class="text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="container-login-form-btn">
                        <div class="wrap-login-form-btn">
                            <div class="login-form-bgbtn"></div>
                            <button class="login-form-btn " type="submit">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="text-center">
                        <span class="txt1">
                            Don’t have an account?
                        </span>

                        <a class="txt2" href="{{ route('register') }}">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
