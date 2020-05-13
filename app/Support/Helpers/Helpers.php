<?php
// /app/Support/Helpers/Helpers.php

// Helper 檔案路徑
$helpers = [
	'func/writeLog.php'
	, 'func/startTime.php'
	, 'func/checkLogin.php'
	, 'func/session.php'
	, 'func/connect.php'
	, 'func/checkUser.php'
	, 'func/GetSQLValueString.php'
	, 'func/logout.php'
	, 'func/getUserData.php'
	, 'class/c_login.php'
	, 'class/c_getUserData.php'
];

// 載入 Helper 檔案
foreach ($helpers as $helperFileName) {
    include __DIR__ . '/' .$helperFileName;
}
