<?php

declare(strict_types=1);

use App\Http\Controllers\admin\AttachmentsController;
use App\Http\Controllers\admin\ConfigController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\portal\sicController;
use App\Http\Controllers\portalController;
use App\Http\Controllers\preview\PreviewController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Qlib\Qlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
global $prefixo_admin,$prefixo_site;
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes();
    Route::fallback(function () {
        if(Auth::check()){
            return view('erro404');
        }else{
            return view('erro404_site');
        }
    });
    $prefixo_admin = config('app.prefixo_admin');
    $prefixo_site = config('app.prefixo_site');
    Route::get('/', [App\Http\Controllers\site\SiteController::class, 'home'])->name('home');
    Route::prefix($prefixo_site.'internautas')->group(function(){
        Route::get('/',[App\Http\Controllers\portalController::class, 'index'])->name('internautas.index');
        Route::get('/cadastrar/{tipo}',[portalController::class, 'cadInternautas'])->name('cad.internautas');
        Route::post('/cadastrar',[portalController::class,'storeInternautas'])->name('internautas.store');
        Route::get('/cadastrar/ac/{tipo}/{id}',[portalController::class,'acaoInternautas'])->name('internautas.acao.get');
        Route::get('/login',[portalController::class,'loginInternautas'])->name('internautas.login');
        Route::get('/quick-login',[portalController::class,'quick_login'])->name('internautas.quick_login');
        Route::get('/logout',[portalController::class,'logoutInternautas'])->name('internautas.logout');
        Route::get('/send-verific-user',[portalController::class,'send_verific_user'])->name('send_verific_user');
        Route::resource('sic','\App\Http\Controllers\portal\sicController',['parameters' => [
            'sic' => 'id'
        ]])->middleware('auth');
        Route::get('sics',[sicController::class,'relatorios'])->name('sic.internautas.relatorios');
    });
    Route::prefix('/'.$prefixo_admin)->group(function(){
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
        Route::resource('biddings_phases','\App\Http\Controllers\admin\DefaultController',['parameters' => [
            'biddings_phases' => 'id'
        ]]);
        Route::resource('biddings_types','\App\Http\Controllers\admin\DefaultController',['parameters' => [
            'biddings_types' => 'id'
        ]]);
        Route::resource('biddings_genres','\App\Http\Controllers\admin\DefaultController',['parameters' => [
            'biddings_genres' => 'id'
        ]]);
        Route::resource('permissions','\App\Http\Controllers\admin\UserPermissions',['parameters' => [
            'permissions' => 'id'
        ]]);
        Route::resource('tags','\App\Http\Controllers\admin\TagsController',['parameters' => [
            'tags' => 'id'
        ]]);
        //inicio Rotas módulo Sic
        Route::resource('sic','\App\Http\Controllers\admin\sicController',['as'=>'admin','parameters' => ['sic' => 'id']]);
        Route::get('sics/relatorios', ['\App\Http\Controllers\admin\sicController', 'relatorios'])->name('admin.sic.relatorios');
        Route::get('sics/config', ['\App\Http\Controllers\admin\sicController', 'config'])->name('admin.sic.config');
        Route::get('sics/config/{url}', ['\App\Http\Controllers\admin\sicController', 'config'])->name('admin.sic.config.edit');
        //Fim Rotas módulo Sic
        Route::prefix('uploads')->group(function(){
            Route::get('/',[uploadController::class,'index'])->name('uploads.index');
            Route::get('/create',[UploadController::class,'create'])->name('uploads.create');
            Route::post('/',[UploadController::class,'store'])->name('uploads.store');
            Route::get('/{id}/show',[UploadController::class,'show'])->name('uploads.show');
            Route::get('/{id}/edit',[UploadController::class,'edit'])->name('uploads.edit');
            Route::put('/{id}',[UploadController::class,'update'])->where('id', '[0-9]+')->name('uploads.update');
            Route::post('/{id}',[UploadController::class,'update'])->where('id', '[0-9]+')->name('uploads.update-ajax');
            Route::post('/{id}/delete',[UploadController::class,'destroy'])->where('id', '[0-9]+')->name('uploads.destroy');
            Route::get('export/all', [UploadController::class, 'exportAll'])->name('uploads.export_all');
            Route::get('export/filter', [UploadController::class, 'exportFilter'])->name('uploads.export_filter');
        });
        Route::prefix('ajax')->group(function(){
            Route::post('/attachments/{id}',[AttachmentsController::class,'update'])->where('id', '[0-9]+')->name('attachments.update-ajax');
            Route::post('/chage_status',[ConfigController::class,'chage_status'])->name('chage_status');
            // Route::post('/attachments/{id}',[AttachmentsController::class,'update'])->where('id', '[0-9]+')->name('attachments.destroy-ajax');
        });
        Route::fallback(function () {
            return view('erro404');
        });
        Route::resource('media','\App\Http\Controllers\admin\mediaController',['parameters' => [
            'media' => 'id'
        ]]);
        Route::prefix('media')->group(function(){
            Route::post('/store-parent',['\App\Http\Controllers\admin\mediaController','storeParent'])->name('store.parent.media');
            Route::post('/trash',['\App\Http\Controllers\admin\mediaController','trash'])->name('trash.media');
            // Route::get('/ajax',[App\Http\Controllers\TesteController::class,'ajax'])->name('teste.ajax');
        });


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

        Route::resource('/biddings', '\App\Http\Controllers\admin\BiddingsController', ['except' => ['show'],'parameters'=>[
            'biddings' => 'id'
        ]]);
        Route::resource('/attachments', '\App\Http\Controllers\admin\AttachmentsController', ['except' => ['show'],'parameters'=>[
            'attachments' => 'id'
        ]]);
        // Route::resource('biddings.attachments', '\App\Http\Controllers\admin\AttachmentsController', ['except' => ['show'],'parameters'=>[
        //     'biddings.attachments' => 'id'
        // ]]);
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
        Route::resource('/biddings_categories', '\App\Http\Controllers\admin\BiddingCategoriesController', ['except' => ['show'],'parameters'=>[
            'biddings_categories' => 'id'
        ]]);
        // Route::resource('/biddings_categories/order', 'BiddingCategoriesController@postSort');
        // Route::resource('/posts', 'PostsController', ['except' => ['show']]);
        // Route::resource('/notices', 'NoticesController', ['except' => ['show']]);
        // Route::resource('/newsletters', 'NewslettersController', ['except' => ['show']]);
        // Route::resource('/posts/order', 'PostsController@postSort');
        // Route::resource('/diaries', 'DiariesController', ['except' => ['show']]);
        // Route::resource('/docs', 'docsController', ['except' => ['show']]);
        Route::get('/test', [TesteController::class,'index']);
        Route::resource('/docfile', '\App\Http\Controllers\admin\DocfileController',['parameters' => [
            'docfile' => 'id'
        ]]);
        Route::resource('/leis', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'leis' => 'id'
        ]]);
        Route::resource('/concursos', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'concursos' => 'id'
        ]]);
        Route::resource('/decretos', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'decretos' => 'id'
        ]]);
        Route::resource('/diarios', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'diarios' => 'id'
        ]]);
        Route::resource('/portarias', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'portarias' => 'id'
        ]]);
        Route::resource('/convenios', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'convenios' => 'id'
        ]]);
        Route::resource('/archives', '\App\Http\Controllers\admin\PostsController',['parameters' => [
            'archives' => 'id'
        ]]);
        Route::resource('/archives_category', '\App\Http\Controllers\admin\DefaultController',['parameters' => [
            'archives_category' => 'id'
        ]]);
        Route::get('/pefil',[EtapaController::class,'index'])->name('sistema.perfil');
        Route::get('/pefil',[UserController::class,'perfilShow'])->name('perfil.show');
        Route::get('/pefil/edit',[UserController::class,'perfilEdit'])->name('perfil.edit');

        Route::get('/config',[EtapaController::class,'config'])->name('sistema.config');
        Route::post('/{id}',[EtapaController::class,'update'])->where('id', '[0-9]+')->name('sistema.update-ajax');

    });

    Route::get('/suspenso',[UserController::class,'suspenso'])->name('cobranca.suspenso');
    Route::prefix('preview')->group(function(){
        Route::get('/posts/{id}',[PreviewController::class,'posts'])->name('preview.posts');
        Route::get('/noticias',[PreviewController::class,'noticias'])->name('preview.noticias');
    });
    Route::prefix('cobranca')->group(function(){
        Route::get('/fechar',[UserController::class,'pararAlertaFaturaVencida'])->name('alerta.cobranca.fechar');
    });

        //inicio Rotas de verificação
    Route::get('/email/verify', function () {
        // return view('auth.verify');
        return view('site.index');
    })->middleware('auth')->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function ( Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message-very', 'enviado');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
});

