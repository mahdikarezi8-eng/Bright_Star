<x-app-layout>
    <!-- ======== sidebar-nav start =========== -->
    @include('Admin.layout.navbar')
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        @include('Admin.layout.header')
        <!-- ========== header end ========== -->
        <!-- ========== section start ========== -->
        <section class="section">
            @yield('content')
            
        </section>
        <!-- ========== section end ========== -->
        <!-- ========== footer start =========== -->
        @include('Admin.layout.footer')
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->
</x-app-layout>
