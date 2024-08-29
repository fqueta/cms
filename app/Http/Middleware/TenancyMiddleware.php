<?php

namespace App\Http\Middleware;

use App\Models\Prefeituras;
use App\Models\User;
use App\Qlib\Qlib;
use App\Tenant\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TenancyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = config('app.url');
        $empresa = $request->tenancy;
        $domain = url('');
        $subdomain = Qlib::is_subdominio();
        // $subdomain = str_replace('api-', '', $subdomain);
        if($subdomain=='gerente'){
            // Qlib::selectDefaultConnection('mysql');
        }else{
            //Encontra o tenance no bando de dados que gerenciamento
            // $urlEmpresa = $empresa.'.'.$url;
            $urlEmpresa = $subdomain;
            $tenancy =  Prefeituras::where('prefix',$urlEmpresa)->firstOrFail();
            $arr_t = $tenancy->toArray();
            session()->push('tenancy', $arr_t);
            if(isset($tenancy->database)){
                Qlib::selectDefaultConnection('tenant',$tenancy->database);
        // dump(\DB::getDefaultConnection());
        // dump(Auth::guard('web')->check());
        // dd(Auth::guard('web')->user());
        // $users = User::all();
        // dd($users);
                // dump(\DB::getDefaultConnection());
            }else{
                return false;
            }
            // if(isset($arr_t['config']) && Qlib::isJson($arr_t['config'])){
                // dump($tenancy->toArray());
                Config::set('adminlte.title', config('app.name').' - '.$tenancy['nome']);
                // $arr_config = Qlib::lib_json_array($arr_t['config']);
                // Tenant::setTenant($tenancy);
            // }
            //carrega a nova coneaxao


        }
        return $next($request);
    }
}
