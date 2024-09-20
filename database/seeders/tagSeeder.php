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
            ['nome'=>'SECRETARIAS NO SIC','obs'=>'Secretarias de uma prefeitura'],
            ['nome'=>'CATEGORIA DO SIC','obs'=>'Todas a categorias de assuntos do E-sic de acordo com a secretaria.'],
            ['nome'=>'CATEGORIA DE ARQUIVOS','obs'=>'Todas as categorias de arquivos do sistema',"value"=>"archives_category",],
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
            [
                'nome'=>'Educação',
                'pai'=>2,
                'obs'=>'',
                'value'=>'educacao',
            ],
            [
                'nome'=>'Esporte',
                'pai'=>2,
                'obs'=>'',
                'value'=>'esporte',
            ],
            [
                'nome'=>'Finanças',
                'pai'=>2,
                'obs'=>'',
                'value'=>'financas',
            ],
            [
                'nome'=>'Cultura',
                'pai'=>2,
                'obs'=>'',
                'value'=>'cultura',
            ],
            [
                'nome'=>'Iluminação Pública',
                'pai'=>2,
                'obs'=>'',
                'value'=>'iluminacao_publica',
            ],
            [
                'nome'=>'Saneamento Básico',
                'pai'=>2,
                'obs'=>'',
                'value'=>'saneamento_basico',
            ],
            [
                'nome'=>'Concursos Públicos',
                'pai'=>2,
                'obs'=>'',
                'value'=>'concursos_publicos',
            ],
            [
                'nome'=>'Social',
                'pai'=>2,
                'obs'=>'',
                'value'=>'social',
            ],
            [
                'nome'=>'ORIGEM SIC',
                'pai'=>0,
                'obs'=>'Listagem de Origem do E-sic',
                'value'=>'origem_sic',
            ],
            [
                'nome'=>'Carta',
                'pai'=>'origem_sic',
                'obs'=>'Listagem de Origem do E-sic',
                'value'=>'',
            ],
            [
                'nome'=>'E-mail',
                'pai'=>'origem_sic',
                'obs'=>'Listagem de Origem do E-sic',
                'value'=>'',
            ],
            [
                'nome'=>'Pessoalmente',
                'pai'=>'origem_sic',
                'obs'=>'Listagem de Origem do E-sic',
                'value'=>'',
            ],
            [
                'nome'=>'Telefone',
                'pai'=>'origem_sic',
                'obs'=>'Listagem de Origem do E-sic',
                'value'=>'',
            ],
            [
                'nome'=>'Sistema',
                'pai'=>'origem_sic',
                'obs'=>'Sitema Online',
                'value'=>'',
            ],
            [
                'nome'=>'STATUS NO SIC',
                'pai'=>0,
                'obs'=>'Status do E-sic',
                'value'=>'status_sic',
            ],
            [
                'nome'=>'MOTIVOS NO SIC',
                'pai'=>0,
                'obs'=>'Motivos no E-sic',
                'value'=>'motivos_sic',
            ],
            // [
            //     'nome'=>'Abertos',
            //     'pai'=>'status_sic',
            //     'obs'=>'Status no E-sic',
            //     'ordem'=>1,
            //     'value'=>'sic_abertos',
            // ],
            // [
            //     'nome'=>'Respondido',
            //     'pai'=>'status_sic',
            //     'obs'=>'Status no E-sic',
            //     'ordem'=>2,
            //     'value'=>'sic_respondidos',
            // ],
            [
                'nome'=>'Indeferido',
                'pai'=>'status_sic',
                'obs'=>'Status no E-sic',
                'ordem'=>3,
                'value'=>'sic_indeferidos',
            ],
            [
                'nome'=>'Resolvido',
                'pai'=>'status_sic',
                'obs'=>'Status no E-sic',
                'ordem'=>4,
                'value'=>'sic_resolvidos',
            ],
            [
                'nome'=>'Dados Pessoais',
                'pai'=>'motivos_sic',
                'obs'=>'Status no E-sic',
                'ordem'=>1,
                'value'=>'dados_pessoais',
            ],
            [
                'nome'=>'Informação sigilosa conforme LAI ',
                'pai'=>'motivos_sic',
                'obs'=>'Status no E-sic',
                'ordem'=>2,
                'value'=>'info_sigilosa_lai',
            ],
            [
                'nome'=>'Informação sigilosa legislação específica',
                'pai'=>'motivos_sic',
                'obs'=>'Informação sigilosa legislação específica',
                'ordem'=>3,
                'value'=>'info_sigilosa_leg_esp',
            ],
            [
                'nome'=>'Pedido exige tratamento adicional de dados',
                'pai'=>'motivos_sic',
                'obs'=>'Pedido exige tratamento adicional de dados',
                'ordem'=>4,
                'value'=>'exige_tratamento',
            ],
            [
                'nome'=>'Pedido Genérico',
                'pai'=>'motivos_sic',
                'obs'=>'Pedido Genérico',
                'ordem'=>5,
                'value'=>'pedido_generico',
            ],
            [
                'nome'=>'Pedido Incompreensível',
                'pai'=>'motivos_sic',
                'obs'=>'Pedido Incompreensível',
                'ordem'=>6,
                'value'=>'incompreensivel',
            ],
            [
                'nome'=>'Processo decisório em curso',
                'pai'=>'motivos_sic',
                'obs'=>'Processo decisório em curso',
                'ordem'=>7,
                'value'=>'processo_decisorio_curso',
            ],
            [
                'nome'=>'Outro',
                'pai'=>'motivos_sic',
                'obs'=>'Outro',
                'ordem'=>8,
                'value'=>'outro',
            ],
            [
                'nome'=>'TIPO PJ',
                'pai'=>0,
                'obs'=>'Tipo de pessoa jurídica',
                'ordem'=>10,
                'value'=>'tipo_pj',
            ],
            [
                "nome"=>"EMPRESA - PME",
                "pai"=>"tipo_pj",
                "obs"=>"",
                "ordem"=>1,
                "value"=>"pme",
            ],
            [
                "nome"=>"INSTITUIÇÃO DE ENSINO E/OU PESQUISA",
                "pai"=>"tipo_pj",
                "obs"=>"",
                "ordem"=>2,
                "value"=>"iep",
            ],
            [
                "nome"=>"VEÍCULO DE COMUNICAÇÃO",
                "pai"=>"tipo_pj",
                "obs"=>"",
                "ordem"=>3,
                "value"=>"vc",
            ],

        ];
        Tag::truncate();
        foreach ($arr as $key => $value) {
            $d = $value;
            $d['value']= isset($value['value']) ? $value['value'] :  uniqid();
            Tag::create($d);
        }
    }
}
