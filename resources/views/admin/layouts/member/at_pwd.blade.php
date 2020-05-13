<table class="table" border="0">
	<tr align="center">
		<td width="10%"></td>
		<td>姓名</td>
		<td>帳號</td>
		<td>密碼</td>
		<td>身分</td>
		<td width="20%">註冊時間</td>
		<td width="20%">更動時間</td>
		<td width="5%">修改</td>
		<td width="5%">刪除</td>
	</tr>
	@foreach($data['user'] as $item)
		<input type="hidden" name="{{$item->name}}" id="n_{{$item->id}}">
		<input type="hidden" name="{{$item->account}}" id="a_{{$item->id}}">
		<input type="hidden" name="{{$item->password}}" id="p_{{$item->id}}">
		<tr align="center" id="ud{{$item->id}}">
			<td>{{$loop->iteration}}</td>
			<td>{{$item->name}}</td>
			<td>{{$item->account}}</td>
			<td>*****</td>
			<td>
				@if($item->identity == "root")
					<label style="color:red;">root</label>
				@else
					@if($_SESSION['id'] == $item->id)
						<label>admin</label>
					@else
						<select class='idy' id="{{$item->id}}" title="選擇後會立即修改">
							@if($item->identity == "admin")
								<option>admin</option>
								<option>general</option>
							@else
								<option>general</option>
								<option>admin</option>
							@endif
						</select>
					@endif
				@endif
			</td>
			<td>{{$item->register_time}}</td>
			<td id="uptime{{$item->id}}">{{$item->update_time}}</td>
			<td>
				<button class="revise" data-toggle="modal" data-target="#myModal" id="m_uid{{$item->id}}" title="只有root身分才可修改">
					<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
				</button>
			</td>
			@if($item->identity != "root" and $_SESSION['id'] != $item->id)
				<td>
					<button class="delete" name="userdata" id="userdata_del{{$item->id}}">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</td>
			@endif
		</tr>
	@endforeach
</table>
<div class="footer" align="center">
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">								    	
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">修改會員資料</h4>
			</div> 
			<form action="" method="POST" id="modal_form">  
				<div class="modal-body">											
					<label>姓名：</label>
					<input type="text" name="name" id="name" required value=""><br><br>
					<label>帳號：</label>
					<input type="text" name="account" id="at" required value=""><br><br>
					<label>密碼：</label>
					<input type="text" name="pwd" id="pwd" required value="">		   	 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close
					</button>
					<input type="submit" class="btn btn-primary" value="Save changes">
				</div>
			</form>													
		</div>
	</div>											    	
</div>