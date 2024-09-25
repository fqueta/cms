<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Qlib\Qlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    /**
     * Metodo para mudar os status de todas as postagens
     */
    public function chage_status(Request $request){
        $d = $request->all();
        $id = isset($d['id']) ? $d['id'] : false;
        $status = isset($d['status']) ? $d['status'] : false;
        $tab = isset($d['tab']) ? $d['tab'] : false;
        // $status = (int)$status;
        $ret['exec'] = false;
        // $ret['d'] = $d;
        $ret['mens'] = 'Erro ao atualizar!';
        $ret['color']='danger';
        if($id && $tab && $status){
            $dsalv = false;
            if($tab=='posts'){
                $arr_status = ['true'=>'publish','false'=>'pending'];//(new PostsController)->campos()['post_status']['arr_opc'];
                $ret['status'] = $arr_status[$status];
                $dsalv = ['post_status' => $arr_status[$status]];
            }elseif($tab=='biddings' || $tab=='permissions'){
                $arr_status = ['true'=>'s','false'=>'n'];//(new PostsController)->campos()['post_status']['arr_opc'];
                $ret['status'] = $arr_status[$status];
                $dsalv = ['active' => $arr_status[$status]];
            }else{
                $arr_status = ['true'=>'s','false'=>'n'];//(new PostsController)->campos()['post_status']['arr_opc'];
                $ret['status'] = $arr_status[$status];
                $dsalv = ['ativo' => $arr_status[$status]];
            }
            if(isset($arr_status[$status]) && $dsalv){
                $ret['salv'] = DB::table($tab)->where('id',$id)->update($dsalv);
                if($ret['salv']){
                    $ret['exec'] = $ret['salv'];
                    $ret['mens'] = 'Atualizado com sucesso!';
                    $ret['color'] ='success';
                }
            }
        }
        return $ret;
    }
}
