<?php

namespace App\Http\Controllers;

use View; //必要的，才能使用view();
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Action;

class adminInfo extends Controller
{
    //登入
    public function login()
    {
    	$is_login = checkLogin();
    	if($is_login) {
            $admin = DB::table('userdata')->where('identity', '<>', 'general')->get();
            $user = DB::table('userdata')->get();
            $fb = DB::table('facebook')->get();
            $google = DB::table('google')->get();
            $visitor = DB::table('visitors')->get();
            $data = array(
                'admin' => $admin
                , 'user' => $user
                , 'fb' => $fb
                , 'google' => $google
                , 'visitor' => $visitor
            );
    		return View::make('admin.login')
                ->with('data', $data);
    	} else {
    		return View::make('admin.unlogin');
    	}
    }
    //登出
    public function logout()
    {
        logout();
        return redirect('admin');
    }
    //登入判斷-ajax
    public function loging()
    {
    	$is_check = checkUser($_POST['values']);
    	return response()->json(array('ans'=> $is_check));
    }
    //寫入log檔-ajax
    public function writeLog()
    {
        $at = getAt();
        $value = $_POST['values'];
        $data = array(
            'field' => 'userid'
            , 'at' => $at
        );
        writeLog($data,"admin","",$value['txt']);
        return response()->json(array('ans'=> 'success'));
    }
    //修改刪除-ajax
    public function action()
    {
        $data = new Action();
        $ans = $data->Action($_POST['values']);
        return response()->json(array('ans'=> $ans));
    }
}
