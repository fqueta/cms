<?php
namespace Database\Seeders;

use App\Models\Company;
use App\Models\Prefeituras;
use App\Tenant\Tenant;
use Database\Seeders\tenant\UserTenantSeeder;
use Database\Seeders\tenant\MenuTenantSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { //db:seed --database=company1
        // $connection = DB::getDefaultConnection();
        // $company = Prefeituras::where('prefix', $connection)->first();
        // //dd($company);
        // Tenant::setTenant($company);
        $this->call([
            UserTenantSeeder::class,
            escolaridadeSeeder::class,
            estadocivilSeeder::class,
            ProfissaoSeeder::class,
            // PrefeiturasSeeder::class,
            tagSeeder::class,
            MenuTenantSeeder::class,
            PermissionSeeder::class,
            QoptionSeeder::class,

        ]);
        // $this->call(CategoriesTableSeeder::class);
    }
}
