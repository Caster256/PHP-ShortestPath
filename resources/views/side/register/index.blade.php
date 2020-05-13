@extends('side.layouts.body')

@section('content')
	<br/>
	<form action="" id="registered_form" data-ajax="false" name="registered_form" method="POST">
		@csrf
		<table border="0" width="100%">						
			<tr>
				<td width="20%">
					姓名：
				</td>
				<td>
					<input type="text" name="name" required placeholder="輸入姓名">
				</td>
				<td>
					<!-- 留一欄讓版面好看點 -->
				</td>
			</tr>
			<tr>
				<td>
					帳號：
				</td>
				<td width="70%">
					<input type="text" name="account" required id = "txt" maxlength="10" minlength="4" placeholder="輸入帳號">
				</td>
				<td>
					<!--<input type="submit" value="檢查"> -->
				</td>
			</tr>
			<tr>
				<td>
					密碼：
				</td>
				<td>
					<input type="password" name="pwd" required id="pwd" maxlength="10" minlength="4" placeholder="輸入密碼">
				</td>
				<td>
					<!-- 留一欄讓版面好看點 -->
				</td>
			</tr>
			<tr>
				<td colspan="3" align="center">								
					<input type="submit" name="submit" value="確定" data-inline = "true">
					<a href="login" data-role = "button" data-inline = "true" rel="external">取消</a>	
				</td>
			</tr>
		</table>
	</form>
@stop