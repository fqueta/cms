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
                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
            'diarios'=>[
                'token'=>'diarios',
                'nome'=>'Diários Oficiais',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'diarios'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'guid'=>['label'=>'Nº da edição','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_title'=>['label'=>'Nome','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'12'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_date_gmt'=>['label'=>'Data','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
                    'post_content'=>['label'=>'Descrição (opcional)','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
            'portarias'=>[
                'token'=>'portarias',
                'nome'=>'Portarias',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'portarias'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'guid'=>['label'=>'Nº da edição','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_title'=>['label'=>'Nome','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'12'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_date_gmt'=>['label'=>'Data','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
                    'post_content'=>['label'=>'Descrição (opcional)','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
            'convenios'=>[
                'token'=>'convenios',
                'nome'=>'Convênios',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'convenios'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'config[situacao]'=>[
                        'label'=>'Situação',
                        'active'=>true,
                        'type'=>'select',
                        'arr_opc'=>['Em análise'=>'Em análise','Andamento'=>'Andamento','Finalizado'=>'Finalizado'],'exibe_busca'=>'d-block',
                        'event'=>'',
                        'tam'=>'6',
                        'class'=>'',
                        'cp_busca'=>'config][situacao','class_div'=>'',
                    ],
                    'guid'=>['label'=>'Nº da convênio','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'6'],
                    'config[esfera]'=>[
                        'label'=>'Esfera',
                        'active'=>true,
                        'type'=>'select',
                        'arr_opc'=>['Federal'=>'Federal','Estadual'=>'Estadual'],'exibe_busca'=>'d-block',
                        'event'=>'',
                        'tam'=>'12',
                        'class'=>'',
                        'cp_busca'=>'config][esfera','class_div'=>' ',
                    ],

                    'config[vigencia]'=>['label'=>'Vigência','cp_busca'=>'config][vigencia','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'4'],
                    'config[celebracao]'=>['label'=>'Celebração','cp_busca'=>'config][celebracao','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'4'],
                    'post_date_gmt'=>['label'=>'Data da publicação','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'4'],
                    'config[conta_bancaria]'=>['label'=>'Conta Bancária','cp_busca'=>'config][conta_bancaria','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'required','tam'=>'6'],
                    'post_title'=>['label'=>'Número do instrumento','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'6'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_content'=>['label'=>'Informações do Objeto','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    'config[contrapartida]'=>['label'=>'Contrapartida','cp_busca'=>'config][contrapartida','active'=>false,'placeholder'=>'','type'=>'moeda','exibe_busca'=>'d-block','event'=>'','tam'=>'4'],
                    'config[transferencia]'=>['label'=>'Trasferência','cp_busca'=>'config][transferencia','active'=>true,'placeholder'=>'','type'=>'moeda','exibe_busca'=>'d-block','event'=>'','tam'=>'4'],
                    'config[pactuada]'=>['label'=>'Pactuada','cp_busca'=>'config][pactuada','active'=>true,'placeholder'=>'','type'=>'moeda','exibe_busca'=>'d-block','event'=>'','tam'=>'4'],

                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
            'archives'=>[
                'token'=>'archives',
                'nome'=>'Arquivos',
                'url'=>'',
                'config'=>Qlib::lib_array_json([
                    'ID'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    'post_type'=>['label'=>'tipo de post','active'=>false,'type'=>'hidden','exibe_busca'=>'d-none','event'=>'','tam'=>'2','value'=> 'archives'],
                    'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
                    // 'guid'=>['label'=>'Nº da edição','active'=>true,'placeholder'=>'','type'=>'number','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'guid'=>[
                        'label'=>'Categoria',
                        'active'=>true,
                        'type'=>'select',
                        'arr_opc'=>['Federal'=>'Federal','Estadual'=>'Estadual'],'exibe_busca'=>'d-block',
                        'event'=>'',
                        'tam'=>'12',
                        'class'=>'',
                        // 'cp_busca'=>'config][esfera',
                        'class_div'=>' ',
                    ],
                    'post_title'=>['label'=>'Nome','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'onkeyup=lib_typeSlug(this) required','tam'=>'12'],
                    'post_name'=>['label'=>'Slug','active'=>false,'placeholder'=>'Ex.: slug-do-post','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
                    'post_date_gmt'=>['label'=>'Data','active'=>true,'placeholder'=>'','type'=>'date','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
                    'post_content'=>['label'=>'Descrição (opcional)','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','class_div'=>'','class'=>'summernote','placeholder'=>__('Escreva seu conteúdo aqui..')],
                    'post_author'=>['label'=>'Autor','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
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
