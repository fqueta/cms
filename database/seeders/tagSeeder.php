<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['nome'=>'Tags Secretarias','obs'=>'Secretarias de uma prefeitura'],
            ['nome'=>'Tags Categorias do E-sic','obs'=>'Todas a categorias de assuntos do E-sic de acordo com a secretaria.'],
            [
                'nome'=>'Assessoria de Planejamento Urbanístico',
                'pai'=>1,
                'obs'=>'',
                'config'=>'categorias{"documentos","licitacoes","obras","outras_informacoes"}_sic',
            ],
            [
                'nome'=>'CEJUSC',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Centro de Educação e Desenvolvimento Social',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Administração',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Compras',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Cultura',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Informática',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Serviços',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Transportes',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Tributação',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria de Vigilância Sanitária',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Coordenadoria do Centro de Referência de Assistência Social',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Agricultura e Meio Ambiente',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Desenvolvimento Social',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Educação',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Esportes',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Finanças',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Saúde',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Diretoria de Turismo',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Procurador Jurídico',
                'pai'=>1,
                'obs'=>'',
                'config'=>'{"documentos","licitacoes","obras","outras_informacoes"}',
            ],
            [
                'nome'=>'Documentos',
                'pai'=>2,
                'obs'=>'',
                'value'=>'Documentos',
            ],
            [
                'nome'=>'Licitações',
                'pai'=>2,
                'obs'=>'',
                'value'=>'licitacoes',
            ],
            [
                'nome'=>'Obras',
                'pai'=>2,
                'obs'=>'',
                'value'=>'obras',
            ],
            [
                'nome'=>'Outras Informações',
                'pai'=>2,
                'obs'=>'',
                'value'=>'outra_informcoes',
            ],
        ];

        foreach ($arr as $key => $value) {
            $d = $value;
            $d['value']=uniqid();
            Tag::create($d);
        }
    }
}