Route::name('api.')->prefix('api/v1')->middleware([
    'api',
    // 'auth:sanctum',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Route::redirect('/', 'api.login');
    Route::fallback(function () {
        return view('erro404_site');
    });

    Route::post('/login',[ '\App\Http\Controllers\api\AuthController','login']);
    // Route::resource('/pages', 'PostsController', ['only' => ['index', 'show']]);
    // Route::resource('/posts', 'PostsController', ['only' => ['index', 'show', 'update']]);
    // Route::resource('/notices', 'NoticesController', ['only' => ['index']]);
    // Route::resource('/players', 'PlayersController', ['only' => ['index']]);
    // Route::resource('/banners', 'BannersController', ['only' => ['index']]);
    // Route::resource('/floaters', 'FloatersController', ['only' => ['index']]);
    // Route::resource('/biddings', '\App\Http\Controllers\api\BiddingsController', ['only' => ['index']])->middleware('auth:sanctum');
    Route::resource('/biddings', '\App\Http\Controllers\api\BiddingsController', ['only' => ['index']]);
    Route::resource('/documents', '\App\Http\Controllers\api\PostController', ['only' => ['index','show']]);
    // Route::resource('/btrimestrals', 'BtrimestralsController', ['only' => ['index']]);
    // Route::resource('/sections', 'SectionsController', ['only' => ['index']]);
    // Route::resource('/newsletters', 'NewslettersController', ['only' => ['store']]);
    // Route::resource('/contacts', 'ContactsController', ['only' => ['store']]);
    // Route::resource('/uploads', 'UploadsController', ['only' => ['show']]);
    // Route::resource('/search', 'SearchController', ['only' => ['index']]);
    // Route::resource('/diaries', 'DiariesController', ['only' => ['index']]);
});
