<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    //Route::get('/', 'WelcomeController@welcome')->name('welcome');
    Route::redirect('/', '/home');
});

// Authentication Routes
Auth::routes();
Auth::routes(['register' => false]);
Route::redirect('/register', '/login');

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {
    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    //Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    //Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    //Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {
    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {
    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home', 'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as' => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'checkblocked']], function () {
    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as' => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as' => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as' => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'checkblocked']], function () {
    Route::redirect('/php', '/phpinfo', 301);

    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index' => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index' => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

// Registered, activated, and is collector routes.


Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmcollector|atmoperator|atmsenales|atmconsultas|atmusuario', 'activity', 'checkblocked']], function () {
    Route::resource('vertical-signals', 'VerticalSignalController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('vertical-signals/export/xlsx', 'VerticalSignalController@export_xlsx')->name('vertical-signals.xlsx');
    Route::get('vertical-signals/{id}/audit', 'VerticalSignalController@audit')->name('vertical-signals.audit');
    Route::post('search-vertical-signals', 'VerticalSignalController@search')->name('search-vertical-signals');

    Route::get('variations-by-signal', 'SignalInventoryController@variations')->name('variations-by-signal');

    Route::resource('intersections', 'IntersectionController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('intersections/export/xlsx', 'IntersectionController@export_xlsx')->name('intersections.xlsx');

    Route::get('regulator-boxes/export/xlsx', 'RegulatorBoxController@export_xlsx')->name('regulators.xlsx');
   
    Route::post('search-intersections', 'IntersectionController@search')->name('search-intersections');
    /*Route::get('api/today-intersections', 'IntersectionController@today')->name('today-intersections');
    Route::get('api/all-intersections', 'IntersectionController@all')->name('all-intersections');*/

    Route::resource('traffic-poles', 'TrafficPoleController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-traffic-poles', 'TrafficPoleController@search')->name('search-traffic-poles');
    Route::get('api/today-poles', 'TrafficPoleController@today')->name('today-poles');
    Route::get('api/all-poles', 'TrafficPoleController@all')->name('all-poles');

    Route::resource('traffic-tensors', 'TrafficTensorController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-traffic-tensors', 'TrafficTensorController@search')->name('search-traffic-tensors');
    Route::get('api/today-tensors', 'TrafficTensorController@today')->name('today-tensors');
    Route::get('api/all-tensors', 'TrafficTensorController@all')->name('all-tensors');

    Route::resource('regulator-boxes', 'RegulatorBoxController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('regulator-boxes/{id}/audit', 'RegulatorBoxController@audit')->name('regulator-boxes.audit');
    Route::post('search-regulator-boxes', 'RegulatorBoxController@search')->name('search-regulator-boxes');
    Route::get('api/today-regulators', 'RegulatorBoxController@today')->name('today-regulators');
    Route::get('api/all-regulators', 'RegulatorBoxController@all')->name('all-regulators');

    Route::resource('traffic-lights', 'TrafficLightController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('traffic-lights/export/xlsx', 'TrafficLightController@export_xlsx')->name('traffic-lights.xlsx');
    Route::get('traffic-lights/{id}/audit', 'TrafficLightController@audit')->name('traffic-lights.audit');
    Route::post('search-traffic-lights', 'TrafficLightController@search')->name('search-traffic-lights');

    Route::resource('regulator-devices', 'RegulatorDevicesController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('regulator-devices/{id}/audit', 'RegulatorDevicesController@audit')->name('regulator-devices.audit');
    Route::post('search-regulator-devices', 'RegulatorDevicesController@search')->name('search-regulator-devices');
    Route::get('api/brands-by-type', 'RegulatorDevicesController@brands_by_type')->name('brands-by-type');

    //GeoReports List
    Route::get('/georeports/geolocation', 'GeoReportsController@show_signals')->name('geolocation');
    Route::post('/georeports/vertical-signals', 'GeoReportsController@search_signals')->name('vsignal-filters');
    Route::get('/georeports/signal-totals', 'GeoReportsController@signal_totals')->name('signal-totals');
    Route::post('/georeports/signals-excel', 'GeoReportsController@signals_excel')->name('signals-excel');
    Route::post('/georeports/signal-totals-excel', 'GeoReportsController@signal_totals_excel')->name('signal-totals-excel');

    Route::post('/georeports/traffic-lights', 'GeoReportsController@search_lights')->name('light-filters');
    Route::get('/georeports/light-totals', 'GeoReportsController@light_totals')->name('light-totals');
    Route::post('/georeports/lights-excel', 'GeoReportsController@lights_excel')->name('lights-excel');
    Route::post('/georeports/light-totals-excel', 'GeoReportsController@light_totals_excel')->name('light-totals-excel');

    Route::post('/georeports/regulator-boxes', 'GeoReportsController@search_regulators')->name('regulator-filters');
    Route::post('/georeports/regulators-excel', 'GeoReportsController@regulators_excel')->name('regulators-excel');
});


Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmstockkeeper', 'activity', 'checkblocked']], function () {
    Route::resource('ito-templates', 'ItorderTemplateController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    
        Route::resource('materials', 'MaterialController')->only([
        'index', 'show', 'create', 'store', 'edit', 'store2', 'editar', 'update', 'destroy'
    ]);
Route::get('/materials/{id}/editar', 'MaterialController@editar')->name('editar');
Route::get('/materials/aprobar/{id}', 'MaterialController@aprobar')->name('aprobar');
Route::get('/materials/aprobadas/{id}', 'MaterialController@index2')->name('index2');
Route::get('/materials/negadas/{id}', 'MaterialController@index3')->name('index3');
Route::get('/materials/ingresadas/{id}', 'MaterialController@index4')->name('index4');
Route::get('/materials/recibidos/{id}', 'MaterialController@index5')->name('index5');
Route::get('/materials/entregadas/{id}', 'MaterialController@index6')->name('index6');
Route::post('/materials/negar/{id}', 'MaterialController@negar')->name('negar');
Route::get('/materials/entregar/{id}', 'MaterialController@entregar')->name('entregar');
Route::post('/materials/entregarnewmaterial/{id}', 'MaterialController@entregarnewmaterial')->name('entregarnewmaterial');

    Route::resource('itorders', 'ItorderController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
});

Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmoperator|atmcollector|ccitt', 'activity', 'checkblocked']], function () {
    //Route::get('/ordenes','OrdenController@index');
    Route::resource('/ordenes','OrdenController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('/ordenes/{id}/close', 'OrdenController@close');
    Route::get('/ordenes/{id}/worked', 'OrdenController@worked');
    
    
    Route::resource('alerts', 'AlertController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::resource('materials','MaterialController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'store2', 'destroy'
    ]);
    Route::get('/materials/recibir/{id}', 'MaterialController@recibir')->name('recibir');

    Route::resource('delivery-material','DeliveryMaterialController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
//    Route::get('/materials/recibir/{id}', 'MaterialController@recibir')->name('recibir');
    
    
});

Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmoperator|atmcollector|ccitt', 'activity', 'checkblocked']], function () {
    Route::resource('workorders', 'WorkorderController')->only([
        'index', 'show', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('/workorders/{id}/create', 'WorkorderController@create');
    Route::get('/workorders/{id}/close', 'WorkorderController@add_pictures');
    Route::post('/workorders/{id}/close', 'WorkorderController@close');

    Route::post('/workorders/{id}/complete', 'WorkorderController@complete');
});

Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmoperator|atmcollector|ccitt', 'activity', 'checkblocked']], function () {
    Route::resource('reports', 'ReportController')->only([
        'index', 'show', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('/reports/{id}/create', 'ReportController@create');
    
    Route::resource('ubicacion', 'UbicacionController')->only([
        'index', 'show', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::get('/ubicacion/{id}/create', 'UbicacionController@create');
    
});

Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmstorage|atmstockkeeper|atmcollector|ccitt', 'activity', 'checkblocked']], function () {
    Route::resource('storage-inventory', 'StorageInventoryController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    
           Route::resource('materials', 'MaterialController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'store2', 'destroy'
    ]);
           Route::get('/materials/{id}/editar', 'MaterialController@editar')->name('editar');
Route::get('/materials/aprobar/{id}', 'MaterialController@aprobar')->name('aprobar');
Route::post('/materials/negar/{id}', 'MaterialController@negar')->name('negar');
Route::get('/materials/aprobadas/{id}', 'MaterialController@index2')->name('index2');
Route::get('/materials/negadas/{id}', 'MaterialController@index3')->name('index3');
Route::get('/materials/ingresadas/{id}', 'MaterialController@index4')->name('index4');
Route::get('/materials/recibidos/{id}', 'MaterialController@index5')->name('index5');
Route::get('/materials/entregadas/{id}', 'MaterialController@index6')->name('index6');
Route::get('/materials/entregar/{id}', 'MaterialController@entregar')->name('entregar');
Route::post('/materials/entregarnewmaterial/{id}', 'MaterialController@entregarnewmaterial')->name('entregarnewmaterial');
              Route::resource('delivery-material','DeliveryMaterialController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
              Route::post('/delivery-material/entregarnew/{id}', 'DeliveryMaterialController@entregarnew')->name('entregarnew');
});

// Registered, activated, and is atmadmin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin', 'activity', 'checkblocked']], function () {
    Route::resource('signals-inventory', 'SignalInventoryController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-signals-inventory', 'SignalInventoryController@search')->name('search-signals-inventory');

    Route::resource('devices-inventory', 'DeviceInventoryController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-devices', 'DeviceInventoryController@search')->name('search-device-inventory');

    Route::resource('motives', 'MotiveController')->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-motives', 'MotiveController@search')->name('search-motives');

    Route::resource('priorities', 'PriorityController')->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::resource('statuses', 'StatusController')->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::resource('metric-units', 'MetricUnitController')->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);

    Route::resource('signal-groups', 'SignalGroupController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-signal-group', 'SignalGroupController@search')->name('search-signal-group');

    Route::resource('signal-subgroups', 'SignalSubgroupController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-signal-subgroup', 'SignalSubgroupController@search')->name('search-signal-subgroup');
    
    Route::resource('brands', 'BrandController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-brand', 'BrandController@search')->name('search-brand');
    
    Route::resource('traffic-light-type', 'TrafficLightTypeController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-trafficlighttype', 'TrafficLightTypeController@search')->name('search-trafficlighttype');
    
    Route::resource('device-types', 'DeviceTypesController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-devicetypes', 'DeviceTypesController@search')->name('search-devicetypes');
    
    Route::resource('motive-work-order', 'MotiveWOController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-workordertype', 'WorkOrderTypeController@search')->name('search-workordertype');
     Route::resource('work-order-type', 'WorkOrderTypeController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-workordertype', 'WorkOrderTypeController@search')->name('search-workordertype');
    
    Route::post('search-ubicacion', 'UbicacionController@search')->name('search-ubicacion');
     Route::resource('ubicacion', 'UbicacionController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-ubicacion', 'UbicacionController@search')->name('search-ubicacion');
    
});

Route::get('/limpiar_cache', function () {
    //$exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    //$exitCode = Artisan::call('cache:config');
    //$exitCode = Artisan::call('views:clear');
});
