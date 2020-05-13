<div align="center">
	<label><h1>管理者資訊</h1></label>
</div>
<table class="table" id="admin_tab" border="0">
	<tr align="center">
		<td width="10%"></td>
		<td>姓名</td>
		<td>帳號</td>
		<td>密碼</td>
		<td width="20%">註冊時間</td>
		<td width="20%">更動時間</td>
	</tr>
	@php $i = 0; @endphp
	<div class="container">
		@foreach($data['admin'] as $item)
			@php $i++; @endphp
			<tr id="A_ud{{$item->id}}" align="center">
				<td>{{$loop->iteration}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->account}}</td>
				<td>*******</td>
				<td>{{$item->register_time}}</td>
				<td>{{$item->update_time}}</td>
			</tr>
		@endforeach
	</div>
	<input type="hidden" id="A_count" value="{{$i}}">
</table>
<div class="footer" align="center">
</div>
