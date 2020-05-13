@extends('side.layouts.body')

@section('content')
	<form action="saveads/first" id="ads_st_form" method="POST" data-ajax="false">
		@csrf
		起始位置：
		<input type="text" name="ads" required id="txtAddress" placeholder="輸入地址" value="{{$data['ads']}}">
		<button type="submit" id="save_ads" class="btn btn-primary">
	 		儲存
	 		<span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
		</button>					
	</form>
@stop

@section('sidebar')

@stop