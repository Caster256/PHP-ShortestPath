@extends('side.layouts.body')

@section('content')
	<label style="color:red;">起訖點</label>
	<table width="100%" align="center" cellpadding="3" cellspacing="0" border="0" class="table">
		<tr align=center bgcolor="#FFDD88">						
			<td width="50%">起點</td>
			<td>終點</td>											
		</tr>
		@foreach($ads_data as $item)
			<tr align=center bgcolor="#FFEECC">
				<td>
					<b>
						{{$item->firstaddress}}
					</b>
				</td>
				<td>
					<b>
						{{$item->lastaddress}}
					</b>
				</td>
			</tr>
			<tr bgcolor="#FFEECC">
				<td align = "center">
					<a href = "modify/address/{{$item->id}}" data-role = button data-inline=true rel="external">
						<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
					</a>					
				</td>
				<td align = center>
					<a href = "delete/address/{{$item->id}}" data-role = button data-inline=true rel="external">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		@endforeach	
	</table>
	<label style="color:red;">學生資料</label>
	<table width="100%" align="center" cellpadding="3" cellspacing="0" border="0" class="table">
		<tr align=center bgcolor="#FFDD88">						
			<td width="20%">名字</td>
			<td>地址</td>											
		</tr>
		@foreach($stu_data as $item)
			<tr align=center bgcolor="#FFEECC">
				<td>
					<b>
						{{$item->name}}
					</b>
				</td>
				<td>
					<b>
						{{$item->address}}
					</b>
				</td>
			</tr>
			<tr bgcolor="#FFEECC">
				<td  align = "center">
					<a href = "modify/student_data/{{$item->id}}" data-role = button data-inline=true rel="external">
						<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
					</a>
				</td>
				<td align = "center">
					<a href = "delete/student_data/{{$item->id}}" data-role = button data-inline=true rel="external">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		@endforeach
	</table>
	<div align="left">
		<a href="stuads" data-role = "button" data-inline = "true" rel="external">
			<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
			回上一頁
		</a>			
	</div>	
	<div align="left">	
		<a href="plan_path" data-role = "button" data-inline = "true" rel="external">
			開始規畫路徑
			<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
		</a>	
	</div>
@stop

@section('sidebar')
@stop