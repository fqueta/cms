<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;

use stdClass;
use Illuminate\Http\Request;
use App\Qlib\Qlib;
use App\Models\User;
use App\Models\_upload;
use App\Models\Sic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class sicController extends Controller
{
    protected $user;
    public $routa;
    public $label;
    public $ambiente;
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->routa = 'sic';
        $this->label = 'Sic';
        $this->ambiente = Qlib::ambiente(); //Verifica se estamos no backend ou no frontend
        $this->view = 'padrao';
    }
    public function querySic($get=false,$config=false)
    {
        $ret = false;
        $get = isset($_GET) ? $_GET:[];
        $ano = date('Y');
        $mes = date('m');
        //$todasFamilias = Familia::where('excluido','=','n')->where('deletado','=','n');
        $config = [
            'limit'=>isset($get['limit']) ? $get['limit']: 50,
            'order'=>isset($get['order']) ? $get['order']: 'desc',
        ];
        $sic =  Sic::where('excluido','=','n')->where('deletado','=','n')->orderBy('id',$config['order']);
        //$sic =  DB::table('sics')->where('excluido','=','n')->where('deletado','=','n')->orderBy('id',$config['order']);

        $sic_totais = new stdClass;
        $campos = isset($_SESSION['campos_sics_exibe']) ? $_SESSION['campos_sics_exibe'] : $this->campos();
        $tituloTabela = 'Lista de todos cadastros';
        $arr_titulo = false;
        if(isset($get['filter'])){
                $titulo_tab = false;
                $i = 0;
                foreach ($get['filter'] as $key => $value) {
                    if(!empty($value)){
                        if($key=='id'){
                            $sic->where($key,'LIKE', $value);
                            $titulo_tab .= 'Todos com *'. $campos[$key]['label'] .'% = '.$value.'& ';
                            $arr_titulo[$campos[$key]['label']] = $value;
                        }else{
                            $sic->where($key,'LIKE','%'. $value. '%');
                            if($campos[$key]['type']=='select'){
                                $value = $campos[$key]['arr_opc'][$value];
                            }
                            $arr_titulo[$campos[$key]['label']] = $value;
                            $titulo_tab .= 'Todos com *'. $campos[$key]['label'] .'% = '.$value.'& ';
                        }
                        $i++;
                    }
                }
                if($titulo_tab){
                    $tituloTabela = 'Lista de: &'.$titulo_tab;
                                //$arr_titulo = explode('&',$tituloTabela);
                }
                $fm = $sic;
                if($config['limit']=='todos'){
                    $sic = $sic->get();
                }else{
                    $sic = $sic->paginate($config['limit']);
                }
        }else{
            $fm = $sic;
            if($config['limit']=='todos'){
                $sic = $sic->get();
            }else{
                $sic = $sic->paginate($config['limit']);
            }
        }
        $sic_totais->todos = $fm->count();
        $sic_totais->esteMes = $fm->whereYear('created_at', '=', $ano)->whereMonth('created_at','=',$mes)->count();
        $sic_totais->ativos = $fm->where('ativo','=','s')->count();
        $sic_totais->inativos = $fm->where('ativo','=','n')->count();
        $ret['sic'] = $sic;
        $ret['sic_totais'] = $sic_totais;
        $ret['arr_titulo'] = $arr_titulo;
        $ret['campos'] = $campos;
        $ret['config'] = $config;
        $ret['tituloTabela'] = $tituloTabela;
        $ret['config']['resumo'] = [
            'todos_registro'=>['label'=>'Todos cadastros','value'=>$sic_totais->todos,'icon'=>'fas fa-calendar'],
            'todos_mes'=>['label'=>'Cadastros recentes','value'=>$sic_totais->esteMes,'icon'=>'fas fa-calendar-times'],
            'todos_ativos'=>['label'=>'Cadastros ativos','value'=>$sic_totais->ativos,'icon'=>'fas fa-check'],
            'todos_inativos'=>['label'=>'Cadastros inativos','value'=>$sic_totais->inativos,'icon'=>'fas fa-archive'],
        ];
        return $ret;
    }
    public function campos(){
        return [
            'id'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'info'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>Qlib::formatMensagemInfo('Preencha os campos abaixo para enviar sua solicitação de informação. Serviço disponibilizado conforme Art. 10, da Lei 12.527/11.','info'),'tam'=>'12'],
            'config[secretaria]'=>[
                'label'=>'Secretaria*',
                'active'=>false,
                'id'=>'secretaria',
                'type'=>'select',
                'arr_opc'=>Qlib::sql_array("SELECT value,nome FROM tags WHERE ativo='s' AND pai='1'",'nome','value'),
                'exibe_busca'=>'d-block',
                'event'=>'required',
                'tam'=>'12',
                'class'=>'',
                'title'=>'',
                'exibe_busca'=>true,
                'option_select'=>true,
                'cp_busca'=>'config][secretaria',
            ],
            'config[categoria]'=>[
                'label'=>'Categoria*',
                'active'=>false,
                'id'=>'categoria',
                'type'=>'select',
                'arr_opc'=>Qlib::sql_array("SELECT value,nome FROM tags WHERE ativo='s' AND pai='2'",'nome','value'),
                'exibe_busca'=>'d-block',
                'event'=>'required',
                'tam'=>'12',
                'class'=>'',
                'title'=>'',
                'exibe_busca'=>true,
                'option_select'=>true,
                'cp_busca'=>'config][categoria',
            ],
            'config[assunto]'=>['label'=>'Assunto*','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','cp_busca'=>'config][categoria','event'=>'required','tam'=>'12'],
            //'nome'=>['label'=>'Nome','active'=>true,'placeholder'=>'Ex.: Ensino médio completo','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            //'ativo'=>['label'=>'Ativado','active'=>true,'type'=>'chave_checkbox','value'=>'s','valor_padrao'=>'s','exibe_busca'=>'d-block','event'=>'','tam'=>'3','arr_opc'=>['s'=>'Sim','n'=>'Não']],
            'mensagem'=>['label'=>'Mensagem*','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'required','tam'=>'12'],
            'anexo'=>['label'=>'Anexos','active'=>true,'placeholder'=>'Anexar arquivos','type'=>'file','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
            'info1'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>'<p>* Formatos de arquivo aceitos: PDF, JPG, JPEG, GIF, PNG, MP4, RAR e ZIP. Tamanho máximo permitido: 10 MB.</p>','tam'=>'12'],
            //'info'=>['label'=>'Info1','active'=>false,'type'=>'html','script'=>Qlib::formatMensagemInfo('Preencha os campos abaixo para enviar sua solicitação de informação. Serviço disponibilizado conforme Art. 10, da Lei 12.527/11.','info'),'tam'=>'12'],
        ];
    }
    public function index(User $user)
    {
        $this->authorize('ler', $this->routa);
        $title = 'Cadastro de sic';
        $titulo = $title;
        $querySic = $this->querySic($_GET);
        $querySic['config']['exibe'] = 'html';
        $routa = $this->routa;
        return view($this->view.'.index',[
            'dados'=>$querySic['sic'],
            'title'=>$title,
            'titulo'=>$titulo,
            'campos_tabela'=>$querySic['campos'],
            'sic_totais'=>$querySic['sic_totais'],
            'titulo_tabela'=>$querySic['tituloTabela'],
            'arr_titulo'=>$querySic['arr_titulo'],
            'config'=>$querySic['config'],
            'routa'=>$routa,
            'view'=>$this->view,
            'i'=>0,
        ]);
    }
    public function create(User $user)
    {
        if(auth()->user()->id_permission==Qlib::qoption('id_permission_front')){
            $this->authorize('is_user_front');
        }else{
            $this->authorize('create', $this->routa);
        }
        $local = $this->ambiente;
        $title = 'Cadastrar sic';
        $titulo = $title;
        $config = [
            'ac'=>'cad',
            'frm_id'=>'frm-sics',
            'route'=>$this->routa,
            'ambiente'=>$local,
            'event'=>'enctype=multipart/form-data',
        ];
        $value = [
            'token'=>uniqid(),
        ];
        $campos = $this->campos();

        $view = $this->view;
        if($local=='front'){
            $view = 'portal.sic_front';
        }
        return view($view.'.createedit',[
            'config'=>$config,
            'title'=>$title,
            'titulo'=>$titulo,
            'campos'=>$campos,
            'value'=>$value,
        ]);
    }
    public function store(Request $request)
    {
        if(auth()->user()->id_permission==Qlib::qoption('id_permission_front')){
            $this->authorize('is_user_front');
        }else{
            $this->authorize('create', $this->routa);
        }
        $local = $this->ambiente;
        $validatedData = $request->validate([
            'mensagem' => ['required','string'],
            'anexo' => ['mimes:pdf,jpg,jpeg,gif,mp4,png,rar,zip','max:10000'],
            [
                'mensagem.required'=>'É necessário uma mensagem',
                'mensagem.string'=>'Mensagem inválida',
                ]
        ]);
        $dados = $request->all();
        // if (isset($dados['anexo']) && $dados['anexo']!='undefined'){
        //     //if($dados['anexo']->isValid()){
        //         $verTipoArq = Qlib::verificaArquivo($dados['anexo'],'pdf,jpg,jpeg,gif,png,mp4,rar,zip');
        //         if($verTipoArq['mens']){
        //             $ret = [
        //                 'mens'=>$verTipoArq['mens'],
        //                 'color'=>'danger',
        //                 'idCad'=>false,
        //                 'exec'=>false,
        //                 'dados'=>$dados
        //             ];
        //             //dd($ret);
        //             return $ret;
        //         }
        //     //}
        // }
        $ajax = isset($dados['ajax'])?$dados['ajax']:'n';
        $dados['ativo'] = isset($dados['ativo'])?$dados['ativo']:'n';
        $salvar = Sic::create($dados);
        if(isset($salvar->id)){
            $id = $salvar->id;
            $data['protocolo'] = isset($data['protocolo'])?$data['protocolo']:date('YmdH').'-'.Qlib::zerofill($salvar->id,'4');
            $mens = 'Sua solicitação foi cadastrada com sucesso e gerou o número de protocolo <b>'.$data['protocolo'].'</b>. guarde este número pois será com ele que você consultará o andamento da sua solicitação. Foi enviado um e-mail para sua caixa postal contendo os dados da solicitação.';
            $salvAnexo = false;
            if (isset($dados['anexo']) && $dados['anexo']!='undefined'){
                if($dados['anexo']->isValid()){

                    $nameFile = Str::of($data['protocolo'])->slug('-').'.'.$dados['anexo']->getClientOriginalExtension();
                    $anexo = $dados['anexo']->storeAs('sic/anexo',$nameFile);
                    $salvAnexo = $anexo;
                    //dd($dados['anexo']->getSize());
                }
            }
            if($salvAnexo){
                $ret['upd_cad'] = Sic::where('id',$id)->update($data);
                //$ret['mens'] = $mens;
            }
        }
        //Qlib::lib_print($salvar);
        //dd($ret);
        $route = $this->routa.'.index';
        $ret = [
            'mens'=>$mens,
            'color'=>'success',
            'idCad'=>$salvar->id,
            'exec'=>true,
            'dados'=>$dados
        ];

        if($ajax=='s'){
            $ret['return'] = route($route).'?idCad='.$salvar->id;
            $ret['redirect'] = route($this->routa.'.edit',['id'=>$salvar->id]);
            return response()->json($ret);
        }else{
            return redirect()->route($route,$ret);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($sic,User $user)
    {
        $id = $sic;
        $dados = Sic::where('id',$id)->get();
        $routa = 'sics';
        $this->authorize('ler', $this->routa);

        if(!empty($dados)){
            $title = 'Editar cadastro de sic';
            $titulo = $title;
            $dados[0]['ac'] = 'alt';
            if(isset($dados[0]['config'])){
                $dados[0]['config'] = Qlib::lib_json_array($dados[0]['config']);
            }
            $listFiles = false;
            $campos = $this->campos();
            if(isset($dados[0]['token'])){
                $listFiles = _upload::where('token_produto','=',$dados[0]['token'])->get();
            }
            $config = [
                'ac'=>'alt',
                'frm_id'=>'frm-sics',
                'route'=>$this->routa,
                'id'=>$id,
            ];

            $ret = [
                'value'=>$dados[0],
                'config'=>$config,
                'title'=>$title,
                'titulo'=>$titulo,
                'listFiles'=>$listFiles,
                'campos'=>$campos,
                'exec'=>true,
            ];

            return view($this->view.'.createedit',$ret);
        }else{
            $ret = [
                'exec'=>false,
            ];
            return redirect()->route($routa.'.index',$ret);
        }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', $this->routa);
        $validatedData = $request->validate([
            'nome' => ['required'],
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
                }elseif($key == 'renda_familiar') {
                    $value = str_replace('R$','',$value);
                    $data[$key] = Qlib::precoBanco($value);
                }else{
                    $data[$key] = $value;
                }
            }
        }
        $userLogadon = Auth::id();
        $data['ativo'] = isset($data['ativo'])?$data['ativo']:'n';
        $data['autor'] = $userLogadon;
        if(isset($dados['config'])){
            $dados['config'] = Qlib::lib_array_json($dados['config']);
        }
        $atualizar=false;
        if(!empty($data)){
            $atualizar=Sic::where('id',$id)->update($data);
            $route = $this->routa.'.index';
            $ret = [
                'exec'=>$atualizar,
                'id'=>$id,
                'mens'=>'Salvo com sucesso!',
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
        $this->authorize('delete', $this->routa);
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
}
