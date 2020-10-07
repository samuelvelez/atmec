<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {!! config('app.name', trans('titles.app')) !!}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto">
                @role('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.adminDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}"
                           href="{{ url('/users') }}">
                            {!! trans('titles.laravelroles') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}"
                           href="{{ url('/users') }}">
                            {!! trans('titles.adminUserList') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('users/create') ? 'active' : null }}"
                           href="{{ url('/users/create') }}">
                            {!! trans('titles.adminNewUser') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                            {!! trans('titles.adminLogs') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}"
                           href="{{ url('/activity') }}">
                            {!! trans('titles.adminActivity') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('routes') ? 'active' : null }}"
                           href="{{ url('/routes') }}">
                            {!! trans('titles.adminRoutes') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('active-users') ? 'active' : null }}"
                           href="{{ url('/active-users') }}">
                            {!! trans('titles.activeUsers') !!}
                        </a>
                    </div>
                </li>
                @endrole

                @role('atmadmin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.atm-management') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('signals-inventory', 'signals-inventory/*') ? 'active' : null }}"
                           href="{{ URL::to('/signals-inventory/') }}">
                            {!! trans('titles.vsignalsInventory') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('devices-inventory', 'devices-inventory/*') ? 'active' : null }}"
                           href="{{ URL::to('/devices-inventory/') }}">
                            {!! trans('titles.deviceInventory') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('signal-groups', 'signal-groups/*') ? 'active' : null }}"
                           href="{{ URL::to('/signal-groups/') }}">
                            {!! trans('titles.groupsList') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('signal-subgroups', 'signal-subgroups/*') ? 'active' : null }}"
                           href="{{ URL::to('/signal-subgroups/') }}">
                            {!! trans('titles.subgroupsList') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('motives', 'motives/*') ? 'active' : null }}"
                           href="{{ URL::to('/motives/') }}">
                            {!! trans('titles.motivesList') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('priorities', 'priorities/*') ? 'active' : null }}"
                           href="{{ URL::to('/priorities/') }}">
                            {!! trans('titles.priorityList') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('statuses', 'statuses/*') ? 'active' : null }}"
                           href="{{ URL::to('/statuses/') }}">
                            {!! trans('titles.statusList') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('metric-units', 'metric-units/*') ? 'active' : null }}"
                           href="{{ URL::to('/metric-units/') }}">
                            {!! trans('titles.metric-unitsList') !!}
                        </a>
                          <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('brands', 'brands/*') ? 'active' : null }}"
                           href="{{ URL::to('/brands/') }}">
                            {!! trans('titles.brandsList') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('traffic-light-type', 'traffic-light-type/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-light-type/') }}">
                            {!! trans('titles.tlightstypeList') !!}
                        </a>
                          <a class="dropdown-item {{ Request::is('device-types', 'device-types/*') ? 'active' : null }}"
                           href="{{ URL::to('/device-types/') }}">
                            {!! trans('titles.device-types') !!}
                        </a>
                        <!--<div class="dropdown-divider"></div>-->
                        
                        
                    </div>
                </li>
                @endrole

                @role('atmadmin|atmcollector|atmoperator|atmsenales|atmconsultas|atmusuario')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.verticalSignalsDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('vertical-signals', 'vertical-signals/*') ? 'active' : null }}"
                           href="{{ URL::to('/vertical-signals/') }}">
                            {!! trans('titles.verticalSignals') !!}
                        </a>
                    </div>
                </li>
                @endrole

                @role('atmadmin|atmcollector|atmoperator')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.trafficLightsDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('intersections', 'intersections/*') ? 'active' : null }}"
                           href="{{ URL::to('/intersections/') }}">
                            {!! trans('titles.intersections') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('regulator-boxes', 'regulator-boxes/*') ? 'active' : null }}"
                           href="{{ URL::to('/regulator-boxes/') }}">
                            {!! trans('titles.regulator-boxes') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('regulator-devices', 'regulator-devices/*') ? 'active' : null }}"
                           href="{{ URL::to('/regulator-devices/') }}">
                            {!! trans('titles.regulator-devices') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('traffic-poles', 'traffic-poles/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-poles/') }}">
                            {!! trans('titles.traffic-poles') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('traffic-tensors', 'traffic-tensors/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-tensors/') }}">
                            {!! trans('titles.traffic-tensors') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('traffic-lights', 'traffic-lights/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-lights/') }}">
                            {!! trans('titles.trafficLights') !!}
                        </a>
                    </div>
                </li>
                @endrole

                @role('atmstockkeeper|atmoperator|atmcollector|atmadmin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.workOrdersDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @role('atmcollector|atmoperator|atmadmin')
                        <a class="dropdown-item {{ Request::is('alerts', 'alerts/*') ? 'active' : null }}"
                           href="{{ URL::to('/alerts/') }}">
                            {!! trans('titles.alertsList') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('reports', 'reports/*') ? 'active' : null }}"
                           href="{{ URL::to('/reports/') }}">
                            {!! trans('titles.reportsList') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('workorders', 'workorders/*') ? 'active' : null }}"
                           href="{{ URL::to('/workorders/') }}">
                            {!! trans('titles.ordersList') !!}
                        </a>
                        @endrole

                        @role('atmstockkeeper|atmadmin')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('itorders', 'itorders/*') ? 'active' : null }}"
                           href="{{ URL::to('/itorders/') }}">
                            {!! trans('titles.itorders') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('ito-templates', 'ito-templates/*') ? 'active' : null }}"
                           href="{{ URL::to('ito-templates/') }}">
                            {!! trans('titles.ito-templates') !!}
                        </a>
                        @endrole
                    </div>
                </li>
                @endrole

                @role('atmoperator|atmadmin|atmsenales|atmconsultas')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.reportsDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('reports/geolocation') ? 'active' : null }}"
                           href="{{ URL::to('/georeports/geolocation') }}">
                            {!! trans('titles.geolocations') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('reports/signal-totals') ? 'active' : null }}"
                           href="{{ URL::to('/georeports/signal-totals') }}">
                            {!! trans('titles.signal-totals') !!}
                        </a>
                        <a class="dropdown-item {{ Request::is('reports/light-totals') ? 'active' : null }}"
                           href="{{ URL::to('/georeports/light-totals') }}">
                            {!! trans('titles.light-totals') !!}
                        </a>
                    </div>
                </li>
                @endrole
            </ul>

            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto">
                {{-- Authentication Links --}}
                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}"
                               href="{{ url('/profile/'.Auth::user()->name) }}">
                                {!! trans('titles.profile') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
