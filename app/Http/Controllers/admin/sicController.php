<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\portal\sicController as PortalSicController;
use App\Models\_upload;
use App\Models\Sic;
use App\Models\User;
use App\Qlib\Qlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sicController extends Controller
{
    private $sic;
    public $user;
    public $routa;
    public $label;
    public $url;
    public $ambiente;
    public $pai_motivo;
    public $pai_status;

    public function __construct()
    {
        $user = Auth::user();
        $this->sic = new PortalSicController();
        $this->user = $user;
        $this->ambiente = Qlib::ambiente();
        $this->routa = 'admin.sic';
        $this->label = 'Sic';
        $this->url = 'sic';
        $this->view = 'admin.sic';
        $this->pai_status = 'status_sic';
        $this->pai_motivo = 'motivos_sic';

    }
    public function index(){
        $this->authorize('ler', $this->routa);
        $title = 'Cadastro de sic';
        $titulo = $title;
        $querySic = $this->sic->querySic($_GET);
        $querySic['config']['exibe'] = 'html';
        $routa = $this->routa;
        return view($this->view.'.index',[
            'dados'=>$querySic['sic'],
            'title'=>$title,
            'titulo'=>$titulo,
            'campos_tabela'=>$this->campos(),
            'sic_totais'=>$querySic['sic_totais'],
            'titulo_tabela'=>$querySic['tituloTabela'],
            'arr_titulo'=>$querySic['arr_titulo'],
            'config'=>$querySic['config'],
            'routa'=>$routa,
            'url'=>$this->url,
            'view'=>$this->view,
            'i'=>0,
        ]);
    }
    public function campos(){
        return [
            'id'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'info'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>Qlib::formatMensagemInfo('Preencha os campos abaixo para enviar sua solicitação de informação. Serviço disponibilizado conforme Art. 10, da Lei 12.527/11.','info'),'tam'=>'12'],
            //'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'protocolo'=>['label'=>'Protocolo','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            'config[secretaria]'=>[
                'label'=>'Secretaria',
                'active'=>true,
                'id'=>'secretaria',
                'type'=>'select',
                'arr_opc'=>Qlib::sql_array("SELECT id,nome FROM tags WHERE ativo='s' AND pai='1'",'nome','id'),
                'exibe_busca'=>'d-block',
                'event'=>'',
                'tam'=>'12',
                'class'=>'',
                'title'=>'',
                'exibe_busca'=>true,
                'option_select'=>true,
                'cp_busca'=>'config][secretaria',
            ],
            'config[categoria]'=>[
                'label'=>'Categoria*',
                'active'=>true,
                'id'=>'categoria',
                'type'=>'select',
                'arr_opc'=>Qlib::sql_array("SELECT id,nome FROM tags WHERE ativo='s' AND pai='2'",'nome','id'),
                'exibe_busca'=>'d-block',
                'event'=>'',
                'tam'=>'12',
                'class'=>'',
                'title'=>'',
                'exibe_busca'=>true,
                'option_select'=>true,
                'cp_busca'=>'config][categoria',
            ],
            'config[assunto]'=>['label'=>'Assunto*','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-none','cp_busca'=>'config][assunto','event'=>'','tam'=>'12'],
            //'nome'=>['label'=>'Nome','active'=>true,'placeholder'=>'Ex.: Ensino médio completo','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            //'ativo'=>['label'=>'Ativado','active'=>true,'type'=>'chave_checkbox','value'=>'s','valor_padrao'=>'s','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
            'mensagem'=>['label'=>'Mensagem*','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
            'arquivo'=>['label'=>'Anexos','active'=>false,'placeholder'=>'Anexar arquivos','type'=>'file','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            'info1'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>'<p>* Formatos de arquivo aceitos: PDF, JPG, JPEG, GIF, PNG, MP4, RAR e ZIP. Tamanho máximo permitido: 10 MB.</p>','tam'=>'12'],
            'info2'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>Qlib::formatMensagemInfo('<label for="preservarIdentidade"><input name="config[preservarIdentidade]" type="checkbox" id="preservarIdentidade"> Gostaria de ter a minha identidade preservada neste pedido, em atendimento ao princípio constitucional da impessoalidade e, ainda, conforme o disposto no art. 10, § 7º da Lei nº 13.460/2017.</label>','warning'),'tam'=>'12'],
        ];
    }
    public function campos_status($pai=false){
        return [
            'id'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','placeholder'=>''],
            'pai'=>['label'=>'pai','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'3','value'=>$pai],
            'nome'=>['label'=>'Nome','active'=>true,'type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'12','placeholder'=>'','class_div'=>''],
            'obs'=>['label'=>'Descrição','active'=>true,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12','placeholder'=>''],
            'ativo'=>['label'=>'ativo','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12','value'=>'s'],
        ];
    }
    public function campos_resposta(){
        $pai_status = $this->pai_status;
        $pai_motivo = $this->pai_motivo;
        return [
            'id'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'info'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>Qlib::formatMensagemInfo('Preencha os campos abaixo para enviar uma resposta a solicitação acima de informação. Serviço disponibilizado conforme Art. 10, da Lei 12.527/11.','info'),'tam'=>'12'],
            'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'protocolo'=>['label'=>'Protocolo','active'=>true,'placeholder'=>'','type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            'status'=>[
                'label'=>'Status',
                'active'=>true,
                'id'=>'status',
                'type'=>'selector',
                'data_selector'=>[
                    'campos'=>$this->campos_status($pai_status),
                    'route_index'=>route('tags.index'),
                    'id_form'=>'frm-tags',
                    'action'=>route('tags.store'),
                    'campo_id'=>'id',
                    'campo_bus'=>'nome',
                    'label'=>'Tag',
                ],
                'arr_opc'=>Qlib::sql_array("SELECT id,nome FROM tags WHERE ativo='s' AND pai='$this->pai_status'",'nome','id'),
                'exibe_busca'=>'d-block',
                'event'=>'required',
                'tam'=>'6',
                'class'=>'',
                'title'=>'',
                'exibe_busca'=>true,
                'option_select'=>true,
            ],
            'motivo'=>[
                'label'=>'Motivo',
                'active'=>true,
                'id'=>'motivo',
                'type'=>'selector',
                'data_selector'=>[
                    'campos'=>$this->campos_status($pai_motivo),
                    'route_index'=>route('tags.index'),
                    'id_form'=>'frm-tags',
                    'action'=>route('tags.store'),
                    'campo_id'=>'id',
                    'campo_bus'=>'nome',
                    'label'=>'Tag',
                ],
                'arr_opc'=>Qlib::sql_array("SELECT id,nome FROM tags WHERE ativo='s' AND pai='$this->pai_motivo'",'nome','id'),
                'exibe_busca'=>'d-block',
                'event'=>'',
                'tam'=>'6',
                'class'=>'',
                'title'=>'',
                'exibe_busca'=>true,
                'option_select'=>true,
            ],
            //'config[assunto]'=>['label'=>'Assunto*','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-none','cp_busca'=>'config][assunto','event'=>'','tam'=>'12'],
            //'nome'=>['label'=>'Nome','active'=>true,'placeholder'=>'Ex.: Ensino médio completo','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            'resposta'=>['label'=>'Resposta*','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'required','tam'=>'12','class'=>'summernote'],
            'meta[enviar_email]'=>['label'=>'Enviar resposta por e-mail','active'=>true,'type'=>'chave_checkbox','value'=>'s','valor_padrao'=>'s','exibe_busca'=>'d-block','event'=>'','tam'=>'12','arr_opc'=>['s'=>'Sim','n'=>'Não'],'cp_busca'=>'meta][enviar_email'],

            //'info1'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>'<p>* Formatos de arquivo aceitos: PDF, JPG, JPEG, GIF, PNG, MP4, RAR e ZIP. Tamanho máximo permitido: 10 MB.</p>','tam'=>'12'],
            //'info2'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>Qlib::formatMensagemInfo('<label for="preservarIdentidade"><input name="config[preservarIdentidade]" type="checkbox" id="preservarIdentidade"> Gostaria de ter a minha identidade preservada neste pedido, em atendimento ao princípio constitucional da impessoalidade e, ainda, conforme o disposto no art. 10, § 7º da Lei nº 13.460/2017.</label>','warning'),'tam'=>'12'],
        ];
    }
    public function show($id){
        $dados = Sic::findOrFail($id);
        $this->authorize('ler', $this->routa);
        if(!empty($dados)){
            $title = 'Cadastro da família';
            $titulo = $title;
            $dados['ac'] = 'alt';
            if(isset($dados['config'])){
                $dados['config'] = Qlib::lib_json_array($dados['config']);
            }
            $arr_escolaridade = Qlib::sql_array("SELECT id,nome FROM escolaridades ORDER BY nome ", 'nome', 'id');
            $arr_estadocivil = Qlib::sql_array("SELECT id,nome FROM estadocivils ORDER BY nome ", 'nome', 'id');
            $listFiles = false;
            //$dados['renda_familiar'] = number_format($dados['renda_familiar'],2,',','.');
            $campos = $this->campos();
            if(isset($dados['token'])){
                $listFiles = _upload::where('token_produto','=',$dados['token'])->get();
            }
            $config = [
                'ac'=>'alt',
                'frm_id'=>'frm-familias',
                'route'=>$this->routa,
                'url'=>$this->url,
                'id'=>$id,
            ];
            // if($dados['loteamento']>0){
            //     $bairro = Bairro::find($dados['bairro']);
            //     $dados['matricula'] = isset($bairro['matricula'])?$bairro['matricula']:false;
            // }
            if(!$dados['matricula'])
                $config['display_matricula'] = 'd-none';
            if(isset($dados['config']) && is_array($dados['config'])){
                foreach ($dados['config'] as $key => $value) {
                    if(is_array($value)){

                    }else{
                        $dados['config['.$key.']'] = $value;
                    }
                }
            }
            $ret = [
                'value'=>$dados,
                'config'=>$config,
                'title'=>$title,
                'titulo'=>$titulo,
                'arr_escolaridade'=>$arr_escolaridade,
                'arr_estadocivil'=>$arr_estadocivil,
                'listFiles'=>$listFiles,
                'campos'=>$campos,
                'routa'=>$this->routa,
                'exec'=>true,
            ];
            return view($this->routa.'.show',$ret);
        }else{
            $ret = [
                'exec'=>false,
            ];
            return redirect()->route($this->routa.'.index',$ret);
        }
    }
    public function edit($sic)
    {
        $id = $sic;
        $dados = Sic::where('id',$id)->get();
        $routa = 'sics';
        $this->authorize('ler', $this->routa);

        if(!empty($dados)){
            $title = 'Responder cadastro de sic';
            $titulo = $title;
            $dados[0]['ac'] = 'alt';
            if(isset($dados[0]['config'])){
                $dados[0]['config'] = Qlib::lib_json_array($dados[0]['config']);
            }
            $listFiles = false;
            $campos_solicitacao = $this->campos();
            $campos = $this->campos_resposta();
            if(isset($dados[0]['token'])){
                $listFiles = _upload::where('token_produto','=',$dados[0]['token'])->get();
            }
            //INICIO DADOS DO SOLICITANTE

            $info_solicitante = [];
            $ds = false;
            if(isset($dados[0]['id_requerente']) && ($id_r=$dados[0]['id_requerente'])){
                if(isset($dados[0]['config']['preservarIdentidade'])&&$dados[0]['config']['preservarIdentidade']=='s'){
                    $info_solicitante['nome'] = 'Anonimo';
                    $info_solicitante['email'] = '';
                    $info_solicitante['telefone'] = '';
                }else{
                    $ds = User::find($id_r);
                }
            }else{
                $ds = User::find($id_r);
            }
            if($ds){
                $info_solicitante = [
                    'id'=>$ds['id'],
                    'nome'=>$ds['nome'],
                    'email'=>$ds['email'],
                    'celular'=>isset($ds['config']['celular'])?$ds['config']['celular']:false,
                ];
            }
            //FIM DADOS DO SOLICITANTE
            $config = [
                'ac'=>'alt',
                'frm_id'=>'frm-sics',
                'route'=>$this->routa,
                'url'=>$this->url,
                'id'=>$id,
                'info_solicitante'=>$info_solicitante,
                'arquivos'=>'docx,PDF,pdf,jpg,xlsx,png,jpeg,zip,rar',
                'local'=>'sic_admin',
            ];
            $ret = [
                'value'=>$dados[0],
                'config'=>$config,
                'title'=>$title,
                'titulo'=>$titulo,
                'listFiles'=>$listFiles,
                'campos'=>$campos,
                'campos_solicitacao'=>$campos_solicitacao,
                'exec'=>true,
            ];
            return view($this->view.'.edit',$ret);
        }else{
            $ret = [
                'exec'=>false,
            ];
            return redirect()->route($routa.'.index',$ret);
        }
    }
    public function update(Request $request, $id)
    {
        $this->authorize('update', $this->url);
        $validatedData = $request->validate([
            'protocolo' => ['required'],
        ]);
        $data = [];
        $dados = $request->all();
        $ajax = isset($dados['ajax'])?$dados['ajax']:'n';
        foreach ($dados as $key => $value) {
            if($key!='_method'&&$key!='_token'&&$key!='ac'&&$key!='ajax'){
                if($key=='data_batismo' || $key=='data_nasci'){
                    if($value=='0000-00-00' || $value=='00/00/0000'){
                    }else{
                        $data[$key] = Qlib::dtBanco($value);
                    }
                }else{
                    $data[$key] = $value;
                }
            }
        }
        $userLogadon = Auth::id();
        $data['autor'] = $userLogadon;
        $data['ativo'] = isset($data['ativo'])?$data['ativo']:'n';
        if(isset($dados['config'])){
            $dados['config'] = Qlib::lib_array_json($dados['config']);
        }
        $atualizar=false;
        $email = false;
        $mens = false;
        if(!empty($data)){
            $atualizar=Sic::where('id',$id)->update($data);
            if($atualizar){
                $mens = 'Salvo com sucesso!';
            }
            if($atualizar && isset($data['meta']['enviar_email']) && $data['meta']['enviar_email']=='s'){
                $d_sic = Sic::Find($id);
                $d_requerente = false;
                if($d_sic){
                    $d_requerente = User::Find($d_sic['id_requerente']);
                }
                if($d_requerente){
                    $arr_tags = Qlib::sql_array("SELECT id,nome FROM tags WHERE ativo='s' AND (pai='".$this->pai_motivo."' OR pai='".$this->pai_status."')",'nome','id');

                    //if(isset($dados['secretaria']))
                    $assunto = 'Resposta SIC '.$d_sic['protocolo'];
                    $mensagem = '<h2>Resumo da Resposta</h2>';
                    $mensagem .= '<ul>';
                    if(!empty($d_sic['motivo']))
                        $mensagem .= '<li>Motivo: <b>'.$arr_tags[$d_sic['motivo']].'</b></li>';
                    if(!empty($d_sic['status']))
                        $mensagem .= '<li>Status: <b>'.$arr_tags[$d_sic['status']].'</b></li>';
                    // if(isset($dados['config']['categoria']))
                    //     $mensagem .= '<li>Categoria: <b>'.$arr_tags[$dados['config']['categoria']].'</b></li>';
                    // if(isset($dados['config']['assunto']))
                    //     $mensagem .= '<li>Assunto: <b>'.$dados['config']['assunto'].'</b></li>';
                    $mensagem .= '</ul>';
                    $mensagem .= '<h2>Mensagem da resposta:</h2>';
                    $mensagem .= $d_sic['resposta'];
                    //$mensagem = str_replace('Foi enviado um e-mail para sua caixa postal contendo os dados da solicitação.','',$mensagem);
                    $arquivos = false;
                    if(isset($d_sic['token'])){
                        $d_arq = _upload::where('token_produto','=',$d_sic['token'])->get();
                        if($d_arq){
                            foreach ($d_arq as $ka => $va) {
                                $arquivos[] = $va['pasta'];
                            }
                        }
                    }

                    $email = (new PortalSicController)->enviarEmail([
                        'para_email'=>$d_requerente['email'],
                        'para_nome'=>$d_requerente['nome'],
                        'assunto'=>$assunto,
                        'mensagem'=>$mensagem,
                        'arquivos'=>$arquivos,
                        'nome_supervisor'=>'Responsável por E-sic',
                        'email_supervisor'=>'ger.maisaqui1@gmail.com',
                    ]);
                    if($email){
                        $mens .= ' O E-mail com a resposta foi enviado com sucesso para '.$d_requerente['email'];
                    }
                }
            }
            $route = $this->routa.'.index';
            $ret = [
                'exec'=>$atualizar,
                'id'=>$id,
                'mens'=>$mens,
                'color'=>'success',
                'idCad'=>$id,
                'return'=>$route,
            ];
        }else{
            $route = $this->routa.'.edit';
            $ret = [
                'exec'=>false,
                'id'=>$id,
                'mens'=>'Erro ao receber dados',
                'color'=>'danger',
            ];
        }
        if($ajax=='s'){
            $ret['return'] = route($route).'?idCad='.$id;
            return response()->json($ret);
        }else{
            return redirect()->route($route,$ret);
        }
    }
    public function destroy($id,Request $request)
    {
        $this->authorize('delete', $this->url);
        $config = $request->all();
        $ajax =  isset($config['ajax'])?$config['ajax']:'n';
        $routa = $this->routa;
        if (!$post = Sic::find($id)){
            if($ajax=='s'){
                $ret = response()->json(['mens'=>'Registro não encontrado!','color'=>'danger','return'=>route($this->routa.'.index')]);
            }else{
                $ret = redirect()->route($routa.'.index',['mens'=>'Registro não encontrado!','color'=>'danger']);
            }
            return $ret;
        }

        Sic::where('id',$id)->delete();
        if($ajax=='s'){
            $ret = response()->json(['mens'=>__('Registro '.$id.' deletado com sucesso!'),'color'=>'success','return'=>route($this->routa.'.index')]);
        }else{
            $ret = redirect()->route($routa.'.index',['mens'=>'Registro deletado com sucesso!','color'=>'success']);
        }
        return $ret;
    }
    public function relatorios(){
        echo 'rela';
    }
}
