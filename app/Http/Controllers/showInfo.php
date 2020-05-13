<?php

	namespace App\Http\Controllers;

	use View; //必要的，才能使用view();
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;

	class showInfo extends Controller
	{
	    //起始位置
		public function firstAds(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			if(!$user_data)
				return View::make('side.login.relogin');
			$id = $request->session()->get('f_l_ads_id'); //若有ID 則先是該ID對應的起點
			if (isset($id)) {
				$ads = DB::table('address')->where('id',$id)->first();
			} else {
				$ads = DB::table('address')->where($user_data['field'],$user_data['at'])->orderBy('input_time','desc')->first();  //取最後一次更新的資料
			}
			if(isset($ads)){
				$request->session()->put('f_l_ads_id',$ads->id);  //儲存該欄位的ID
				$firstaddress = $ads->firstaddress;
			} else {
				$firstaddress = "";
			}
			$data = array(
				'title' => '起始位置選擇'
				, 'cssFile' => 'ads.css'
				, 'picFile' => 'bg3.png'
				, 'ads' => $firstaddress
				, 'bootstrap' => 'true'
			);
			return View::make('side.show.ads_st')
				->with('data', $data)
				->with('user_data', $user_data);
		}
		//終點位置
		public function lastAds(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			$id = $request->session()->get('f_l_ads_id');
			if(isset($id))				
				$ads = DB::table('address')->where('id',$id)->first();
			$last_ads = isset($ads->lastaddress) ? $ads->lastaddress : ""; 
			$data = array(
				'title' => '終點位置選擇'
				, 'cssFile' => 'ads.css'
				, 'picFile' => 'bg3.png'
				, 'ads' => $last_ads
				, 'bootstrap' => 'true'
			);
			return View::make('side.show.ads_last')
				->with('data', $data)
				->with('user_data', $user_data);
		}
		//儲存起訖點
		public function saveAds(Request $request, $field)
		{
			$ads = $request->input('ads');
			$user_data = $request->session()->get('user_data');
			$path = $this->getPath($user_data['field']);
			if($field == "first") {
				$check = DB::table('address')->where([
					[$user_data['field'],$user_data['at']]
					,['firstaddress',$ads]
				])->first();
				if(isset($check)) {
					/*print_r($check);
					echo "<br>";
					print_r($check->id);
					exit;*/
					$request->session()->put('f_l_ads_id',$check->id);					
				} else {
					$id = DB::table('address')->insertGetId(
						[
							$user_data['field'] => $user_data['at']
							, 'firstaddress' => $ads
						]						
					);
					$request->session()->put('f_l_ads_id', $id);					
				}
				$txt = "儲存起始位置為：".$ads;
				writeLog($user_data,$path,"",$txt);			
				return redirect('lastads');
			} else {
				$id = $request->session()->get('f_l_ads_id');
				DB::table('address')->where('id',$id)->update(['lastaddress' => $ads]);
				$txt = "儲存終點位置為：".$ads;
				writeLog($user_data,$path,"",$txt);
				return redirect('stuads');
			}
		}
		//輸入學生資訊
		public function stuAds(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			if(!$user_data)
				return View::make('side.login.relogin');
			$count = $this->getStuCount($user_data['field'],$user_data['at']);
			$data = array(
				'title' => '輸入學生資訊'
				, 'cssFile' => 'stu.css'
				, 'picFile' => 'bg5.png'
				, 'stu_count' => $count
				, 'bootstrap' => 'true'
			);
			return View::make('side.show.stu_info')
				->with('data', $data)
				->with('user_data', $user_data);
		}
		//ajax-新增學生資訊
		public function putStu(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			$name = $_POST["values"]["name"];
			$ads = $_POST["values"]["ads"];
			$path = $this->getPath($user_data['field']);
			DB::table('student_data')->insert([
				$user_data['field'] => $user_data['at']
				, 'name' => $name
				, 'address' => $ads
			]);
			$count = $this->getStuCount($user_data['field'],$user_data['at']);
			$txt = "新增學生：".$name." ".$ads;
			writeLog($user_data,$path,"",$txt);
			return response()->json(array('count'=> $count));
		}
		//確認資料
		public function check(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			if(!$user_data)
				return View::make('side.login.relogin');
			$data = array(
				'title' => '確認學生資訊'
				, 'cssFile' => 'check.css'
				, 'bootstrap' => 'true'
			);
			$ads_data = DB::table('address')->where($user_data['field'],$user_data['at'])->get();
			$stu_data = DB::table('student_data')->where($user_data['field'],$user_data['at'])->get();
			return View::make('side.show.check_data')
				->with('data', $data)
				->with('user_data', $user_data)
				->with('ads_data', $ads_data)
				->with('stu_data', $stu_data);
		}
		//修改資料
		public function modify(Request $request,$type,$id)
		{
			$user_data = $request->session()->get('user_data');
			if(!$user_data)
				return View::make('side.login.relogin');
			$info = DB::table($type)->where('id',$id)->first();
			/*echo $info;
			exit;*/
			$data = array(
				'title' => '更新資料'
				, 'type' => $type
				, 'id' => $id
				, 'info' => $info
			);
			return View::make('side.show.modify')
				->with('data', $data)
				->with('user_data', $user_data);
		}
		//修改上傳
		public function update(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			$input = $request->all();
			$table = $input['check'];
			$id = $input['id'];
			$path = $this->getPath($user_data['field']);
			if($table == "address") {
				$one = $input['f_ads'];
				$two = $input['l_ads'];
				$field1 = 'firstaddress';
				$field2 = 'lastaddress';
				$txt = "修改id為：".$id."；起點：".$one."；終點：".$two;
			} else {
				$one = $input['name'];
				$two = $input['ads'];
				$field1 = 'name';
				$field2 = 'address';
				$txt = "修改id為：".$id."；姓名：".$one." ".$two;
			}
			DB::table($table)->where('id',$id)->update([
				$field1 => $one
				, $field2 => $two
			]);
			writeLog($user_data,$path,"",$txt);
			return redirect('check');
		}
		//刪除資料
		public function delete(Request $request,$type,$id)
		{
			$user_data = $request->session()->get('user_data');
			$path = $this->getPath($user_data['field']);
			if(!$user_data)
				return View::make('side.login.relogin');
			DB::table($type)->where('id',$id)->delete();
			$txt = "刪除 ".$type." 中 id為：".$id."的資料";
			writeLog($user_data,$path,"",$txt);
			return redirect('check');
		}
		//規劃路徑
		public function planPath(Request $request)
		{
			$user_data = $request->session()->get('user_data');
			if(!$user_data)
				return View::make('side.login.relogin');
			$stu_info = DB::table('student_data')->where($user_data['field'],$user_data['at'])->get();
			$ads = DB::table('address')->where($user_data['field'],$user_data['at'])->get();
			$path = $this->getPath($user_data['field']);
			$data = array(
				'title' => '規劃路線'
				, 'cssFile' => 'plan_path.css'
				, 'stu_info' => $stu_info
				, 'ads' => $ads
				, 'bootstrap' => 'true'
			);
			$txt = "開始規畫路徑";
			writeLog($user_data,$path,"",$txt);
			return View::make('side.show.plan_path')
				->with('data', $data)
				->with('user_data', $user_data);
		}
		//取得學生筆數
		private function getStuCount($field,$at)
		{
			$count = DB::table('student_data')->where($field, $at)->count();
			return $count;
		}
		//取得log紀錄位置-用外來鍵欄位來判斷
		private function getPath($field)
		{
			if($field == 'fb_id')
				$path = 'pathplan/fb';
			elseif($field == 'google_id')
				$path = 'pathplan/google';
			else
				$path = 'pathplan';
			return $path;
		}
	}
