<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrPermiss = [
            "master"=>
            [
                "ler"=>["cad-conteudo"=>"s","cad-post"=>"s","posts"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","bairros"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","documentos"=>"s","qoptions"=>"s","config"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s"],
                "ler_arquivos"=>["cad-conteudo"=>"s","cad-post"=>"s","posts"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","bairros"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","documentos"=>"s","qoptions"=>"s","config"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s"],
                "create"=>["posts"=>"s","bairros"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s","documentos"=>"s","qoptions"=>"s"],
                "update"=>["posts"=>"s","bairros"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s","documentos"=>"s","qoptions"=>"s"],
                "delete"=>["posts"=>"s","bairros"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s","documentos"=>"s","qoptions"=>"s"]
            ],
            "admin"=>
            [
                "ler"=>["cad-conteudo"=>"s","cad-post"=>"s","posts"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","bairros"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios"=>"n","relatorios_social"=>"n","relatorios_evolucao"=>"n","documentos"=>"s","config"=>"s","sistema"=>"n","users"=>"s","permissions"=>"s"],
                "ler_arquivos"=>["cad-conteudo"=>"s","cad-post"=>"s","posts"=>"s","pages"=>"s","lotes"=>"s","beneficiarios"=>"s","bairros"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios"=>"n","relatorios_social"=>"n","relatorios_evolucao"=>"n","documentos"=>"s","config"=>"s","sistema"=>"n","users"=>"s","permissions"=>"s"],
                "create"=>["posts"=>"s","pages"=>"s","lotes"=>"s","bairros"=>"s","beneficiarios"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s","documentos"=>"s"],
                "update"=>["posts"=>"s","pages"=>"s","lotes"=>"s","bairros"=>"s","beneficiarios"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s","documentos"=>"s"],
                "delete"=>["posts"=>"s","pages"=>"s","lotes"=>"s","bairros"=>"s","beneficiarios"=>"s","etapas"=>"s","escolaridades"=>"s","estado-civil"=>"s","relatorios_social"=>"s","relatorios_evolucao"=>"s","sistema"=>"s","users"=>"s","permissions"=>"s","documentos"=>"s"]
            ],
        ];
        DB::table('permissions')->insert([
            [
                'name'=>'Master',
                'redirect_login'=>'/admin/home',
                'description'=>'Desenvolvedores',
                'active'=>'s',
                'id_menu'=>json_encode($arrPermiss['master']),
            ],
            [
                'name'=>'Adminstrador',
                'redirect_login'=>'/admin/home',
                'description'=>'Adiminstradores do sistema',
                'active'=>'s',
                'id_menu'=>json_encode($arrPermiss['admin']),
            ],
            [
                'name'=>'Gerente',
                'redirect_login'=>'/admin/home',
                'description'=>'Gerente do sistema menos que administrador secundário',
                'active'=>'s',
                'id_menu'=>json_encode([]),
            ],
            [
                'name'=>'Escritório',
                'redirect_login'=>'/admin/home',
                'description'=>'Pessoas do escritório',
                'active'=>'s',
                'id_menu'=>json_encode([]),
            ],
            [
                'name'=>'Internautas',
                'redirect_login'=>'/internautas',
                'description'=>'Somente Internautas, Sem privilêgios de administração acesso a área restrita do site','active'=>'s',
                'id_menu'=>json_encode([]),
            ],
        ]);
    }
}