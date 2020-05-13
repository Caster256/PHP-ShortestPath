<table class="table" border="0">
	<tr align="center">
		<td width="10%"></td>
		<td>姓名</td>
		<td>帳號</td>
		<td width="20%">註冊時間</td>
		<td width="5%">刪除</td>
	</tr>
	@foreach($data['fb'] as $item)
		<tr align="center" id="fb{{$item->id}}">
			<td>{{$item->id}}</td>
			<td>{{$item->name}}</td>
			<td>{{$item->fb_id}}</td>				
			<td>{{$item->register_time}}</td>
			<td>
				<button class="delete" name="facebook" id="facebook_del{{$item->id}}">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</td>
		</tr>
	@endforeach
</table>