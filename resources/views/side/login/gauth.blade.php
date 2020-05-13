@include('side.login.settings')
@include('side.login.google-login-api')
<?php
session_start();

//require_once('settings');
//require_once('google-login-api');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		$id = $user_info['id'];
		$name = $user_info['displayName'];
		//echo $user_info['displayName'].$user_info['id'];		
		//echo '<pre>';print_r($user_info); echo '</pre>';
		
		// Now that the user is logged in you may want to start some session variables
		$_SESSION['logged_in'] = 1;
		//將資料上傳至資料庫
		header("Location: google/".$id."/".$name);	//跳到地址輸入畫面
		exit;
		// You may now want to redirect the user to the home page of your website
		// header('Location: home.php');
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>