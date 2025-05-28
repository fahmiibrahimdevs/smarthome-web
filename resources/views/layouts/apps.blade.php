<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.2/css/all.css">

    <link href="{{ asset('midragon/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chakra+Petch&family=Inter&display=swap');

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #1E40AF;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #1E40AF;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }


        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="layout-3" style="font-family: 'Inter', sans-serif;">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" class="navbar-brand sidebar-gone-hide">S M A R T L E A R N I N G</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, Fahmi Ibrahim</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="{{ url('profile') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <i class="far fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ (request()->is('dashboard') ? 'active' : '' ) }}">
                            <a href="{{ url('dashboard') }}" class="nav-link"><i
                                    class="fas fa-home"></i><span>Dashboard</span></a>
                        </li>
                        <li class="nav-item dropdown
                            {{ (request()->is('mqtt') ? 'active' : '' ) }}
                            {{ (request()->is('location') ? 'active' : '' ) }}
                            {{ (request()->is('room') ? 'active' : '' ) }}
                            {{ (request()->is('category') ? 'active' : '' ) }}
                            {{ (request()->is('feature') ? 'active' : '' ) }}
                        ">
                            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                                    class="far fa-network-wired"></i><span>Configure IoT</span></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item {{ (request()->is('mqtt') ? 'active' : '' ) }}"><a
                                        href="{{ url('mqtt') }}" class="nav-link">MQTT</a>
                                <li class="nav-item {{ (request()->is('location') ? 'active' : '' ) }}"><a
                                        href="{{ url('location') }}" class="nav-link">Location</a>
                                </li>
                                <li class="nav-item {{ (request()->is('room') ? 'active' : '' ) }}"><a
                                        href="{{ url('room') }}" class="nav-link">Room</a>
                                </li>
                                <li class="nav-item {{ (request()->is('category') ? 'active' : '' ) }}"><a
                                        href="{{ url('category') }}" class="nav-link">Category</a>
                                <li class="nav-item {{ (request()->is('feature') ? 'active' : '' ) }}"><a
                                        href="{{ url('feature') }}" class="nav-link">Feature</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown
                            {{ (request()->is('device-power') ? 'active' : '' ) }}
                            {{ (request()->is('device-remote') ? 'active' : '' ) }}
                            {{ (request()->is('device-th') ? 'active' : '' ) }}
                            {{ (request()->is('device-monitoring') ? 'active' : '' ) }}
                        ">
                            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                                    class="far fa-layer-group"></i><span>Setting Device</span></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item {{ (request()->is('device-power') ? 'active' : '' ) }}"><a
                                        href="{{ url('device-power') }}" class="nav-link">Device Power</a>
                                </li>
                                <li class="nav-item {{ (request()->is('device-remote') ? 'active' : '' ) }}">
                                    <a href="{{ url('device-remote') }}" class="nav-link">Device Remote</a>
                                </li>
                                <li class="nav-item {{ (request()->is('device-th') ? 'active' : '' ) }}">
                                    <a href="{{ url('device-th') }}" class="nav-link">Device Sensor TH</a>
                                </li>
                                <li class="nav-item {{ (request()->is('device-monitoring') ? 'active' : '' ) }}">
                                    <a href="{{ url('device-monitoring') }}" class="nav-link">Device Monitoring</a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item {{ (request()->is('smarthome') ? 'active' : '' ) }}">
                        <a href="{{ url('smarthome') }}" class="nav-link"><i
                                class="fas fa-laptop-code"></i><span>SMARTHOME</span></a>
                        </li> --}}
                    </ul>
                </div>
            </nav>

            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Create By <a
                        href="https://facebook.com/fahmiibrahimdev">Fahmi Ibrahim</a>
                </div>
                <div class="footer-right">
                    1.0
                </div>
            </footer>
        </div>
    </div>


    @livewireScripts
    <script>
        window.livewire.on("dataStore", () => {
            $("#tambahDataModal").modal("hide");
            $("#ubahDataModal").modal("hide");
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js"></script>
    <script src="{{ asset('midragon/select2/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('midragon/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script>
        window.onbeforeunload = function () {
            window.scrollTo(5, 75);
        };

    </script>
    <script src="{{ asset('midragon/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>
