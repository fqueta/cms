<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'name' => 'Fernando Queta',
                'email' => 'fernando@maisaqui.com.br',
                'password' => Hash::make('ferqueta'),
                'status' => 'actived',
                'verificado' => 'n',
                'id_permission' => '1',
            ],
            [
                'name' => 'Usuario de teste',
                'email' => 'teste@databrasil.app.br',
                'password' => Hash::make('mudar123'),
                'status' => 'actived',
                'verificado' => 'n',
                'id_permission' => '2',
            ],
            [
                'name' => 'Usuario de teste front',
                'email' => 'ger.maisaqui1@gmail.com',
                'password' => Hash::make('mudar123'),
                'status' => 'actived',
                'verificado' => 'n',
                'id_permission' => '5',
            ],
        ];
        User::truncate();
        foreach ($arr as $key => $value) {
            User::create($value);
        }
        //Aproveitando para incluir dados padroes para os processos de licitações
        DB::table('bidding_categories')->insert(['name' => 'Pregão', 'name' => 'Concorrência', 'name' => 'Tomada de preço']);
        DB::table('bidding_phases')->insert(['name' => 'Aberto', 'name' => 'Finalizado']);
    }
}
