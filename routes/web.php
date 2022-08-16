<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\UserPermissions;
use App\Http\Controllers\GerenciarGrupo;
use App\Http\Controllers\GerenciarUsuarios;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\BairroController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\EscolaridadeController;
use App\Http\Controllers\EstadocivilController;
use App\Http\Controllers\LotesController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\MapasController;
use App\Http\Controllers\portalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
$prefixo_admin = config('app.prefixo_admin');
$prefixo_site = config('app.prefixo_site');
Route::prefix($prefixo_admin)->group(function(){

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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/',function(){
        return redirect()->route('login');
    });
    //inicio Rotas módulo Sic
    Route::resource('sic','\App\Http\Controllers\admin\sicController',['as'=>'admin','parameters' => ['sic' => 'id']]);
    Route::get('sics/relatorios', ['\App\Http\Controllers\admin\sicController', 'relatorios'])->name('admin.sic.relatorios');
    Route::get('sics/config', ['\App\Http\Controllers\admin\sicController', 'config'])->name('admin.sic.config');
    Route::get('sics/config/{url}', ['\App\Http\Controllers\admin\sicController', 'config'])->name('admin.sic.config.edit');
    //Fim Rotas módulo Sic

    Route::resource('tags','\App\Http\Controllers\admin\TagsController',['parameters' => [
    'tags' => 'id'
]]);
});
Route::get($prefixo_site,[App\Http\Controllers\portalController::class, 'index'])->name('portal');

