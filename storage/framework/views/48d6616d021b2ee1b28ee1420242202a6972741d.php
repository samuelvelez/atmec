<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">
            <?php echo config('app.name', trans('titles.app')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only"><?php echo trans('titles.toggleNav'); ?></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav mr-auto">
                <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo trans('titles.adminDropdownNav'); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php echo e((Request::is('roles') || Request::is('permissions')) ? 'active' : null); ?>"
                           href="<?php echo e(url('/users')); ?>">
                            <?php echo trans('titles.laravelroles'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null); ?>"
                           href="<?php echo e(url('/users')); ?>">
                            <?php echo trans('titles.adminUserList'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('users/create') ? 'active' : null); ?>"
                           href="<?php echo e(url('/users/create')); ?>">
                            <?php echo trans('titles.adminNewUser'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('logs') ? 'active' : null); ?>" href="<?php echo e(url('/logs')); ?>">
                            <?php echo trans('titles.adminLogs'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('activity') ? 'active' : null); ?>"
                           href="<?php echo e(url('/activity')); ?>">
                            <?php echo trans('titles.adminActivity'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('routes') ? 'active' : null); ?>"
                           href="<?php echo e(url('/routes')); ?>">
                            <?php echo trans('titles.adminRoutes'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('active-users') ? 'active' : null); ?>"
                           href="<?php echo e(url('/active-users')); ?>">
                            <?php echo trans('titles.activeUsers'); ?>

                        </a>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo trans('titles.atm-management'); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php echo e(Request::is('signals-inventory', 'signals-inventory/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/signals-inventory/')); ?>">
                            <?php echo trans('titles.vsignalsInventory'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('devices-inventory', 'devices-inventory/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/devices-inventory/')); ?>">
                            <?php echo trans('titles.deviceInventory'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('signal-groups', 'signal-groups/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/signal-groups/')); ?>">
                            <?php echo trans('titles.groupsList'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('signal-subgroups', 'signal-subgroups/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/signal-subgroups/')); ?>">
                            <?php echo trans('titles.subgroupsList'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('motives', 'motives/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/motives/')); ?>">
                            <?php echo trans('titles.motivesList'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('priorities', 'priorities/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/priorities/')); ?>">
                            <?php echo trans('titles.priorityList'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('statuses', 'statuses/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/statuses/')); ?>">
                            <?php echo trans('titles.statusList'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('metric-units', 'metric-units/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/metric-units/')); ?>">
                            <?php echo trans('titles.metric-unitsList'); ?>

                        </a>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector|atmoperator|atmsenales|atmconsultas|atmusuario')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo trans('titles.verticalSignalsDropdownNav'); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php echo e(Request::is('vertical-signals', 'vertical-signals/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/vertical-signals/')); ?>">
                            <?php echo trans('titles.verticalSignals'); ?>

                        </a>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Auth::check() && Auth::user()->hasRole('atmadmin|atmcollector|atmoperator')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo trans('titles.trafficLightsDropdownNav'); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php echo e(Request::is('intersections', 'intersections/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/intersections/')); ?>">
                            <?php echo trans('titles.intersections'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('regulator-boxes', 'regulator-boxes/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/regulator-boxes/')); ?>">
                            <?php echo trans('titles.regulator-boxes'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('regulator-devices', 'regulator-devices/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/regulator-devices/')); ?>">
                            <?php echo trans('titles.regulator-devices'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('traffic-poles', 'traffic-poles/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/traffic-poles/')); ?>">
                            <?php echo trans('titles.traffic-poles'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('traffic-tensors', 'traffic-tensors/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/traffic-tensors/')); ?>">
                            <?php echo trans('titles.traffic-tensors'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('traffic-lights', 'traffic-lights/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/traffic-lights/')); ?>">
                            <?php echo trans('titles.trafficLights'); ?>

                        </a>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Auth::check() && Auth::user()->hasRole('atmstockkeeper|atmoperator|atmcollector|atmadmin')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo trans('titles.workOrdersDropdownNav'); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if (Auth::check() && Auth::user()->hasRole('atmcollector|atmoperator|atmadmin')): ?>
                        <a class="dropdown-item <?php echo e(Request::is('alerts', 'alerts/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/alerts/')); ?>">
                            <?php echo trans('titles.alertsList'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('reports', 'reports/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/reports/')); ?>">
                            <?php echo trans('titles.reportsList'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('workorders', 'workorders/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/workorders/')); ?>">
                            <?php echo trans('titles.ordersList'); ?>

                        </a>
                        <?php endif; ?>

                        <?php if (Auth::check() && Auth::user()->hasRole('atmstockkeeper|atmadmin')): ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('itorders', 'itorders/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/itorders/')); ?>">
                            <?php echo trans('titles.itorders'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('ito-templates', 'ito-templates/*') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('ito-templates/')); ?>">
                            <?php echo trans('titles.ito-templates'); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Auth::check() && Auth::user()->hasRole('atmoperator|atmadmin|atmsenales|atmconsultas')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo trans('titles.reportsDropdownNav'); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item <?php echo e(Request::is('reports/geolocation') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/georeports/geolocation')); ?>">
                            <?php echo trans('titles.geolocations'); ?>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item <?php echo e(Request::is('reports/signal-totals') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/georeports/signal-totals')); ?>">
                            <?php echo trans('titles.signal-totals'); ?>

                        </a>
                        <a class="dropdown-item <?php echo e(Request::is('reports/light-totals') ? 'active' : null); ?>"
                           href="<?php echo e(URL::to('/georeports/light-totals')); ?>">
                            <?php echo trans('titles.light-totals'); ?>

                        </a>
                    </div>
                </li>
                <?php endif; ?>
            </ul>

            
            <ul class="navbar-nav ml-auto">
                
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item <?php echo e(Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null); ?>"
                               href="<?php echo e(url('/profile/'.Auth::user()->name)); ?>">
                                <?php echo trans('titles.profile'); ?>

                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /Users/samuel/Documents/proyectos/Saveme/atm2/nuevo/resources/views/partials/nav.blade.php ENDPATH**/ ?>