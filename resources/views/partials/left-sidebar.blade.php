<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="index.html" class="logo text-center">
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo_sm.png" alt="" height="16">
            </span>
        </a>
@guest()
@else
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
                        <a href="layouts-horizontal.html">Horizontal</a>
                    </li>
                    <li>
                        <a href="layouts-light-sidenav.html">Light Sidenav</a>
                    </li>
                    <li>
                        <a href="layouts-collapsed.html">Collapsed Sidenav</a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="right-bar-toggle">Right Sidebar</a>
                    </li>
                </ul>
            </li>


        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-right close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
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