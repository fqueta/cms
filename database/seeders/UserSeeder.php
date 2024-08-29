<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
                'nome' => 'Fernando Queta',
                'email' => 'fernando@maisaqui.com.br',
                'password' => Hash::make('ferqueta'),
                'status' => 'actived',
                'verificado' => 'n',
                'id_permission' => '1',
            ],
            [
                'nome' => 'Usuario de teste',
                'email' => 'teste@databrasil.app.br',
                'password' => Hash::make('mudar123'),
                'status' => 'actived',
                'verificado' => 'n',
                'id_permission' => '2',
            ],
            [
                'nome' => 'Usuario de teste front',
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
    }
}
