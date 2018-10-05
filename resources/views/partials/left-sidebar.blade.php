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

            {{--<li class="side-nav-title side-nav-item">OPCIONES</li>--}}

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="dripicons-browser"></i>
                    <span> Catálogos </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    {{--<li>--}}
                        {{--<a href="{{route('listUsers')}}">Usuarios</a>--}}
                    {{--</li>--}}
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="fas fa-cog"></i>
                    <span> Configuraciones </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('listUsers')}}">
                            <i class="fas fa-users"></i>
                            <span class="badge badge-success float-right">{{\App\User::count()}}</span>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('asignaRole',['Id'=>0])}}">
                            <i class="fas fa-users-cog"></i>
                            <span class="badge badge-light float-right">{{\App\Role::count()}}</span>
                            <span>Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('asignaPermission',['Id'=>0])}}">
                            <i class="fas fa-user-cog"></i>
                            <span class="badge badge-light float-right">{{\App\Permission::count()}}</span>
                            <span>Permisos</span>
                        </a>
                    </li>
                </ul>
            </li>


        </ul>



        <div class="clearfix"></div>
    @endguest
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->