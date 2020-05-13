<table class="table" border="0">
	<tr align="center">
		<td width="10%"></td>
		<td>登入IP</td>				
		<td>到期時間</td>						
		<td width="10%">刪除</td>
	</tr>
	@foreach($data['visitor'] as $item)
		<tr align="center" id="vt{{$item->id}}">
			<td>{{$loop->iteration}}</td>
			<td>{{$item->ip}}</td>		
			<td class="last_time">{{$item->last_time}}</td>				
			<td>
				<button class="delete" name="visitors" id="visitors_del{{$item->id}}">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</td>
		</tr>	
	@endforeach
</table>