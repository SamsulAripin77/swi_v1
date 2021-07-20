<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Jenis Usaha
    Route::apiResource('jenis-usahas', 'JenisUsahaApiController');

    // Supplier
    Route::apiResource('suppliers', 'SupplierApiController');

    // Kategori Plastik
    Route::apiResource('kategori-plastiks', 'KategoriPlastikApiController');

    // Jenis Plastik
    Route::apiResource('jenis-plastiks', 'JenisPlastikApiController');

    // Pembelian
    Route::post('pembelians/media', 'PembelianApiController@storeMedia')->name('pembelians.storeMedia');
    Route::apiResource('pembelians', 'PembelianApiController');

    // Buyer
    Route::apiResource('buyers', 'BuyerApiController');

    // Penjualan
    Route::post('penjualans/media', 'PenjualanApiController@storeMedia')->name('penjualans.storeMedia');
    Route::apiResource('penjualans', 'PenjualanApiController');

    // Sumber Sampah
    Route::apiResource('sumber-sampahs', 'SumberSampahApiController');

    // Baseline Target
    Route::apiResource('baseline-targets', 'BaselineTargetApiController');
});
