 //使用者登出用
 function Logout() {
		FB.logout(function(response) {
		// user is now logged out
		alert('已成功登出!');
		window.location.reload();
		document.location.href='index.php';
		});
	}