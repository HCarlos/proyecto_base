@extends('layouts.app')

@section('content')

<body>
    <div class="wrapper">
        @include('partials/left-sidebar')
        <div class="content-page">
            <div class="content">
                @include('partials/topbar')
                <div class="container-fluid">
                    @yield('container')
                </div>
                <!-- container -->
            </div>
        </div>
            <!-- content -->
        @include('partials/footer')
    </div>
@include('partials/script_footer')
</body>

@endsection
