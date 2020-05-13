// This is called with the results from from FB.getLoginStatus().
	  

	  // This function is called when someone finishes with the Login
	  // Button.  See the onlogin handler attached to it in the sample
	  // code below.
	  function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
		function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response);
	    // The response object is returned with a status field that lets the
	    // app know the current login status of the person.
	    // Full docs on the response object can be found in the documentation
	    // for FB.getLoginStatus().		
	    if (response.status === 'connected') {	//成功登入
	      // Logged into your app and Facebook.
	      // testAPI();   //測試用的
		  var uid = response.authResponse.userID;  //抓使用者FB的ID		  
		  FB.api('/me', function(response) {		
			//console.log('Successful login for: ' + response.name);
			//document.getElementById('uname').innerHTML = response.name;	
			var uname = encodeURIComponent(response.name);			//抓使用者的名字	
			//var uname = response.name;
			//alert("登入成功" + uname);
			//document.location.href="other_login/fb/" + uid + "/" + uname;
			document.location.href="fb/"+ uid + "/" + uname;
		  });	      
	      //$("#uid").html(uid);   //存到 PHP的變數裡
	      //document.getElementById('uid').innerHTML = uid;	  
	    } else if (response.status === 'not_authorized') {	//還沒使用此應用程式登入
	      // The person is logged into Facebook, but not your app.
	      document.getElementById('uid').innerHTML = 1;
	    } else {		//曾經登入過 目前尚未登入
	      // The person is not logged into Facebook, so we're not sure if
	      // they are logged into this app or not.
	      document.getElementById('uid').innerHTML = 1;	    
		}};
	  }

	  window.fbAsyncInit = function() {
	  FB.init({
	    appId      : '1899578450365925',
	    cookie     : true,  // enable cookies to allow the server to access 
	                        // the session
	    xfbml      : true,  // parse social plugins on this page
	    version    : 'v2.10' // use version 2.2
	  });

	  // Now that we've initialized the JavaScript SDK, we call 
	  // FB.getLoginStatus().  This function gets the state of the
	  // person visiting this page and can return one of three states to
	  // the callback you provide.  They can be:
	  //
	  // 1. Logged into your app ('connected')
	  // 2. Logged into Facebook, but not your app ('not_authorized')
	  // 3. Not logged into Facebook and can't tell if they are logged into
	  //    your app or not.
	  //
	  // These three cases are handled in the callback function.  

	  };

	  // Load the SDK asynchronously
	  (function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

	  // Here we run a very simple test of the Graph API after login is
	  // successful.  See statusChangeCallback() for when this call is made.
	  function testAPI() {
	    console.log('Welcome!  Fetching your information.... ');
	    FB.api('/me', function(response) {			
			//console.log('Successful login for: ' + response.name);
			//document.getElementById('uname').innerHTML = response.name;	
			var name = response.name;
	    });
		return name;
	  }
	 //使用者登出用
	 function Logout() {
			FB.logout(function(response) {
			// user is now logged out			
			window.location.reload();			
			});
			alert('已成功登出!');
			document.location.href='login';
		}	  