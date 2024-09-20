<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadController;
use App\Models\Post;
use App\Qlib\Qlib;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request){
        $d = $request->all();
        $limit = false;
        $page = 0;
        if($type = $request->get('type')){
            if($type == 'archives'){
                $fcode = 'guid as category_id';
                $id_pai = Qlib::buscaValorDb0('tags','value','archives_category','id');
                $all_categories = Qlib::sql_array("SELECT id,nome FROM tags WHERE ativo='s' AND pai='$id_pai'",'nome','id');
            }else{
                $all_categories = [];
                $fcode = 'guid as code';
            }
            $posts = Post::select(
                'ID as id',
                'post_type as type',
                'post_title as name',
                'post_content as description',
                'post_date_gmt as date',
                'token',
                $fcode,
                'config'
            )
            // ->with('doc_files')
            ->where('post_type','=',$type)
            ->where('post_status','=','publish');
            $anos = Post::select(DB::raw('YEAR(post_date_gmt) as ano'))->distinct()
            ->where('post_type', 'LIKE', $request->get("type"))
            ->orderBy('ano', 'asc')
            ->get();
            if($request->has('year') && trim($request->get('year')) !== ""){
                $posts = $posts->whereYear('post_date_gmt','=',$request->get('year'));
            }
            // ->get();
            if($request->has('description'))
                $files = $posts->where('post_content', 'LIKE', '%'.$request->get("description").'%');

            if($request->has('code'))
                $files = $posts->where('guid', '=', $request->get("code"));

            if($request->has('date_begin'))
                $files = $posts->whereDate('post_date_gmt', '>=', Carbon::createFromFormat('Y-m-d', $request->get("date_begin"))->toDateString() );
            if($request->has('date_end'))
                $files = $posts->whereDate('post_date_gmt', '<=', Carbon::createFromFormat('Y-m-d', $request->get("date_end"))->toDateString() );

            $count = $posts->count();
            if($request->has('limit'))
                $limit = $request->get('limit');
            if($request->has('page'))
                $page = $request->get('page') - 1;

            if($limit)
                $files = $posts->take($limit)->skip($limit * $page);
            $doc = $posts->get();
            if($doc->count() > 0){
                $doc=$doc->toArray();
                $fi = new UploadController;
                foreach($doc as $key => $value){
                    if(isset($value['category_id'])){
                        $doc[$key]['category'] = @$all_categories[$value['category_id']];
                    }
                    $doc[$key]['total_files'] = $fi->total($value['token']);
                    $doc[$key]['doc_files'] = $fi->list_files($value['token']);
                }
            }
            return ['amount'=>$count,'data' => $doc,'anos'=>$anos,'all_categories'=>$all_categories];
        }
    }
}
