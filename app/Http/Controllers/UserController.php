<?php

namespace App\Http\Controllers;

use App\Models\_upload;
use App\Models\User;
use stdClass;
use App\Qlib\Qlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DataTables;

class UserController extends Controller
{
    protected $user;
    public $routa;
    public $label;
    public $view;
    public $url;
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->routa = 'users';
        $this->url = 'users';
        $this->label = 'Usuários';
        $this->view = 'padrao';
    }
    public function queryUsers($get=false,$config=false)
    {
        $ret = false;
        $get = isset($_GET) ? $_GET:[];
        $ano = date('Y');
        $mes = date('m');
        $config = [
            'limit'=>isset($get['limit']) ? $get['limit']: 50,
            'order'=>isset($get['order']) ? $get['order']: 'desc',
        ];
        $logado = Auth::user();
        if(isset($get['term'])){
            //Autocomplete
            if(isset($get['bairro']) && !empty($get['bairro']) && isset($get['quadra']) && !empty($get['quadra'])){
               $sql = "SELECT * FROM users WHERE (nome LIKE '%".$get['term']."%') AND bairro=".$get['bairro']." AND quadra=".$get['quadra']." AND ".Qlib::compleDelete();
            }elseif(isset($get['id_permission']) && !empty($get['id_permission'])){
                $sql = "SELECT * FROM users WHERE (nome LIKE '%".$get['term']."%') AND id_permission=".$get['id_permission']." AND ".Qlib::compleDelete();
            }else{
                // $sql = "SELECT l.*,q.nome quadra_valor FROM users as l
                // JOIN quadras as q ON q.id=l.quadra
                // WHERE (l.nome LIKE '%".$get['term']."%' OR q.nome LIKE '%".$get['term']."%' ) AND ".Qlib::compleDelete('l');
                $sql = "SELECT * FROM users WHERE nome LIKE '%".$get['term']."%' AND ".Qlib::compleDelete();

            }
            $user = DB::select($sql);
            // if(isset($get['familias'])&&$get['familias']=='s' && is_array($user)){
            //     foreach ($user as $k => $v) {
            //         $sqlF = "SELECT f.*,b.nome,b.cpf FROM familias As f
            //         JOIN beneficiarios As b ON b.id=f.id_beneficiario
            //         WHERE f.useramento LIKE '%\"".$v->id."\"%' AND ".Qlib::compleDelete('f')." AND ".Qlib::compleDelete('b');
            //         $user[$k]->familias = DB::select($sqlF);
            //     }
            // }
            $ret['user'] = $user;
            //dd($ret);
            return $ret;
        }else{
            $user =  User::where('id_permission','>=',$logado->id_permission)->orderBy('id',$config['order']);
            //$user =  DB::table('users')->where('ativo','s')->orderBy('id',$config['order']);
        }
        $users = new stdClass;
        $campos = isset($_SESSION['campos_users_exibe']) ? $_SESSION['campos_users_exibe'] : $this->campos();
        $tituloTabela = 'Lista de todos cadastros';
        $arr_titulo = false;
        if(isset($get['filter'])){
                $titulo_tab = false;
                $i = 0;
                foreach ($get['filter'] as $key => $value) {
                    if(!empty($value)){
                        if($key=='id'){
                            $user->where($key,'LIKE', $value);
                            $titulo_tab .= 'Todos com *'. $campos[$key]['label'] .'% = '.$value.'& ';
                            $arr_titulo[$campos[$key]['label']] = $value;
                        }else{
                            $user->where($key,'LIKE','%'. $value. '%');
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
                }
                $fm = $user;
                if($config['limit']=='todos'){
                    $user = $user->get();
                }else{
                    $user = $user->paginate($config['limit']);
                }
        }else{
            $fm = $user;
            if($config['limit']=='todos'){
                $user = $user->get();
            }else{
                $user = $user->paginate($config['limit']);
            }
        }
        $users->todos = $fm->count();
        $users->esteMes = $fm->whereYear('created_at', '=', $ano)->whereMonth('created_at','=',$mes)->get()->count();
        $users->ativos = $fm->where('ativo','=','s')->get()->count();
        $users->inativos = $fm->where('ativo','=','n')->get()->count();
        //dd($user);
        $ret['user'] = $user;
        $ret['user_totais'] = $users;
        $ret['arr_titulo'] = $arr_titulo;
        $ret['campos'] = $campos;
        $ret['config'] = $config;
        $ret['tituloTabela'] = $tituloTabela;
        $ret['config']['resumo'] = [
            'todos_registro'=>['label'=>'Todos cadastros','value'=>$users->todos,'icon'=>'fas fa-calendar'],
            'todos_mes'=>['label'=>'Cadastros recentes','value'=>$users->esteMes,'icon'=>'fas fa-calendar-times'],
            'todos_ativos'=>['label'=>'Cadastros ativos','value'=>$users->ativos,'icon'=>'fas fa-check'],
            'todos_inativos'=>['label'=>'Cadastros inativos','value'=>$users->inativos,'icon'=>'fas fa-archive'],
        ];
        return $ret;
    }
    public function campos($dados=false){
        $user = Auth::user();
        $permission = new admin\UserPermissions($user);

        $ret = [
            'id'=>['label'=>'Id','active'=>true,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'id_permission'=>[
                'label'=>'Permissão*',
                'active'=>true,
                'type'=>'select',
                'data_selector'=>[
                    'campos'=>$permission->campos(),
                    'route_index'=>route('permissions.index'),
                    'id_form'=>'frm-permission',
                    'action'=>route('permissions.store'),
                    'campo_id'=>'id',
                    'campo_bus'=>'nome',
                    'label'=>'Permissão',
                ],'arr_opc'=>Qlib::sql_array("SELECT id,name FROM permissions WHERE active='s' AND id >='".$user->id_permission."'",'name','id'),'exibe_busca'=>'d-block',
                'event'=>'',
                'tam'=>'6',
                'value'=>@$_GET['id_permission'],
            ],
            'nome'=>['label'=>'Nome completo','active'=>true,'placeholder'=>'','type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'6'],
            'token'=>['label'=>'token','active'=>false,'type'=>'hidden','exibe_busca'=>'d-block','event'=>'','tam'=>'2'],
            'email'=>['label'=>'Email','active'=>true,'type'=>'text','exibe_busca'=>'d-block','event'=>'','tam'=>'4'],
            'password'=>['label'=>'Senha','active'=>false,'type'=>'password','value'=>'','exibe_busca'=>'d-none','event'=>'','tam'=>'6'],
            'ativo'=>['label'=>'Liberar','active'=>true,'type'=>'chave_checkbox','value'=>'s','checked'=>'s','exibe_busca'=>'d-block','event'=>'','tam'=>'2','arr_opc'=>['s'=>'Sim','n'=>'Não']],
            //'email'=>['label'=>'Observação','active'=>false,'type'=>'textarea','exibe_busca'=>'d-block','event'=>'','tam'=>'12'],
        ];
        return $ret;
    }
    public function index(User $user)
    {
        $this->authorize('is_admin', $user);
        $ajax = isset($_GET['ajax'])?$_GET['ajax']:'n';
        $title = 'Usuários Cadastrados';
        $titulo = $title;
        $queryUsers = $this->queryUsers($_GET);
        $queryUsers['config']['exibe'] = 'html';
        $routa = $this->routa;
        $view = $this->view;
        if(isset($_GET['term'])){
            $ret = false;
            $ajax = 's';
            $campos = $this->campos();
            if($queryUsers['user']){
               //$ret = $queryUsers['user'];
                if(isset($_GET['id_permission']) && empty($_GET['id_permission'])){
                    $ret[0]['value'] = 'Por favor selecione a Permissão! ';
                    $ret[0]['id'] = '';
                }elseif(isset($_GET['quadra']) && empty($_GET['quadra'])){
                    $ret[0]['value'] = 'Por favor selecione a Quadra! ';
                    $ret[0]['id'] = 'cad';
                }else{
                    foreach ($queryUsers['user'] as $key => $v) {
                        $bairro = false;
                        if(isset($v->config)){
                            $v->config = Qlib::lib_json_array($v->config);
                            if(isset($v->config['celular'])){
                                $v->celular = $v->config['celular'];
                            }
                        }
                        if($id_permission = $v->id_permission){
                            $permission = Qlib::buscaValorDb([
                                'tab'=>'permissions',
                                'campo_bus'=>'id',
                                'valor'=>$id_permission,
                                'select'=>'name',
                            ]);
                            $ret[$key]['dados'] = $v;
                        }
                        $nome_quadra = false;
                        // if($id_quadra = $v->quadra){

                        //     $nome_quadra = Qlib::buscaValorDb([
                        //         'tab'=>'quadras',
                        //         'campo_bus'=>'id',
                        //         'valor'=>$id_quadra,
                        //         'select'=>'nome',
                        //     ]);
                        //     $ret[$key]['dados'] = $v;
                        //     $ret[$key]['dados']->quadra_valor = $nome_quadra;
                        // }
                        $ret[$key]['value'] = ' Usuario: '.$v->nome.' | E-mail: '.$v->email;
                    }
                }
            }else{
                $ret[0]['value'] = 'Usuario não encontrado. Cadastrar agora?';
                $ret[0]['id'] = 'cad';
            }
        }else{
            $ret = [
                'dados'=>$queryUsers['user'],
                'title'=>$title,
                'titulo'=>$titulo,
                'campos_tabela'=>$queryUsers['campos'],
                'user_totais'=>$queryUsers['user_totais'],
                'titulo_tabela'=>$queryUsers['tituloTabela'],
                'arr_titulo'=>$queryUsers['arr_titulo'],
                'config'=>$queryUsers['config'],
                'routa'=>$routa,
                'view'=>$view,
                'url'=>$this->url,
                'i'=>0,
            ];
        }
        if($ajax=='s'){
            return response()->json($ret);
        }else{
            return view($this->view.'.index',$ret);
        }
    }
    public function create(User $user)
    {
        $this->authorize('is_admin', $user);
        $title = __('Cadastrar usuário');
        $titulo = $title;
        $config = [
            'ac'=>'cad',
            'frm_id'=>'frm-users',
            'route'=>$this->routa,
            'url'=>$this->url,
        ];
        $value = [
            'token'=>uniqid(),
        ];
        $campos = $this->campos();
        return view($this->routa.'.createedit',[
            'config'=>$config,
            'title'=>$title,
            'titulo'=>$titulo,
            'campos'=>$campos,
            'value'=>$value,
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => ['required','string'],
            'email' => ['required','string','unique:users'],
            ],[
                'nome.required'=>__('O nome é obrigatório'),
                'nome.string'=>__('É necessário conter letras no nome'),
                'email.unique'=>__('E-mail já cadastrado'),
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
        //dd($dados);
        $salvar = User::create($dados);
        $dados['id'] = $salvar->id;
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

    public function show($id)
    {
        //
    }

    public function edit($user)
    {
        $id = $user;
        $dados = User::where('id',$id)->get();
        $routa = 'users';
        $this->authorize('is_admin', $user);

        if(!empty($dados)){
            $title = 'Editar Cadastro de users';
            $titulo = $title;
            $dados[0]['ac'] = 'alt';
            if(isset($dados[0]['config'])){
                $dados[0]['config'] = Qlib::lib_json_array($dados[0]['config']);
            }
            $listFiles = false;
            if(isset($dados[0]['token'])){
                $listFiles = _upload::where('token_produto','=',$dados[0]['token'])->get();
            }
            $config = [
                'ac'=>'alt',
                'frm_id'=>'frm-users',
                'route'=>$this->routa,
                'url'=>$this->url,
                'id'=>$id,
            ];
            $campos = $this->campos();
            $ret = [
                'value'=>$dados[0],
                'config'=>$config,
                'title'=>$title,
                'titulo'=>$titulo,
                'listFiles'=>$listFiles,
                'campos'=>$campos,
                'exec'=>true,
            ];

            return view($routa.'.createedit',$ret);
        }else{
            $ret = [
                'exec'=>false,
            ];
            return redirect()->route($routa.'.index',$ret);
        }
    }

    public function update(Request $request, $id)
    {
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
                }elseif($key=='password'){
                    $data[$key] = Hash::make($value);
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
        if(empty($data['passaword'])){
            unset($data['passaword']);
        }
        if(!empty($data)){
            $atualizar=User::where('id',$id)->update($data);
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
        $config = $request->all();
        $ajax =  isset($config['ajax'])?$config['ajax']:'n';
        $routa = 'users';
        if (!$post = User::find($id)){
            if($ajax=='s'){
                $ret = response()->json(['mens'=>'Registro não encontrado!','color'=>'danger','return'=>route($this->routa.'.index')]);
            }else{
                $ret = redirect()->route($routa.'.index',['mens'=>'Registro não encontrado!','color'=>'danger']);
            }
            return $ret;
        }

        User::where('id',$id)->delete();
        if($ajax=='s'){
            $ret = response()->json(['mens'=>__('Registro '.$id.' deletado com sucesso!'),'color'=>'success','return'=>route($this->routa.'.index')]);
        }else{
            $ret = redirect()->route($routa.'.index',['mens'=>'Registro deletado com sucesso!','color'=>'success']);
        }
        return $ret;
    }
}
