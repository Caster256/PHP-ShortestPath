<?php
	class getUserData
	{
		public function getAdmin()
		{
			$conn = connect();
			$query = "
				SELECT *
				FROM userdata
				WHERE identity = admin
			";
			$result = $conn->prepare($query);
			$result->execute();
			$row = $result->fetchALL(PDO::FETCH_ASSOC);
			return $row;
		}
		public function getAll()
		{
			$conn = connect();
			$query = "
				SELECT *
				FROM userdata
			";
			$result = $conn->prepare($query);
			$result->execute();
			$row = $result->fetchALL(PDO::FETCH_ASSOC);
			return $row;
		}
	}