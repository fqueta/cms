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
        DB::table('menus')->truncate();
        DB::table('menus')->insert([

            [
                'categoria'=>'',
                'description'=>'Painel',
                'icon'=>'fa fa-tachometer-alt',
                'actived'=>true,
                'url'=>'painel',
                'route'=>'home.admin',
                'pai'=>''
            ],
            [
                'categoria'=>'MÓDULOS',
                'description'=>'Postagens do Site',
                'icon'=>'fas fa-globe',
                'actived'=>true,
                'url'=>'cad-conteudo',
                'route'=>'',
                'pai'=>''
            ],
            [
                'categoria'=>'',
                'description'=>'Posts',
                'icon'=>'fas fa-blog',
                'actived'=>true,
                'url'=>'posts',
                'route'=>'posts.index',
                'pai'=>'cad-conteudo'
            ],
            [
                'categoria'=>'',
                'description'=>'Paginas',
                'icon'=>'fas fa-file',
                'actived'=>true,
                'url'=>'pages',
                'route'=>'pages.index',
                'pai'=>'cad-conteudo'
            ],
            [
                'categoria'=>'',
                'description'=>'Sic',
                'icon'=>'fas fa-info',
                'actived'=>true,
                'url'=>'admin.sic',
                'route'=>'',
                'pai'=>''
            ],
            [
                'categoria'=>'',
                'description'=>'Solicitações',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'sic',
                'route'=>'admin.sic.index',
                'pai'=>'admin.sic'
            ],
            [
                'categoria'=>'',
                'description'=>'Relatórios',
                'icon'=>'fas fa-chart-line',
                'actived'=>true,
                'url'=>'sic',
                'route'=>'admin.sic.relatorios',
                'pai'=>'admin.sic'
            ],
            [
                'categoria'=>'',
                'description'=>'Configurações',
                'icon'=>'fas fa-cog',
                'actived'=>true,
                'url'=>'sic',
                'route'=>'admin.sic.config',
                'pai'=>'admin.sic'
            ],
            [
                'categoria'=>'',
                'description'=>'Licitações',
                'icon'=>'fas fa-gavel',
                'actived'=>true,
                'url'=>'licitacoes',
                'route'=>'',
                'pai'=>''
            ],
            [
                'categoria'=>'',
                'description'=>'Processos',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'biddings',
                'route'=>'biddings.index',
                'pai'=>'licitacoes'
            ],
            [
                'categoria'=>'',
                'description'=>'Categorias',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'biddings_categories',
                'route'=>'biddings_categories.index',
                'pai'=>'licitacoes'
            ],
            [
                'categoria'=>'',
                'description'=>'Fases',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'biddings_phases',
                'route'=>'biddings_phases.index',
                'pai'=>'licitacoes'
            ],
            [
                'categoria'=>'',
                'description'=>'Modalidade',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'biddings_genres',
                'route'=>'biddings_genres.index',
                'pai'=>'licitacoes'
            ],
            [
                'categoria'=>'',
                'description'=>'Tipos',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'biddings_types',
                'route'=>'biddings_types.index',
                'pai'=>'licitacoes'
            ],
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
                'route'=>'perfil.show',
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
                'description'=>'Listas do sistema (Tags)',
                'icon'=>'fas fa-list',
                'actived'=>true,
                'url'=>'tags',
                'route'=>'tags.index',
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
