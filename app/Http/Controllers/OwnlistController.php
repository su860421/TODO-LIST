<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Gate;
use App\Ownlist;

class OwnlistController extends Controller
{
    //
    public function newlist(Request $request)//------新增事項
    {
        $create_return_errormsg=array(
           "status" => "false",
           "msg" => "代辦事項新增失敗",
        );
        $return_err=array();
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $create_return_errormsg['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$create_return_errormsg);
        } else {
            $r['email']=Auth::user()->email;
            $validator = Validator::make(
                $r,
                [//驗證
                'email'        => ['required','email'],//限制字母 數字
                'title'        => ['required','alpha_num','max:50'],
                'tododate'          => ['required','date'],
            ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$create_return_errormsg);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $create_return['msg']="";
                    $create_return['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, $create_return);
                }
                echo json_encode((array)$return_err);
            } else {
                $pro = Ownlist::create($r);
                //event(new \App\Events\($pro));//將資料傳送給事件--------尚未設定
                $r['id']=$pro['id'];
                echo json_encode((array)$r);
            }
        }
    }
    public function updatelist(Request $request)//------更新事項
    {
        $create_return_errormsg=array(
           "status" => "false",
           "msg" => "代辦事項更新失敗",
        );
        $return_err=array();
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $create_return_errormsg['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$create_return_errormsg);
        } else {
            $r['email']=Auth::user()->email;
            $validator = Validator::make(
                $r,
                [//驗證
                'title'        => ['alpha_num','max:50'],
                'tododate'          => ['date'],
            ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$create_return_errormsg);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $create_return['msg']="";
                    $create_return['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, $create_return);
                }
                echo json_encode((array)$return_err);
            } else {
                $updatemsg = Ownlist::Where('id', $r['id'])->update(['title'=>$r['title'],'tododate'=>$r['tododate']]);
                return $updatemsg;
            }
        }
    }
    public function updatlist(Request $request)//------調出需要修改的代辦事項內容
    {

      $create_return_errormsg=array(
         "status" => "false",
         "msg" => "",
      );
      $r=$request->all();

      if ($r == null||empty($r) ||!isset($r)) {//
          $create_return_errormsg['msg']="要加雙引號,逗號和{}";
          echo json_encode((array)$create_return_errormsg);
      } else {
          $need_update_list = Ownlist::Where('id', $r['id'])->first();
          return $need_update_list;
      }
    }
    public function finishlist(Request $request)//------已完成事項
    {
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $create_return_errormsg['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$create_return_errormsg);
        } else {
            $finishmsg = Ownlist::Where('id', $r['id'])->update(['finish' => true]);

        }
    }
    public function showlist(Request $request)//------show所有代辦事項
    {
        $create_return_errormsg=array(
         "status" => "false",
         "msg" => "沒有代辦事項",
    );
        $useremail=Auth::user()->email;
        $alllist = Ownlist::Where('email', $useremail)->get();
        if ($alllist) {
            return $alllist;
        } else {
            return $create_return_errormsg;
        }
    }
}
