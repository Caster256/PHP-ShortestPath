<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<?php  
			include ("configure.php");
			$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");
			mysqli_set_charset($link, "utf8");
		 ?>
	</head>
	<body>
	<!-- 註冊是否成功 -->
		<?php			
			//取得使用者資料
			$account = isset($_POST["account"]) ? $_POST["account"] : "";
			$name = isset($_POST["name"]) ? $_POST["name"] : "";
			$pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
			//先判斷帳號是否重複再存入資料庫中		
			$query = "SELECT `account` FROM `data`";
			$result = mysqli_query($link, $query) or die("Connect DBs Table Error!");
			$tf = true;
			while($row=mysqli_fetch_array($result))		
			{
				if (strcasecmp($account, $row["account"]) == 0)	//判斷帳號是否重複
				{
					$tf = false;		//帳號重複
					break;
				}
				else
					$tf = true;			//帳號可以使用
			}
			mysqli_free_result($result);
			if($tf)
			{
				//存入資料
				$query = "INSERT INTO `data` (`account`,`name`,`password`) VALUES ('$account','$name','$pwd')";
				$result = mysqli_query($link, $query) or die("Connect DBi Table Error!");	
				mysqli_close($link);
				echo "<script type=\"text/javascript\"> alert('註冊成功！');document.location.href='index_go.php'; </script>";  //顯示成功訊息
				//echo "<script type=\"text/javascript\"> document.location.href='index_go.php' </script>";	//回到首頁
				//header("Location: rdok.php");
			}
			else
			{
				echo "<script type=\"text/javascript\"> alert('帳號重複！');document.location.href='registered.php'; </script>";		//顯示錯誤訊息
				//echo "<script type=\"text/javascript\"> document.location.href='registered.php' </script>";	  //回到註冊畫面
				//header("Location: rdno.php");
			}
		 ?>
	</body>
</html>