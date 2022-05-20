<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'categoria'=>'',
                'description'=>'Conteúdo do Site',
                'icon'=>'fas fa-wold',
                'actived'=>true,
                'url'=>'cad-conteudo',
                'route'=>'',
                'pai'=>''
            ],
            /*
            [
                'categoria'=>'',
                'description'=>'Gerenciar cursos',
                'icon'=>'fa fa-blog',
                'actived'=>true,
                'url'=>'cad-post',
                'route'=>'',
                'pai'=>''
            ],*/
            [
                'categoria'=>'',
                'description'=>'Posts',
                'icon'=>'fas fa-blog',
                'actived'=>true,
                'url'=>'posts',
                'route'=>'posts.index',
                'pai'=>'cad-conteudo'
            ],
            /*[
                'categoria'=>'',
                'description'=>'Beneficiários',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'beneficiarios',
                'route'=>'beneficiarios.index',
                'pai'=>'cad-conteudo'
            ],
            [
                'categoria'=>'',
                'description'=>'Lotes',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'lotes',
                'route'=>'lotes.index',
                'pai'=>'cad-topografico'
            ],
            [
                'categoria'=>'',
                'description'=>'Quadras',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'quadras',
                'route'=>'quadras.index',
                'pai'=>'cad-topografico'
            ],
            [
                'categoria'=>'',
                'description'=>'Áreas',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'bairros',
                'route'=>'bairros.index',
                'pai'=>'cad-topografico'
            ],
            [
                'categoria'=>'',
                'description'=>'Etapas',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'etapas',
                'route'=>'etapas.index',
                'pai'=>'cad-conteudo'
            ],
            [
                'categoria'=>'',
                'description'=>'Escolaridade',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'escolaridades',
                'route'=>'escolaridades.index',
                'pai'=>'cad-conteudo'
            ],
            [
                'categoria'=>'',
                'description'=>'Estado civil',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'estado-civil',
                'route'=>'estado-civil.index',
                'pai'=>'cad-conteudo'
            ],
            [
                'categoria'=>'',
                'description'=>'Relatórios',
                'icon'=>'fas fa-file',
                'actived'=>true,
                'url'=>'relatorios',
                'route'=>'relatorios.index',
                'pai'=>''
            ],
            [
                'categoria'=>'',
                'description'=>'Realidade Social',
                'icon'=>'fas fa-file',
                'actived'=>true,
                'url'=>'relatorios_social',
                'route'=>'relatorios.social',
                'pai'=>'relatorios'
            ],
            [
                'categoria'=>'',
                'description'=>'Evolução',
                'icon'=>'fa fa-chart-bar',
                'actived'=>true,
                'url'=>'relatorios_evolucao',
                'route'=>'relatorios.evolucao',
                'pai'=>'relatorios'
            ],
            /*[
                'categoria'=>'',
                'description'=>'Listagem de Ocupantes',
                'icon'=>'fa fa-chart-bar',
                'actived'=>true,
                'url'=>'relatorios_evolucao',
                'route'=>'relatorios.evolucao',
                'pai'=>'relatorios'
            ],*/
            [
                'categoria'=>'SISTEMA',
                'description'=>'Configurações',
                'icon'=>'fas fa-cogs',
                'actived'=>true,
                'url'=>'config',
                'route'=>'sistema.config',
                'pai'=>''
            ],
            [
                'categoria'=>'',
                'description'=>'Documentos',
                'icon'=>'fas fa-file-word',
                'actived'=>true,
                'url'=>'documentos',
                'route'=>'documentos.index',
                'pai'=>'config'
            ],
            [
                'categoria'=>'',
                'description'=>'Perfil',
                'icon'=>'fas fa-user',
                'actived'=>true,
                'url'=>'sistema',
                'route'=>'sistema.perfil',
                'pai'=>'config'
            ],
            [
                'categoria'=>'',
                'description'=>'Usuários',
                'icon'=>'fas fa-users',
                'actived'=>true,
                'url'=>'users',
                'route'=>'users.index',
                'pai'=>'config'
            ],
            [
                'categoria'=>'',
                'description'=>'Permissões',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'permissions',
                'route'=>'permissions.index',
                'pai'=>'config'
            ],
            [
                'categoria'=>'',
                'description'=>'Avançado (Dev)',
                'icon'=>'fas fa-user',
                'actived'=>true,
                'url'=>'qoptions',
                'route'=>'qoptions.index',
                'pai'=>'config'
            ],
        ]);
    }
}
