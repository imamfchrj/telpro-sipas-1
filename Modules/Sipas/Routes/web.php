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
*/

Route::prefix('sipas')->group(function() {
    Route::get('/', 'SipasController@index');
});

Route::prefix('admin/sipas')->as('sipas-')->namespace('\Modules\Sipas\Http\Controllers\Admin')->middleware(['auth'])->group(function () { // phpcs:ignore

    Route::resource('workspace', 'WorkspaceController');
    Route::resource('workspace-suratmasuk', 'WorkspaceSuratMasukController');
    Route::resource('suratmasuk', 'SuratmasukController');
    Route::resource('suratkeluar', 'SuratkeluarController');
    Route::resource('ekspor', 'EksporController');
    Route::get('suratkeluar/{id}/download', 'SuratkeluarController@download');
});