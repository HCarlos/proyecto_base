<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="/" class="logo text-center">
            <span class="logo-lg">
                <img src="{{asset('images/logo.png')}}" alt="" >
            </span>
            <span class="logo-sm">
                <img src="{{asset('images/logo_sm.png')}}" >
            </span>
        </a>
    @guest()
    @else()
        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">OPCIONES</li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="dripicons-browser"></i>
                    <span> Catálogos </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="/">Horizontal</a>
                    </li>
                    <li>
                        <a href="/">Light Sidenav</a>
                    </li>
                    <li>
                        <a href="/">Collapsed Sidenav</a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="right-bar-toggle">Right Sidebar</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-right close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="{{asset('images/help-icon.svg')}}" height="90" alt="Helper Icon Image" />
            {{--<h5 class="mt-3">Unlimited Access</h5>--}}
            {{--<p class="mb-3">Upgrade to plan to get access to unlimited reports</p>--}}
            {{--<a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>--}}
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    @endguest
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->