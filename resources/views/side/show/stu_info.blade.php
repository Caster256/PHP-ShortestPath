@extends('side.layouts.body')

@section('content')
	<form action="" id="insert_form" data-ajax="false" name="insert_form" method=POST>
		<br/><br/><br/>	
		<table border="0" width="100%">
			<tr>
				<td align="right">
					名字：
				</td>
				<td>
					<input type="text" name="sname" id="sname" required placeholder="輸入學生的名字">
				</td>
				<td width="15%">								
				</td>
			</tr>					
			<tr>
				<td colspan="3" align="center" id = "color">
					已經輸入 <label id="count">{{$data['stu_count']}}</label> 筆			
				</td>							
			</tr>
			<tr>
				<td align="right">
					地址：
				</td>
				<td>
					<input type="text" name="sads" id="sads" required placeholder="輸入學生的地址">
				</td>
			</tr>
			<tr>
				<td width="30%">
								
				</td>
				<td>
					<button type="button" class="btn btn-primary" onclick="insertStudent()">
	 					新增資料
	 					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					</button>
				</td>
			</tr>	
		</table>
	</form>
	<div align="center">
		<a href="check" data-role = button data-inline = "true" rel=external>
			下一步
			<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
		</a>		
	</div>
@stop

@section('sidebar')
	<script type="text/javascript">			
			function insertStudent() {
				var values = {};
				values["name"] = $("#sname").val();
				values["ads"] = $("#sads").val();
				if(values["name"] == "" || values["ads"] == "")
					alert('請輸入資料!');
				else {
					 $.ajax({
		               type:'POST',
		               url:'{{url('stuads')}}',
		               data:{values:values},
		               dataType:'json',
		               headers: {
	                   		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                   },
		               success:function(data){
		                  $("#count").html(data.count);
		                  $("#sname").val('');
		                  $("#sads").val('');
		               }
		            });
				}	           
	         }	
	</script>
@stop