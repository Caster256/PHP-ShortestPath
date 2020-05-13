<!DOCTYPE html>
<html>
	<head>
		<title>後台管理系統</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap3.3.7.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.min.css')}}">	
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap2.2.2-combined.min.css')}}">
		<style type="text/css">
			body {
				background-color: lightblue;
			}
			.div1 {
				width: 350px;
				height: 280px;
				position: absolute;
				top: 50%;
				left: 50%;
				margin: -140px 0 0 -175px;
				background-color: white;
			}
			#title {				
				font-size: 20px;
				text-align: center;
			}
			#submit,#forget_pwd {
				font-size: 16px;				
			}
			#account,#pwd {
				/*background-color:lightblue;*/	/*transparent 透明*/
				border: 0px;
				font-size: 20px;
			}
			label.error { 
				display: none; 
				color: red;
			}
		</style>
	</head>
	<body>
		<form action="" method="POST" id="admin_login_form">
			<div align="center" class="div1">
				<table border="0" class="table">
					<tr>
						<td colspan="2" id="title">路徑規劃管理系統</td>
					</tr>					
					<tr>
						<td><label>帳號：</label></td>
						<td>
							<input type="text" name="account" id="account" required maxlength="10" minlength="4" placeholder="輸入帳號">
							<label for="account" class="error">請輸入帳號</label>
						</td>
					</tr>
					<tr>
						<td><label>密碼：</label></td>
						<td>
							<input type="password" name="pwd" id="pwd" required maxlength="10" minlength="4" placeholder="輸入密碼">
							<label for="pwd" class="error">請輸入密碼</label>
						</td>
					</tr>
					<tr>						
						<td><button type="submit" id="submit" class="btn btn-primary">登入</button></td>
						<td><button type="button" name="forget_pwd" id="forget_pwd" class="btn btn-primary">忘記密碼</button></td>
					</tr>
				</table>
				<div id="message" align="left" style="color:red;"></div>
				<label>
					Copyright &copy 2018 <a href="http://shortestpath.ddns.net">http://shortestpath.ddns.net</a>
				</label>
			</div>			
		</form>
		<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/bootstrap3.3.7.min.js')}}"></script>
		<script src="{{asset('js/jquery.validate.js')}}"></script>
		<script type="text/javascript">
			$(function() {
				$("#submit").click(function() {
					$("#admin_login_form").validate({
						submitHandler: function(form) {
							$('#form_submit').attr('disabled', 'disabled');
							var values = {};
							$('#admin_login_form :input').not(':submit').each(function() {
								var $input = $(this);
								var name = $input.attr('name');
								var value = $input.val();
								values[name] = value;
								values['action'] = 'login';
							});
							$.ajax({
								type:'POST',
							    url:'admin',
							    data:{values:values},
							    dataType:'json',
							    headers: {
						           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						        },
							    success:function(data) {
							      	if(data.ans == "success")
							      		document.location.href='admin';
							       	else if (data.ans == "failure")
							       		$('#message').html("此用戶非管理員");
							       	else
							       		$('#message').html("帳號密碼錯誤");
							    }
							});
							/*$.post("{{asset('includes/func/login.php')}}", values, function(response, content){
								if(response[0] == 'success') {
									//window.setTimeout('location.href="index.php"', 0);
									window.setTimeout('location.href="' + response[1] +'"', 0);
								} else {
									$('#message').html(response[0]);
								}
							}, "json");*/
						}
					});
				});
			});
		</script>
	</body>
</html>