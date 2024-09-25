<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\AttachmentsController;
use App\Http\Controllers\admin\PostsController;
use App\Http\Controllers\portal\sicController;
use App\Models\Familia;
use App\Models\User;
use App\Qlib\Qlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $email = (new sicController)->enviarEmail([
        //     'mensagem'=>'Ola seja bem vindo',
        //     // 'arquivos'=>[
        //     //     'sic/anexo/2022081008-0008.pdf',
        //     //     'admin.sic/2022/08/Designações Agosto_1659993647.pdf',
        //     //     'admin.sic/2022/08/Designações Reunião meio de semana_1659993647.pdf',
        //     // ],
        //     'arquivos'=>'',
        //     'assunto'=>'Teste de Sistema de emails',
        //     'nome_supervisor'=>'Responsável por E-sic',
        //     'email_supervisor'=>'ferqueta@yahoo.com.br',
        //     'assunto_supervisor'=>'Enviado para cliente',
        //     'mensagem_supervisor'=>'Foi enviado um email para o supervisor contendo esta informação',
        //     'para_nome'=>'Patrícia Lima Queta',
        //     'para_email'=>'ger.maisaqui1@gmail.com',
        // ]);
        // return $email;
        //$ret = Qlib::redirectLogin();
        //$dados = DB::connection('mysql_ger')->table('contas_usuarios')->where('dominio','=','https://demo.ctloja.com.br/')->get();
        //dd(Qlib::dominio());
    //     $dados = Qlib::dados_tab_SERVER('contas_usuarios');
    //     dd($dados);
    //    //dd(base_path().'/');
    //    //$user = Auth::user();
    //     //$doc = new LotesController($user);
    //     $lote = isset($_GET['lote'])?$_GET['lote']:201;
    //     $oc = isset($_GET['oc'])?$_GET['oc']:289;
    //     $config = [
    //         //'docs'=>$doc->fichaOcupante($lote,$oc),
    //     ];
        // $ret = (new AttachmentsController)->update_attachmeta(4,'pa','josequeta');
        // dd($ret);
        $config=[];
        // $ret = (new PostsController)->short_code('posts-26');
        // $ret = (new PostsController)->get_post(32);
        // dd($ret);

        $ret = (new PostsController)->get_id_by_slug('meu-primeiro-post-3');
        dd($ret);
        // $slug = (new PostsController)->str_slug('meu primeiro post',$id=false);;
        // dd($slug);
        return view('teste',$config);
    }
    public function ajax(){
        $limit = isset($_GET['limit']) ?$_GET['limit'] : 50;
        $page = isset($_GET['page']) ?$_GET['page'] : 1;
        $site=false;

        $urlApi = $site?$site: 'https://po.presidenteolegario.mg.gov.br';
        $link = $urlApi.'/api/diaries?page='.$page.'&limit='.$limit;
        $link_html = dirname(__FILE__).'/html/front.html';
        $dir_img = $urlApi.'/uploads/posts/image_previews/{id}/thumbnail/{image_preview_file_name}';
        $dir_file = $urlApi.'/uploads/diaries/files/{id}/original/{file_file_name}';

        //$arquivo = $this->carregaArquivo($link_html);
        //$temaHTML = explode('<!--separa--->',$arquivo);
        //$api = file_get_contents($link);
        //$arr_api = Qlib::lib_json_array($api);
        /*
        $tema1 = '<ul id="conteudo" class="list-group">{tr}</ul>';
        $tema2 = '<li class="list-group-item" itemprop="headline"><a href="{link_file}" target="_blank">{file_file_name} – {date}</a></li>';
        $tr=false;
        if(isset($arr_api['data']) && !empty($arr_api['data'])){
          foreach ($arr_api['data'] as $key => $value) {
              $link = false;
              $link_file = str_replace('{id}',$value['id'],$dir_file);
              $link_file = str_replace('{file_file_name}',$value['file_file_name'],$link_file);


              $conteudoPost = isset($value['content'])?:false;
              $date = false;
              $time = false;
              $datetime = str_replace(' ','T',$value['date']);
              $d = explode(' ',$value['date']);

              if(isset($d[0])){
                $date = Qlib::dataExibe($d[0]);
              }
              if(isset($d[1])){
                $time = $d[1];
              }
              $file_name = str_replace('.pdf','',$value['file_file_name']);
              $file_name = str_replace('.PDF','',$file_name);
              $tr .= str_replace('{file_file_name}',$file_name,$tema2);
              $tr = str_replace('{link}',$link,$tr);
              $tr = str_replace('{link_file}',$link_file,$tr);
              $tr = str_replace('{time}',$time,$tr);
              $tr = str_replace('{date}',$date,$tr);
              $tr = str_replace('{description}',$value['description'],$tr);
              $tr = str_replace('{datetime}',$datetime,$tr);
          }
        }
        $link_veja_mais = '/diario-oficial';
        $ret = str_replace('{tr}',$tr,$tema1);
        //$ret = str_replace('{id_sec}',$id_sec,$ret);
        $ret = str_replace('{link_veja_mais}',$link_veja_mais,$ret);
        */
        $arr_api=false;
        return response()->json($arr_api);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
