<?php

namespace Database\Seeders;

use App\Models\Qoption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qoption::truncate();
        DB::table('qoptions')->insert([
            [
                'nome'=>'Integração com o wordpress',
                'url'=>'i_wp',
                'valor'=>'s',
                'obs'=>'',
            ],
            [
                'nome'=>'Permissão padrão FrontEnd',
                'url'=>'id_permission_front',
                'valor'=>'5',
                'obs'=>'',
            ],
            [
                'nome'=>'Editor padrão',
                'url'=>'editor_padrao',
                'valor'=>'tinymce',
                'obs'=>'opçoes: Laraberg, summernonet ou tinymce',
            ],
            [
                'nome'=>'Nome da Empresa',
                'url'=>'empresa',
                'valor'=>'AMS marketing',
                'obs'=>'',
            ],
        ]);
    }
}
