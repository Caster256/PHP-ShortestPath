<?php
	function checkLogin() {
		startSession();
		if(!isset($_SESSION['name'])) {
			return false;
		}
		return true;
	}
