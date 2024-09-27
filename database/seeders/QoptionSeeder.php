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
                'valor'=>'n',
                'obs'=>'',
            ],
            [
                'nome'=>'Permissão padrão FrontEnd',
                'url'=>'id_permission_front',
                'valor'=>'6',
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
            [
                'nome'=>'Mensangem de cadastro de sucesso no e-sic',
                'url'=>'mens_sucesso_cad_esic',
                'valor'=>'<br>Foi enviado um email de confirmação de cadastro para você. <p><b>Atenção:</b> para que consiga enviar uma solicitação é necessário confirmar o seu cadastro, acessando o email que foi enviado para sua caixa de entrada.</p><p><b>Alerta:</b> Se não encontar em sua caixa de entrada verifique a caixa de spam ou de lixo eletrônico, de seu email</p>',
                'obs'=>'',
            ],
            [
                'nome'=>'Mensangem padarão de email no e-sic',
                'url'=>'email-info-sic',
                'valor'=>'{mensagem}',
                'obs'=>'',
            ],
        ]);
    }
}
