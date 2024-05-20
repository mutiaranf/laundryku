<div class="header">
    <div class="header-left active ">

        <a href="index.html" class="logo ms-2">
            <h2 class="font-bold" style="font-weight: 700">LaundryKu</h2>
        </a>
        <a href="index.html" class="logo-small">
          <h2 class="text-center font-bold" style="font-weight: 700">LK</h2>
        </a>
        <a id="toggle_btn" href="javascript:void(0);"> </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">





        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{asset(Auth::user()->profile_photo_url)}}"
                                            alt="{{ Auth::user()->name }}" class="rounded-circle"
                                            style="height: 2.5rem; width: 2.5rem; object-fit: cover" />
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">

                        <span class="user-img"><img src="{{asset(Auth::user()->profile_photo_url) }}"
                                                    alt="{{ Auth::user()->name }}" class="rounded-circle"
                                                    style="height: 2.5rem; width: 2.5rem; object-fit: cover" />
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{ Auth::user()->name }}</h6>
                            <h5 style="text-transform: capitalize; !impoertant">{{trim(Auth::user()->roles->pluck('name'),"[]\"") }}</h5>
                        </div>
                    </div>
                    <hr class="m-0" />

                    <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="me-2"
                                                                                   data-feather="settings"></i>Settings</a>
                    <hr class="m-0" />

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                           class="dropdown-item logout pb-0" href="signin.html"><img
                                src="{{ asset('assets/img/icons/log-out.svg') }} " class="me-2"
                                alt="img" />Logout</a>
                    </form>
                </div>
            </div>
        </li>
    </ul>

    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>
            <a class="dropdown-item" href="signin.html">Logout</a>
        </div>
    </div>
</div>
