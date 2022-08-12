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
