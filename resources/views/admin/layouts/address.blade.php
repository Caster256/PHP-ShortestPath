<div align="center">
	<label><h1>地址查詢<h1></label>
</div>
<table border="0">
	<tr>
		<td>
			<label style="font-size:16px;margin-bottom:0px;">輸入用戶帳號：</label>
		</td>
		<td>
			<div class="input-group">
				<input type="text" id="slt_at" class="form-control" placeholder="Search for account">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="slt_button">Go!</button>
				</span>
			</div>
		</td>
		<td>
			<button type="button" class="btn btn-default" id="clear">Clear</button>
		</td>
	</tr>
</table>
<!-- 由於資料表中的ID問題，建議以後都使用相同的ID來辨識(U_ID、G_ID)，所以名字跟帳號就不顯示出來 
<label>姓名：<div id="view_name"></div></label>
<label>帳號：<div id="view_at"></div></label>-->
<!-- 固定在網頁上的表格 -->
<br>
<div class="row" style="margin-right:0px;margin-left:0px;">
	<div class="col-md-6" style="overflow:auto;height:300px;border:0px silver solid;">
		<table id="slt_f_l_ads" class="table" border="0">
			<tr align="center">
				<td width="50%">起點</td>
				<td>終點</td>
			</tr>
			<tr>
				<td colspan="2" id="fl_table" style="padding-top: 0px">
				<!-- 裡面的DOM在jquery那邊自動產生與刪除 -->
					<table id="f_l_data" class="table" border="0">						
					</table>
				</td>
			</tr>							
		</table>
	</div>
  	<div class="col-md-6" style="overflow:auto;height:300px;border:0px silver solid;">
	  	<table id="slt_student_ads" class="table" border="0">
			<tr align="center">
				<td width="50%">學生姓名</td>
				<td>地址</td>
			</tr>
			<tr>
				<td colspan="2" id="std_table" style="padding-top: 0px">
					<!-- 裡面的DOM在jquery那邊自動產生與刪除 -->
					<table id="std_data" class="table" border="0">							
					</table>
				</td>
			</tr>										
		</table>
  	</div>
</div>