<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\attachment;
use App\Qlib\Qlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttachmentsController extends Controller
{
    /**
     * Metodo para salvar ou atualizar os meta attachs
     */
    static function update_attachmeta($attach_id,$meta_key=null,$meta_value=null)
    {
        $ret = false;
        $tab = 'meta_attachment';
        if($attach_id&&$meta_key&&$meta_value){
            $verf = Qlib::totalReg($tab,"WHERE attachment_id='$attach_id' AND meta_key='$meta_key'");
            if($verf){
                $ret=DB::table($tab)->where('attachment_id',$attach_id)->where('meta_key',$meta_key)->update([
                    'meta_value'=>$meta_value,
                    'updated_at'=>Qlib::dataBanco(),
                ]);
            }else{
                $da = [
                    'attachment_id'=>$attach_id,
                    'meta_value'=>$meta_value,
                    'meta_key'=>$meta_key,
                    'created_at'=>Qlib::dataBanco(),
                ];

                $ret=DB::table($tab)->insert($da);
            }
        }
        return $ret;
    }

    /**
     * Metodo para pegar os meta attachs
     */
    static function get_attachmeta($attach_id,$meta_key=null,$string=true)
    {
        $ret = false;
        $tab = 'meta_attachment';
        if($attach_id){
            if($meta_key){
                $d = DB::table($tab)->where('attachment_id',$attach_id)->where('meta_key',$meta_key)->get();
                if($d->count()){
                    if($string){
                        $ret = $d[0]->meta_value;
                    }else{
                        $ret = [$d[0]->meta_value];
                    }
                }
            }
        }
        return $ret;
    }
    /**
     * Metodo para atualizar
     */
    public function update(Request $request){
        $d = $request->all();
        $ret['exec'] = false;
        $ret['mens'] = 'Erro ao salvar';
        $ret['color'] = 'danger';
        if(isset($d['id'])){
            $salv = attachment::where('id', $d['id'])->update($d);
            if($salv){
                $ret['exec'] = true;
                $ret['mens'] = 'Atualizado com sucesso';
                $ret['color'] = 'success';
            }
        }
        return $ret;
    }
}
