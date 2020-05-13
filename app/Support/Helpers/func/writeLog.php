<?php
	function writeLog($data,$path,$type='',$content='') {
		startTime();
		$time = date('Y-m-d H:i:s');
		$file_name = $data['at'].'.txt';
		$path = 'log/'.$path.'/'.$file_name;
		if($data['field'] == "userid")
			$table = "userdata";
		else if($data['field'] == 'fb_id')
			$table = "facebook";
		else
			$table = "google";		
		if($content == "") {
			if(file_exists($path)) {
				if($type == "logout")
					$txt = "登出日期：".$time."\r\n";
				else
					$txt = "登入日期：".$time."\r\n";
				$myfile = fopen($path, "a");
			} else {
					$txt1 = "建檔時間：".$time."\r\n";
					$txt2 = "資料表：".$table."\r\n";
				if($type == "logout")
					$txt3 = "登出日期：".$time."\r\n";
				else {					
					$txt3 = "登入日期：".$time."\r\n";					
				}
				$txt = $txt1.$txt2.$txt3;
				$myfile = fopen($path, "w");
			}
		} else {
			$txt = "    執行時間：".$time.",".$content."\r\n";
			$myfile = fopen($path, "a");
		}		
		fwrite($myfile,$txt);
		fclose($myfile);
	}
