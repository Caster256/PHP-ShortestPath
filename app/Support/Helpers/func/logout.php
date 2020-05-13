<?php
	function logout() {
		startSession();
		$data = array(
			'field' => 'userid'
			, 'at' => $_SESSION['at']
		);
		writeLog($data,"admin","logout");
		session_destroy();
	}
