<?php  
	header('Content-Type:text/html;charset=utf-8');
	if($_POST["action"] == "pathplan") {
		include("configure.php");
		$id = $_POST["id"];
		$name = htmlspecialchars($_POST["name"]);
		$at = htmlspecialchars($_POST["account"]);
		$pwd = htmlspecialchars($_POST["pwd"]);
		$query = "UPDATE `userdata` SET `name` = '$name',`account` = '$at',`password` = '$pwd' WHERE `id` = '$id'";
		$result = mysqli_query($link, $query);
		if($result) 
			$ret[0] = "success";		
		else
			$ret[0] = "failure";
	}
	echo json_encode($ret);
?>