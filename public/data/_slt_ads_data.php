<?php  
	header('Content-Type:text/html;charset=utf-8');
	if($_POST["action"] == "pathplan") {
		include("configure.php");
		$at = htmlspecialchars($_POST["at"]); //帳號
		$len = strlen($at);	//長度，大於20為google的id，大於10的為fa的id，小於10的為userdata的id
		$f_l_ads;//存放起訖點
		$std_ads;//存放學生姓名地址
		if((int)$len > 20) {
			$field = "google_id";
			$table = "google";
		}
		else if((int)$len > 10) {
			$field = "fb_id";
			$table = "facebook";
		}
		else {
			$field = "userid";
			$table = "userdata";
		}
		$query = "SELECT `firstaddress`,`lastaddress` FROM `address` WHERE `$field` = '$at'";
		$f_l_ads = slt($link,$query);
		if($f_l_ads || $f_l_ads == "") {
			$query = "SELECT `name`,`address` FROM `student_data` WHERE `$field` = '$at'";
			$std_ads = slt($link,$query,"std_data");
			if($std_ads || $std_ads == "") {
				$ret[1] = ($f_l_ads == "") ? false : $f_l_ads;
				$ret[2] = ($std_ads == "") ? false : $std_ads;
				$ret[0] = ($ret[1] || $ret[2]) ? "success" : "no_data";
			}
			else
				$ret[0] = "failure2";
		}
		else
			$ret[0] = "failure1";
	}
	function slt($link,$query) {
		$str = "";
		$result = mysqli_query($link,$query);
		if($result) {
			while ($row = mysqli_fetch_array($result)) {
				$str .= "<tr align=\"center\"\n><td width=\"50%\">".$row[0]."</td\n><td>".$row[1]."</td\n></tr\n>";
			}
			return $str;
		}
		else
			return false;
	}
	echo json_encode($ret);
?>