Route::prefix($prefixo_site.'internautas')->group(function(){
    Route::get('/',[App\Http\Controllers\portalController::class, 'index'])->name('internautas.index');
    Route::get('/cadastrar/{tipo}',[portalController::class, 'cadInternautas'])->name('cad.internautas');
    Route::post('/cadastrar',[portalController::class,'storeInternautas'])->name('internautas.store');
    Route::get('/cadastrar/ac/{tipo}/{id}',[portalController::class,'acaoInternautas'])->name('internautas.acao.get');
    Route::get('/login',[portalController::class,'loginInternautas'])->name('internautas.login');
    Route::get('/logout',[portalController::class,'logoutInternautas'])->name('internautas.logout');
    Route::resource('sic','\App\Http\Controllers\portal\sicController',['parameters' => [
        'sic' => 'id'
    ]]);

});
Route::prefix($prefixo_admin.'/users')->group(function(){
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

Route::prefix($prefixo_admin.'/escolaridades')->group(function(){
    Route::get('/',[EscolaridadeController::class,'index'])->name('escolaridades.index');
    Route::get('/create',[EscolaridadeController::class,'create'])->name('escolaridades.create');
    Route::post('/',[EscolaridadeController::class,'store'])->name('escolaridades.store');
    Route::get('/{id}/show',[EscolaridadeController::class,'show'])->name('escolaridades.show');
    Route::get('/{id}/edit',[EscolaridadeController::class,'edit'])->name('escolaridades.edit');
    Route::put('/{id}',[EscolaridadeController::class,'update'])->where('id', '[0-9]+')->name('escolaridades.update');
    Route::post('/{id}',[EscolaridadeController::class,'update'])->where('id', '[0-9]+')->name('escolaridades.update-ajax');
    Route::delete('/{id}',[EscolaridadeController::class,'destroy'])->where('id', '[0-9]+')->name('escolaridades.destroy');
});
Route::prefix($prefixo_admin.'/estado-civil')->group(function(){
    Route::get('/',[EstadocivilController::class,'index'])->name('estado-civil.index');
    Route::get('/create',[EstadocivilController::class,'create'])->name('estado-civil.create');
    Route::post('/',[EstadocivilController::class,'store'])->name('estado-civil.store');
    Route::get('/{id}/show',[EstadocivilController::class,'show'])->name('estado-civil.show');
    Route::get('/{id}/edit',[EstadocivilController::class,'edit'])->name('estado-civil.edit');
    Route::put('/{id}',[EstadocivilController::class,'update'])->where('id', '[0-9]+')->name('estado-civil.update');
    Route::post('/{id}',[EstadocivilController::class,'update'])->where('id', '[0-9]+')->name('estado-civil.update-ajax');
    Route::delete('/{id}',[EstadocivilController::class,'destroy'])->where('id', '[0-9]+')->name('estado-civil.destroy');
});
Route::prefix($prefixo_admin.'/etapas')->group(function(){
    Route::get('/',[EtapaController::class,'index'])->name('etapas.index');
    Route::get('/create',[EtapaController::class,'create'])->name('etapas.create');
    Route::post('/',[EtapaController::class,'store'])->name('etapas.store');
    Route::get('/{id}/show',[EtapaController::class,'show'])->name('etapas.show');
    Route::get('/{id}/edit',[EtapaController::class,'edit'])->name('etapas.edit');
    Route::put('/{id}',[EtapaController::class,'update'])->where('id', '[0-9]+')->name('etapas.update');
    Route::post('/{id}',[EtapaController::class,'update'])->where('id', '[0-9]+')->name('etapas.update-ajax');
    Route::delete('/{id}',[EtapaController::class,'destroy'])->where('id', '[0-9]+')->name('etapas.destroy');
});
Route::prefix($prefixo_admin.'/relatorios')->group(function(){
    Route::get('/',[RelatoriosController::class,'index'])->name('relatorios.index');
    Route::get('/social',[RelatoriosController::class,'realidadeSocial'])->name('relatorios.social');
    Route::get('/evolucao',[RelatoriosController::class,'create'])->name('relatorios.evolucao');
    Route::get('export/filter', [RelatoriosController::class, 'exportFilter'])->name('relatorios.export_filter');
});
Route::prefix($prefixo_admin.'/sistema')->group(function(){
    Route::get('/pefil',[EtapaController::class,'index'])->name('sistema.perfil');
    Route::get('/config',[EtapaController::class,'config'])->name('sistema.config');
    Route::post('/{id}',[EtapaController::class,'update'])->where('id', '[0-9]+')->name('sistema.update-ajax');
});
Route::prefix('uploads')->group(function(){
    Route::get('/',[uploadController::class,'index'])->name('uploads.index');
    Route::get('/create',[UploadController::class,'create'])->name('uploads.create');
    Route::post('/',[UploadController::class,'store'])->name('uploads.store');
    Route::get('/{id}/show',[UploadController::class,'show'])->name('uploads.show');
    Route::get('/{id}/edit',[UploadController::class,'edit'])->name('uploads.edit');
    Route::put('/{id}',[UploadController::class,'update'])->where('id', '[0-9]+')->name('uploads.update');
    Route::post('/{id}',[UploadController::class,'update'])->where('id', '[0-9]+')->name('uploads.update-ajax');
    Route::post('/{id}',[UploadController::class,'destroy'])->where('id', '[0-9]+')->name('uploads.destroy');
    Route::get('export/all', [UploadController::class, 'exportAll'])->name('uploads.export_all');
    Route::get('export/filter', [UploadController::class, 'exportFilter'])->name('uploads.export_filter');
});
Route::fallback(function () {
    return view('erro404');
});
Route::get('menu/{id}', [App\Http\Controllers\HomeController::class, 'menu'])->name('menu');
Route::prefix('teste')->group(function(){
    Route::get('/',[App\Http\Controllers\TesteController::class,'index'])->name('teste');
    Route::get('/ajax',[App\Http\Controllers\TesteController::class,'ajax'])->name('teste.ajax');
});

//Route::post('/upload',[App\Http\Controllers\UploadFile::class,'upload'])->name('teste.upload');



Auth::routes();


Route::post('/tinymce', function (Request $request) {
    $content = $request->content;
    return view('testes.show')->with(compact('content'));
})->name('tinymce.store');
/*
Route::prefix('admin')->group(function(){
    Route::get('/home', [App\Http\Controllers\admin\homeController::class, 'index'])->name('home.admin');
    Route::resource('cursos','\App\Http\Controllers\admin\CursosController',['parameters' => [
        'cursos' => 'id'
    ]]);
    Route::resource('categorias','\App\Http\Controllers\admin\CategoriasController',['parameters' => [
        'categorias' => 'id'
    ]]);
    Route::resource('modulos','\App\Http\Controllers\admin\ModulosController',['parameters' => [
        'modulos' => 'id'
    ]]);
    Route::resource('provas','\App\Http\Controllers\admin\ProvasController',['parameters' => [
        'questoes' => 'id'
    ]]);
    Route::resource('questoes','\App\Http\Controllers\admin\QuestoesController',['parameters' => [
        'questoes' => 'id'
    ]]);
});*/

Route::get('envio-mails',function(){
    $user = new stdClass();
    $user->name = 'Fernando Queta';
    $user->email = 'ferqueta@yahoo.com.br';
    return new \App\Mail\sic\infoSolicitacao($user);
    //$enviar = Mail::send(new \App\Mail\dataBrasil($user));
    //return $enviar;
});
Route::get('envio-mails-veriuser',function(){
    $user = new stdClass();
    $user->name = 'Fernando Queta';
    $user->email = 'ferqueta@yahoo.com.br';
    //return new \App\Mail\veriUser($user);
    $enviar = Mail::send(new \App\Mail\veriUser($user));
    return $enviar;
});

/*
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});*/
