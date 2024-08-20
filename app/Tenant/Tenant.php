<?php
declare(strict_types=1);

namespace App\Tenant;


use App\Models\Prefeituras;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;

class Tenant
{
    private static $tenant;

    public static function getTenant(): ?Prefeituras
    {
        return self::$tenant;
    }

    /**
     * @param Prefeituras $tenant
     */
    public static function setTenant(?Prefeituras $tenant): void
    {
        self::$tenant = $tenant;
        self::makeTenantConnection();
    }

    private static function makeTenantConnection()
    {
        $clone = config('database.connections.system');
        $clone['database'] = self::$tenant->database;
        Config::set('database.connections.tenant', $clone);
        $connection = 'tenant';
        DB::reconnect($connection);
        DB::setDefaultConnection($connection);
        // $cone = DB::getDefaultConnection();
        // dd($cone);
    }

    public static function loadConnections()
    {
        if (Schema::hasTable((new Prefeituras())->getTable())) {
            $companies = Prefeituras::all();
            foreach ($companies as $prefeituras) {
                $clone = config('database.connections.system');
                $clone['database'] = $prefeituras->database;
                Config::set("database.connections.{$prefeituras->prefix}", $clone); //Prefeituras1
            }
        }
    }

    public static function isTenantRequest(){
        //return ! Request::is('system/*') && Request::route('prefix');
        return ! Request::is('gerente.*') && Request::root();
    }

    public static function testeTen()
    {
        return 'funciona';
    }

}
