<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\wp\ApiWpController;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreBeneficiarioRequest;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use stdClass;
use App\Models\Post;
use App\Qlib\Qlib;
use App\Models\User;
use App\Models\_upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class portalController extends Controller
{
    protected $user;
    public $routa;
    public $label;
    public $view;
    public $post_type;
    public $prefixo_site;
    public $prefixo_admin;
    public $pg;
    public $i_wp;//integração com wp
    public $wp_api;//integração com wp
    public function __construct()
    {
        $seg1 = request()->segment(1);
        $seg2 = request()->segment(2);
        $type = false;
        if($seg1){
            $type = substr($seg1,0,-1);
        }
        $this->post_type = $type;
        $this->pg = $seg1;
        //$this->user = $user;
        $this->routa = $this->pg;
        $this->prefixo_admin = config('app.prefixo_admin');
        $this->prefixo_site = config('app.prefixo_site');
        $this->label = 'Portal';
        $this->view = 'portal';
        $this->i_wp = Qlib::qoption('i_wp');//indegração com Wp s para sim
        $this->wp_api = new ApiWpController();
    }
    public function index($config = null)
    {
        if($this->pg==NULL){
            return view('portal.index',['prefixo_site'=>$this->prefixo_site,'prefixo_admin'=>$this->prefixo_admin]);
        }
    }
    public function cadInternautas($tipo = null)
    {
        $tp = $tipo?$tipo:'pf';
        $config = [
            'ac'=>'cad',
            'frm_id'=>'frm-cad-internautas',
            'route'=>'internautas',
            'tipo'=>$tp,
            'arquivos'=>'jpeg,jpg,png',
            'event'=>'enctype="multipart/form-data"',
            'ambiente'=>'front',
        ];
        $value = [
            'token'=>uniqid(),
        ];
        $title = __('Cadastrar internautas');
        $titulo = $title;
        $campos = $this->camposCadInternautas();
        return view('portal.internautas.cadastrar',[
            'config'=>$config,
            'title'=>$title,
            'titulo'=>$titulo,
            'campos'=>$campos,
            'value'=>$value,
        ]);

    }
    public function camposCadInternautas($sec=false)
    {
        $sec = $sec?$sec:request()->segment(3);
        if($sec=='pf'){
            $lab_nome = 'Nome completo *';
            $lab_cpf = 'CPF *';
            $displayPf = '';
            $displayPj = 'd-none';
        }
        if($sec=='pj'){
            $lab_nome = 'Nome do responsável *';
            $lab_cpf = 'CPF do responsável*';
            $displayPf = 'd-none';
            $displayPj = '';
        }
        $hidden_editor = '';
        $ret = [
            'id'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'tipo_pessoa'=>[
                'label'=>'',
                'active'=>true,
                'type'=>'radio_btn',
                'arr_opc'=>['pf'=>'Pessoa Física','pj'=>'Pessoa Jurídica'],
                'exibe_busca'=>'d-block',
                'event'=>'onclick=selectTipoUser(this.value)',
                'tam'=>'12',
                'value'=>$sec,
                'class'=>'btn btn-outline-primary',
            ],
            'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'email'=>['label'=>'E-mail *','active'=>false,'type'=>'email','exibe_busca'=>'d-none','event'=>'required','tam'=>'6','placeholder'=>''],
            'password'=>['label'=>'Senha *','active'=>false,'type'=>'password','exibe_busca'=>'d-none','event'=>'required','tam'=>'3','placeholder'=>''],
            'password_conf'=>['label'=>'Confirmar Senha *','active'=>false,'type'=>'password','exibe_busca'=>'d-none','event'=>'required','tam'=>'3','placeholder'=>''],
            'nome'=>['label'=>$lab_nome,'active'=>false,'type'=>'text','exibe_busca'=>'d-none','event'=>'required','tam'=>'9','placeholder'=>''],
            'cpfcnpj'=>['label'=>$lab_cpf,'active'=>true,'type'=>'tel','exibe_busca'=>'d-block','event'=>'mask-cpf','tam'=>'3'],
            'razao'=>['label'=>'Razão social *','active'=>false,'type'=>'text','exibe_busca'=>'d-none','event'=>'required','tam'=>'6','placeholder'=>'','class_div'=>'div-pj '.$displayPj],
            'config[nome_fantasia]'=>['label'=>'Nome fantasia','active'=>false,'type'=>'text','exibe_busca'=>'d-none','event'=>'','tam'=>'6','placeholder'=>'','class_div'=>'div-pj '.$displayPj],
            'config[celular]'=>['label'=>'Telefone celular','active'=>true,'type'=>'tel','tam'=>'4','exibe_busca'=>'d-block','event'=>'onblur=mask(this,clientes_mascaraTelefone); onkeypress=mask(this,clientes_mascaraTelefone);','cp_busca'=>'config][celular'],
            'config[telefone_residencial]'=>['label'=>'Telefone residencial','active'=>true,'type'=>'tel','tam'=>'4','exibe_busca'=>'d-block','event'=>'onblur=mask(this,clientes_mascaraTelefone); onkeypress=mask(this,clientes_mascaraTelefone);','cp_busca'=>'config][telefone_residencial'],
            'config[telefone_comercial]'=>['label'=>'Telefone comercial','active'=>true,'type'=>'tel','tam'=>'4','exibe_busca'=>'d-block','event'=>'onblur=mask(this,clientes_mascaraTelefone); onkeypress=mask(this,clientes_mascaraTelefone);','cp_busca'=>'config][telefone_comercial'],
            'config[rg]'=>['label'=>'RG','active'=>true,'type'=>'tel','tam'=>'4','exibe_busca'=>'d-block','event'=>'onblur=mask(this,clientes_mascaraTelefone); onkeypress=mask(this,clientes_mascaraTelefone);','cp_busca'=>'config][rg'],
            'config[nascimento]'=>['label'=>'Data de nascimento','active'=>true,'type'=>'date','tam'=>'4','exibe_busca'=>'d-block','event'=>'','cp_busca'=>'config][nascimento'],
            'genero'=>[
                'label'=>'Sexo',
                'active'=>true,
                'type'=>'select',
                'arr_opc'=>['m'=>'Masculino','f'=>'Feminino','ni'=>'Não informar'],
                'event'=>'',
                'tam'=>'4',
                'exibe_busca'=>true,
                'option_select'=>false,
                'class'=>'select2',
            ],
            'config[escolaridade]'=>[
                'label'=>'Escolaridade',
                'active'=>true,
                'type'=>'select',
                'arr_opc'=>Qlib::sql_array("SELECT id,nome FROM escolaridades WHERE ativo='s'",'nome','id'),'exibe_busca'=>'d-block',
                'event'=>'',
                'tam'=>'6',
                'class'=>'select2',
                'cp_busca'=>'config][nascimento',
            ],
            'config[profissao]'=>[
                'label'=>'Profissão',
                'active'=>true,
                'type'=>'select',
                'arr_opc'=>Qlib::sql_array("SELECT id,nome FROM profissaos WHERE ativo='s'",'nome','id'),'exibe_busca'=>'d-block',
                'event'=>'',
                'tam'=>'6',
                'class'=>'select2',
                'cp_busca'=>'config][nascimento',
            ],
            'config[cep]'=>['label'=>'CEP','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'mask-cep onchange=buscaCep1_0(this.value)','tam'=>'3'],
            'config[endereco]'=>['label'=>'Endereço','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'7','cp_busca'=>'config][endereco'],
            'config[numero]'=>['label'=>'Numero','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'2','cp_busca'=>'config][numero'],
            'config[complemento]'=>['label'=>'Complemento','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'4','cp_busca'=>'config][complemento'],
            'config[cidade]'=>['label'=>'Cidade','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'6','cp_busca'=>'config][cidade'],
            'config[uf]'=>['label'=>'UF','active'=>false,'js'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-none','event'=>'','tam'=>'2','cp_busca'=>'config][uf'],
            //'foto_perfil'=>['label'=>'Foto','active'=>false,'js'=>true,'placeholder'=>'','type'=>'file','exibe_busca'=>'d-none','event'=>'','tam'=>'12'],
        ];
        return $ret;
    }
    public function storeInternautas(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => ['required','string','unique:users'],
            'email' => ['required','string','unique:users'],
        ]);
        $dados = $request->all();
        $ajax = isset($dados['ajax'])?$dados['ajax']:'n';
        $dados['ativo'] = isset($dados['ativo'])?$dados['ativo']:'n';
        if(isset($dados['password']) && !empty($dados['password'])){
            $dados['password'] = Hash::make($dados['password']);
        }else{
            if(empty($dados['password'])){
                unset($dados['password']);
            }
        }
        $salvar = User::create($dados);
        $route = $this->routa.'.index';
        $ret = [
            'mens'=>$this->label.' cadastrada com sucesso!',
            'color'=>'success',
            'idCad'=>$salvar->id,
            'exec'=>true,
            'dados'=>$dados
        ];

        if($ajax=='s'){
            $ret['return'] = route($route).'?idCad='.$salvar->id;
            return response()->json($ret);
        }else{
            return redirect()->route($route,$ret);
        }
    }
}