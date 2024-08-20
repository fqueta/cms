<?php

namespace Database\Seeders;

use App\Qlib\Qlib;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefeiturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prefeituras')->insert([
            [
                'nome'=>'pefeitura demo 1',
                'database'=>'cms_pdemo1',
                'prefix'=>'cms1',
                // 'config'=>Qlib::lib_array_json([
                //     'name'=>'cms_pdemo1',
                //     'user'=>'root',
                //     'pass'=>'',
                // ]),
                'criar_table'=>'s',
                'ativo'=>'s',
            ],
            [
                'nome'=>'Prefeitura demo 2',
                'database'=>'cms_pdemo2',
                'prefix'=>'cms2',
                // 'config'=>Qlib::lib_array_json([
                //     'name'=>'cms_pdemo1',
                //     'user'=>'root',
                //     'pass'=>'',
                // ]),
                'criar_table'=>'s',
                'ativo'=>'s',
            ],
        ]);
    }
}
