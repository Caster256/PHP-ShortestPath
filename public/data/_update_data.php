<?php  
	header('Content-Type:text/html;charset=utf-8');
	if($_POST['action'] == "pathplan") {
		include("configure.php");
		$idy = $_POST["idy"];
		$id = $_POST["id"];
		$query = "UPDATE `userdata` SET `identity` = '$idy' WHERE `id` = '$id'";
		$result = mysqli_query($link, $query);
		if($result) {
			$query = "SELECT * FROM `userdata` WHERE `id` = '$id'";
			$result = mysqli_query($link, $query);
			if($result) {
				$row = mysqli_fetch_array($result);
				$ret[0] = "success";
				$ret[1] = $row["identity"];
				$ret[2] = $row["update_time"];	
				$ret[3] = "<tr id=A_ud".$id." align=\"center\"><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["account"]."</td><td>*****</td><td>".$row["register_time"]."</td><td>".$row["update_time"]."</td></tr>";	
			}
			else
				$ret[0] = "failure";
		}
		else
			$ret[0] = "failure";
	}
	echo json_encode($ret);
?>