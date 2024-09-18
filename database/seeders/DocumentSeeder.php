<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Qlib\Qlib;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::truncate();
        $arr = [
            'leis'=>[
                'token'=>'leis',
                'nome'=>'Leis',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'leis'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'guid'=>['label'=>'Nº da edição','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_title'=>['label'=>'Nome','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'12'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_date_gmt'=>['label'=>'Data','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
                    'post_content'=>['label'=>'Descrição (opcional)','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    // 'post_author'=>['label'=>'Autor','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
                    'post_status'=>['label'=>'Publicar','active'=>true,'type'=>'chave_checkbox','value'=>'publish','valor_padrao'=>'publish','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['publish'=>'Publicado','pending'=>'Pendente']],
                ]),
                'tipo'=>'html',
                'ativo'=>'s',
                'autor'=>null,
                'conteudo'=>null,
                'excluido'=>'n',
                'reg_excluido'=>'',
                'deletado'=>'n',
                'reg_deletado'=>'',

            ],
            'concursos'=>[
                'token'=>'concursos',
                'nome'=>'Concursos',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'concursos'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'guid'=>['label'=>'Nº da edição','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_title'=>['label'=>'Nome','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'12'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_date_gmt'=>['label'=>'Data','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
                    'post_content'=>['label'=>'Descrição (opcional)','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    // 'post_author'=>['label'=>'Autor','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
                    'post_status'=>['label'=>'Publicar','active'=>true,'type'=>'chave_checkbox','value'=>'publish','valor_padrao'=>'publish','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['publish'=>'Publicado','pending'=>'Pendente']],
                ]),
                'tipo'=>'html',
                'ativo'=>'s',
                'autor'=>null,
                'conteudo'=>null,
                'excluido'=>'n',
                'reg_excluido'=>'',
                'deletado'=>'n',
                'reg_deletado'=>'',

            ],
            'decretos'=>[
                'token'=>'decretos',
                'nome'=>'Decretos',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'decretos'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'guid'=>['label'=>'Nº da edição','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_title'=>['label'=>'Nome','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'12'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_date_gmt'=>['label'=>'Data','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
                    'post_content'=>['label'=>'Descrição (opcional)','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    // 'post_author'=>['label'=>'Autor','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
                    'post_status'=>['label'=>'Publicar','active'=>true,'type'=>'chave_checkbox','value'=>'publish','valor_padrao'=>'publish','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['publish'=>'Publicado','pending'=>'Pendente']],
                ]),
                'tipo'=>'html',
                'ativo'=>'s',
                'autor'=>null,
                'conteudo'=>null,
                'excluido'=>'n',
                'reg_excluido'=>'',
                'deletado'=>'n',
                'reg_deletado'=>'',

            ],
        ];
        foreach ($arr as $key => $value) {
            Documento::create($value);
        }
    }
}
