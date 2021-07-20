<?php

Route::redirect('/', '/login');
Route::get('/landing', function () {
    return view('auth.welcome');
});
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('/dependend-dropdown', 'UsersController@dependendDropdown')->name('users.dependend-dropdown');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Jenis Usaha
    Route::delete('jenis-usahas/destroy', 'JenisUsahaController@massDestroy')->name('jenis-usahas.massDestroy');
    Route::resource('jenis-usahas', 'JenisUsahaController');

    // Supplier
    Route::delete('suppliers/destroy', 'SupplierController@massDestroy')->name('suppliers.massDestroy');
    Route::resource('suppliers', 'SupplierController');

    // Kategori Plastik
    Route::delete('kategori-plastiks/destroy', 'KategoriPlastikController@massDestroy')->name('kategori-plastiks.massDestroy');
    Route::resource('kategori-plastiks', 'KategoriPlastikController');

    // Jenis Plastik
    Route::delete('jenis-plastiks/destroy', 'JenisPlastikController@massDestroy')->name('jenis-plastiks.massDestroy');
    Route::resource('jenis-plastiks', 'JenisPlastikController');

    // Pembelian
    Route::delete('pembelians/destroy', 'PembelianController@massDestroy')->name('pembelians.massDestroy');
    Route::post('pembelians/media', 'PembelianController@storeMedia')->name('pembelians.storeMedia');
    Route::post('pembelians/ckmedia', 'PembelianController@storeCKEditorImages')->name('pembelians.storeCKEditorImages');
    Route::get('laporan-pembelians','PembelianController@laporan')->name('pembelians.laporan');
    Route::get('export-pembelian','PembelianController@exportExcel')->name('pembelians.export-pembelian');
    Route::resource('pembelians', 'PembelianController');


    

    // Buyer
    Route::delete('buyers/destroy', 'BuyerController@massDestroy')->name('buyers.massDestroy');
    Route::resource('buyers', 'BuyerController');

   

    Route::group(['middleware'=> ['user-mitra']],function(){
         //data mitra
        Route::resource('data-mitra','DataMitraController');
        //Kemitraan
        Route::post('kemitraan/media', 'KemitraanController@storeMedia')->name('kemitraan.storeMedia');
        Route::post('kemitraan/ckmedia', 'KemitraanController@storeCKEditorImages')->name('kemitraan.storeCKEditorImages');
        route::resource('kemitraan','KemitraanController');
    });
    

    // Penjualan
    Route::delete('penjualans/destroy', 'PenjualanController@massDestroy')->name('penjualans.massDestroy');
    Route::post('penjualans/media', 'PenjualanController@storeMedia')->name('penjualans.storeMedia');
    Route::post('penjualans/ckmedia', 'PenjualanController@storeCKEditorImages')->name('penjualans.storeCKEditorImages');
    Route::get('laporan-penjualans','PenjualanController@laporan')->name('penjualans.laporan');
    Route::resource('penjualans', 'PenjualanController');

    // Sumber Sampah
    Route::delete('sumber-sampahs/destroy', 'SumberSampahController@massDestroy')->name('sumber-sampahs.massDestroy');
    Route::post('sumber-sampahs/storeAjax','SumberSampahController@storeAjax')->name('sumber-sampah.storeAjax');
    Route::resource('sumber-sampahs', 'SumberSampahController');

    // Baseline Target
    Route::delete( 'baseline-targets/destroy', 'BaselineTargetController@massDestroy')->name('baseline-targets.massDestroy');
    Route::get('baseline/laporan', 'BaselineTargetController@laporan')->name('baseline-targets.laporan');
    Route::post('baseline-targets/dependend-dropdown', 'BaselineTargetController@dependendDropdown')->name('baseline.dependend-dropdown');
    Route::resource('baseline-targets', 'BaselineTargetController');

    Route::get('imports/pembelian-import','ImportsController@createPembelian')->name('imports.pembelian-create');
    Route::post('imports/pembelian-import','ImportsController@storePembelian')->name('imports.pembelian-store');

    // Sub Jenis Plastik
    Route::delete('sub-jenis-plastiks/destroy', 'SubJenisPlastikController@massDestroy')->name('sub-jenis-plastiks.massDestroy');
    Route::resource('sub-jenis-plastiks', 'SubJenisPlastikController');

    // Jenis Plastik Buyer
    Route::delete('jenis-plastik-buyers/destroy', 'JenisPlastikBuyerController@massDestroy')->name('jenis-plastik-buyers.massDestroy');
    Route::post('jenis-plastik/storeAjax','JenisPlastikBuyerController@storeAjax')->name('jenis_plastik.storeAjax');
    Route::resource('jenis-plastik-buyers', 'JenisPlastikBuyerController');

    // Jenis Usaha Buyer
    Route::delete('jenis-usaha-buyers/destroy', 'JenisUsahaBuyerController@massDestroy')->name('jenis-usaha-buyers.massDestroy');
    Route::post('jenis-usaha/storeAjax','jenisUsahaBuyerController@storeAjax')->name('jenis_usaha.storeAjax');
    Route::resource('jenis-usaha-buyers', 'JenisUsahaBuyerController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
