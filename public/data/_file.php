<?php  
	header('Content-Type:text/html;charset=utf-8');
	session_start();
    /*if($_SESSION["field"] != "v_ip") {
        if($_POST["action"] == "pathplan") {
        	$at = isset($_SESSION["at"]) ? $_SESSION["at"] : "";
        	$documentName = "pathplan";
        }
        else if($_POST["action"] == "admin") {
        	$at = isset($_SESSION["A_at"]) ? $_SESSION["A_at"] : "";
        	$documentName = "admin";
        }
        $txt = $_POST["txt"];
        $path = "log/".$documentName."/";
        $file_name = $at.".txt";
        if(file_exists($path.$file_name)) {  //判斷檔案是否存在
            $myfile = fopen($path.$file_name, "a");
        }
        else {
            $myfile = fopen($path.$file_name, "w"); // or die("Unable to open file!")       
        }
        fwrite($myfile, "執行時間：".date("Y-m-d H:i:s").$txt.PHP_EOL."");
        fclose($myfile);        
    }*/
    $txt = $_POST["txt"];
    $data = array(
        'field' => 'userid'
        , 'at' => $_SESSION['at']
    );
    writeLog($data,"admin","",$txt);
    $ret[0] = "success";
    echo json_encode($ret);
