<?php

declare(strict_types=1);

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes();
    // Route::get('/', function () {
    //     dd(\App\Models\User::all());
    //     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });
    // Route::post('/uploads', 'FilesController@fileUpload');
    // Route::get('/', "UsersController@index");
    Route::prefix('/admin')->group(function(){
        Route::get('/', [HomeController::class,'index'])->name('home.admin');
        Route::prefix('users')->group(function(){
            Route::get('/',[UserController::class,'index'])->name('users.index');

            Route::get('/ajax',[UserController::class,'paginacaoAjax'])->name('users.ajax');
            Route::get('/lista.ajax',function(){
                return view('users.index_ajax');
            });

            Route::get('/create',[UserController::class,'create'])->name('users.create');
            Route::post('/',[UserController::class,'store'])->name('users.store');
            Route::get('/{id}/show',[UserController::class,'show'])->where('id', '[0-9]+')->name('users.show');
            Route::get('/{id}/edit',[UserController::class,'edit'])->where('id', '[0-9]+')->name('users.edit');
            Route::put('/{id}',[UserController::class,'update'])->where('id', '[0-9]+')->name('users.update');
            Route::delete('/{id}',[UserController::class,'destroy'])->where('id', '[0-9]+')->name('users.destroy');
        });
        Route::resource('posts','\App\Http\Controllers\admin\PostsController',['parameters' => [
            'posts' => 'id'
        ]]);
        Route::resource('api-wp','\App\Http\Controllers\wp\ApiWpController',['parameters' => [
            'api-wp' => 'id'
        ]]);
        Route::resource('pages','\App\Http\Controllers\admin\PostsController',['parameters' => [
            'pages' => 'id'
        ]]);
        Route::resource('documentos','\App\Http\Controllers\DocumentosController',['parameters' => [
            'documentos' => 'id'
        ]]);
        Route::resource('qoptions','\App\Http\Controllers\admin\QoptionsController',['parameters' => [
            'qoptions' => 'id'
        ]]);
        Route::resource('permissions','\App\Http\Controllers\admin\UserPermissions',['parameters' => [
            'permissions' => 'id'
        ]]);
        // Route::resource('/users', 'UsersController', ['except' => ['show']]);
        // Route::resource('/players', 'PlayersController', ['except' => ['show']]);
        // Route::resource('/players/order', 'PlayersController@postSort');
        // Route::resource('/banners', 'BannersController', ['except' => ['show']]);
        // Route::resource('/banners/order', 'BannersController@postSort');
        // Route::resource('/floaters', 'FloatersController', ['except' => ['show']]);
        // Route::resource('/floaters/order', 'FloatersController@postSort');
        // Route::resource('/pages', 'PagesController', ['except' => ['show']]);
        // Route::resource('/pages/order', 'PagesController@postSort');
        // Route::resource('pages.subpages', 'SubpagesController', ['except' => 'show']);
        // Route::resource('/receivers', 'ReceiversController', ['except' => ['show']]);
        // Route::resource('/contacts', 'ContactsController', ['except' => ['show']]);
        // Route::resource('/sections', 'SectionsController', ['except' => ['show']]);

        Route::resource('/biddings', '\App\Http\Controllers\admin\BiddingsController', ['except' => ['show']]);
        Route::resource('/attachments', '\App\Http\Controllers\admin\AttachmentsController', ['except' => ['show']]);
        Route::resource('biddings.attachments', '\App\Http\Controllers\admin\AttachmentsController', ['except' => ['show']]);
        // Route::resource('biddings.notifications', '\App\Http\Controllers\admin\NotificationsController', ['except' => ['show']]);
        // Route::resource('biddings.newsletters', '\App\Http\Controllers\admin\BiddingNewslettersController', ['except' => ['show']]);
        Route::resource('/biddings/{parent_id}/attachments/order', '\App\Http\Controllers\admin\AttachmentsController@postSort');

        // Route::resource('/b_trimestrals', 'B_trimestralsController', ['except' => ['show']]);
        // Route::resource('/attachments', 'A_trimestralsController', ['except' => ['show']]);
        // Route::resource('b_trimestrals.attachments', 'A_trimestralsController', ['except' => ['show']]);
        // Route::resource('b_trimestrals.notifications', 'NotificationsController', ['except' => ['show']]);
        // Route::resource('b_trimestrals.newsletters', 'BiddingNewslettersController', ['except' => ['show']]);
        // Route::resource('/b_trimestrals/{parent_id}/attachments/order', 'A_trimestralsController@postSort');

        // Route::resource('/file_uploads', 'UploadsController', ['only' => ['index', 'create', 'store', 'show', 'destroy']]);
        // Route::resource('/categories', 'CategoriesController', ['except' => ['show']]);
        // Route::resource('/categories/order', 'CategoriesController@postSort');
        Route::resource('/bidding_categories', '\App\Http\Controllers\admin\BiddingCategoriesController', ['except' => ['show']]);
        // Route::resource('/bidding_categories/order', 'BiddingCategoriesController@postSort');
        // Route::resource('/posts', 'PostsController', ['except' => ['show']]);
        // Route::resource('/notices', 'NoticesController', ['except' => ['show']]);
        // Route::resource('/newsletters', 'NewslettersController', ['except' => ['show']]);
        // Route::resource('/posts/order', 'PostsController@postSort');
        // Route::resource('/diaries', 'DiariesController', ['except' => ['show']]);
        // Route::resource('/docs', 'docsController', ['except' => ['show']]);
        // Route::get('/test', 'testController@index');
        Route::resource('/docfile', '\App\Http\Controllers\admin\DocfileController',['parameters' => [
            'docfile' => 'id'
        ]]);
        Route::get('/pefil',[EtapaController::class,'index'])->name('sistema.perfil');
        Route::get('/pefil',[UserController::class,'perfilShow'])->name('perfil.show');
        Route::get('/pefil/edit',[UserController::class,'perfilEdit'])->name('perfil.edit');

        Route::get('/config',[EtapaController::class,'config'])->name('sistema.config');
        Route::post('/{id}',[EtapaController::class,'update'])->where('id', '[0-9]+')->name('sistema.update-ajax');

    });
});
