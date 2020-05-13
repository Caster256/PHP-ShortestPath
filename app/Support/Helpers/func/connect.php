<?php 
	function connect() {
		$hostname_conn = "localhost";
		$database_conn = "path_plan";
		$username_conn = "root";
		$password_conn = "love0401";
		try {
			//,array(PDO::ATTR_PERSISTENT => true)  => 若需要長時連結資料庫要加上這行
		    $conn = new PDO("mysql:host=$hostname_conn;dbname=$database_conn",$username_conn,$password_conn);
		    $conn->query('SET NAMES "utf8"');  //設定編碼
		    return $conn;
		    //echo "連結成功<br/>";	    
		    //$link = null;	//關閉資料庫
		} 
		catch (PDOException $e) {
			die ("Error!: " . $e->getMessage() . "<br/>");
		}
	}
