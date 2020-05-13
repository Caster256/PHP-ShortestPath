<?php
	function checkUser($data) {
		$login = new Login();
		return $login->check($data['account'],$data['pwd']);
	}