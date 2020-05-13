<?php  
	header('Content-Type:text/html;charset=utf-8');
	if($_POST['action'] == "pathplan") {
		//include("configure.php");
		$conn = connect();
		$table = $_POST["table"];
		$id = $_POST["id"];
		$query = "DELETE FROM $table WHERE id = $id";
		$result = $conn->query($query);
		//$result = mysqli_query($link, $query);
		if($result)
			$ret[0] = "success";
		else
			$ret[0] = "failure";
	}
	echo json_encode($ret);
?>