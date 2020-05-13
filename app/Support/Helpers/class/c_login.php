<?php
	class Login
	{
		public function check($account,$pwd)
		{
			$at = GetSQLValueString($account,"string");
			$pwd = GetSQLValueString($pwd,"string");
			return $this->checking($at,$pwd);
		}
		private function checking($at,$pwd)
		{
			$conn = connect();
			$query = "
				SELECT *
				FROM userdata
				WHERE account = ?
					AND password = ?
			";
			$result = $conn->prepare($query);
			$result->execute(array($at,$pwd));
			$row = $result->fetch(PDO::FETCH_ASSOC);
			if($row != "") {
				if($row["identity"] == "general")
					return "failure";
				else {
					startSession();
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['identity'] = $row['identity'];
					$_SESSION['at'] = $row['account'];
					$data = array(
						'field' => 'userid'
						, 'at' => $row['account']
					);
					writeLog($data,"admin","login");
					return "success";
				}
			}
			else
				return "error";
		}
	}