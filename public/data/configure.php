<?php
	// �ۭq�ܼ�(Variable)
	$hostname = "localhost";		/* MySQL���D���W�� */
	$username = "root";		/* MySQL���ϥΪ̦W�� */
	$password = "love0401";		/* MySQL���ϥΪ̱K�X */
	$database = "path_plan";			/*��Ʈw�W��*/
	$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");
	mysqli_set_charset($link, "utf8");

	//	mysqli_connect�s�u�ʧ@�i�b���ɮפ�����
	//	$link = mysqli_connect($hostname, $username, $password, $database) OR die("Error: Unable to connect to MySQL.");

	// ��i�ۦ�w�q�`��(Constant)�A�аѦ� http://php.net/manual/en/function.define.php
	define('HTTP_SERVER', 'http://www.ntunhs.edu.tw/');

?>
