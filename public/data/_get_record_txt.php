<?php  
	header('Content-Type:text/html;charset=utf-8');
    if($_POST["action"] == "admin") {
    	$D_N = $_POST["DocumentName"];
    	$F_N = htmlspecialchars($_POST["FileName"]);
    	$fp = fopen("../log/".$D_N."/".$F_N.".txt","r");	//開檔
    	if($fp) {
    		$i = 1;		
    		$ret[0] = "success";					
			while (($data = fgets($fp, 4096)) !== false) {  //讀取檔案內的每一行
				$ret[$i] = $data;
				$i++;
			}
		}
		else
			$ret[0] = "failure";
        //$ret[0] = "success";
    }
    echo json_encode($ret);
?>