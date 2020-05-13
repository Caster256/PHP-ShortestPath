<?php
	namespace App\Http\Controllers;

	use View; //必要的，才能使用view();
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;
	use App\Model\Reg;

	class loginInfo extends Controller
	{
		//兩秒後進入登入畫面
		public function index()
		{
			$data = array(
				'title' => 'ShortestPath'
			);
	        return View::make('side.login.index')
	            ->with('data', $data);
		}
		//登入
		public function login()
		{
			$data = array(
				'title' => '會員登入'
				, 'cssFile' => 'login.css'
				, 'picFile' => 'bg2.png'
			);
	        return View::make('side.login.index_login')
	            ->with('data', $data);
		}
		//註冊
		public function register()
		{
			$data = array(
				'title' => '註冊會員'
				, 'picFile' => 'bg6.png'
			);
			return View::make('side.register.index')
				->with('data', $data);
		}
		//訪客
		public function visitor(Request $request)
		{
			$user_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ""; //取使用者的IP
			if($user_ip == "::1")
				$user_ip = "127.0.0.1";
			if($user_ip != "") {
				$this->visitorCheck($user_ip,$request);				
			}
			return redirect('firstads'); //重導路由
		}
		//登出
		public function logout(Request $request)
		{
			$data = $request->session()->get('user_data');
			if($data['field'] == 'fb_id')
				$path = 'pathplan/fb';
			elseif($data['field'] == 'google_id')
				$path = 'pathplan/google';
			else
				$path = 'pathplan';
			writeLog($data,$path,"logout");
			$request->session()->flush();
			return redirect('login');
		}
		//登入判斷
		public function loging(Request $request)
		{
			$input = $request->all(); //傳回的是陣列格式
			$at = $input["account"];
			$pwd = $input["pwd"];
			$success = DB::table('userdata')->where([['account', $at],['password', $pwd]])->first();
			if(isset($success)) {				
				$session = array(
					'name' => $success->name
					, 'at' => $at
					, 'id' => $success->id
					, 'field' => 'userid'
				);
				$request->session()->put('user_data', $session);
				//$title = '會員登入';
				$path = 'pathplan';
				writeLog($session,$path,"login");		
				return redirect('firstads'); //重導路由
			} else {
				return View::make('side.login.failure');
			}
		}
		//fb登入
		public function fb(Request $request, $id, $name)
		{
			//echo $id.$name;
			$result = DB::table('facebook')->where('fb_id', $id)->first();
			if(empty($result)) {
				$f_id = DB::table('facebook')->insertGetId(
					['fb_id' => $id, 'name' => $name]
				);
			}else {
				$f_id = $result->id;
			}
			$session = array(
				'name' => $name
				, 'at' => $id
				, 'id' => $f_id
				, 'field' => 'fb_id'
			);
			$request->session()->put('user_data', $session);
			$path = 'pathplan/fb';
			writeLog($session,$path,"login");
			return redirect('firstads');
		}
		//google登入
		public function google(Request $request, $id='', $name='')
		{
			if($id == '' and $name == '') {
				return View::make('side.login.gauth');
			} else {
				$result = DB::table('google')->where('google_id', $id)->first();
				if(empty($result)) {
					$g_id = DB::table('google')->insertGetId(
						['google_id' => $id, 'name' => $name]
					);
				}else {
					$g_id = $result->id;
				}
				$session = array(
					'name' => $name
					, 'at' => $id
					, 'id' => $g_id
					, 'field' => 'google_id'
				);
				$request->session()->put('user_data', $session);
				$path = 'pathplan/google';
				writeLog($session,$path,"login");
				return redirect('firstads');
			}
		}
		//註冊判斷
		public function registering(Request $request)
		{
			$visi_data = $request->session()->get('user_data'); //取訪客登入資料
			$data = $request->all(); //取得輸入的資料
			$register = new Reg();
			//判斷是否為訪客轉會員 true 為一般註冊，false 為訪客轉會員
			if(empty($visi_data)) {
				//新註冊 response 成功的話會回傳註冊的id
				$response = $register->register('reg', $data);
			} else {
				//訪客轉會員
				$response = $register->register('cm', $data, $visi_data['at']);
			}
			if(is_numeric($response)) {
				$session = array(
					'name' => $data['name']
					, 'at' => $data['account']
					, 'id' => $response
					, 'field' => 'userid'
				);
				$path = 'pathplan';
				$request->session()->put('user_data', $session);
				writeLog($session,$path,"register");
				return redirect('firstads'); //重導路由
			} else if($response == 'repeat') {
				return View::make('side.register.failure');
			} else {
				echo "error";
			}
		}
		//訪客判斷
		private function visitorCheck($ip,$request)
		{
			startTime();
			$time = date("Y-m-d H:i:s");
			$last_time = date('Y-m-d H:i:s',strtotime("+1 day",strtotime($time)));
			$user_data = array(
				'name' => '訪客'
				, 'at' => $ip
				, 'field' => 'v_ip'
			);
			$request->session()->put('user_data', $user_data);
			$check = DB::table('visitors')->where('ip', $ip)->first();			
			if(isset($check)) {           	
            	if($check->last_time < $time) {
            		DB::table('visitors')->where('id', $check->id)->delete();           		
            	} else {
            		return;
            	}
            }
			DB::table('visitors')->insert(['ip' => $ip, 'last_time' => $last_time]);			
			return;
		}		
	}
