<?php
	function getAdmin() {
		$data = new getUserData();
		return $data->getAdmin();
	}
	function getAll() {
		$data = new getUserData();
		return $data->getAll();
	}
	function getAt() {
		startSession();
		$at = $_SESSION['at'];
		return $at;
	}