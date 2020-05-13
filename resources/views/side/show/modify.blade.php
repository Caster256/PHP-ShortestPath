@extends('side.layouts.body')

@section('content')
	<form action="{{asset('modify')}}" data-ajax="false" method=POST>
		@csrf
		<table width="100%" align="center" cellpadding="3" cellspacing="0" border="0">
			<tr align=center bgcolor="#FFDD88">
				@if($data['type'] == "student_data")
					<td width="20%" >名字</td>
					<td >地址</td>
				@else
					<td width="50%" >起點</td>
					<td >終點</td>
				@endif																
			</tr>
			<tr bgcolor="#FFEECC">
				@if($data['type'] == "student_data")
					<td><input type="text" name="name" value="{{$data['info']->name}}"></td>
					<td><input type="text" name="ads" value="{{$data['info']->address}}"></td>
				@else
					<td><input type="text" name="f_ads" value="{{$data['info']->firstaddress}}"></td>
					<td><input type="text" name="l_ads" value="{{$data['info']->lastaddress}}"></td>
				@endif				
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="check" value="{{$data['type']}}">
					<input type="hidden" name="id" value="{{$data['id']}}">
					<input type="submit" data-inline = true value="確定">
					<a href="{{asset('check')}}" data-role = button data-inline = true rel="external">取消</a>
				</td>
			</tr>
		</table>
	</form>				
@stop

@section('sidebar')
@stop