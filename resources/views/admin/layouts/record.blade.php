<div align="center">
	<label><h1>使用紀錄</h1></label>
</div>
<table border="0">
	<tr>
		<td>
			<label style="font-size:16px;margin-bottom:0px;">輸入用戶帳號：</label>
		</td>
		<td>
		    <div class="input-group">
		      	<input type="text" id="slt_at2" class="form-control" placeholder="Search for account">
		      	<div class="input-group-btn">
			        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        		GO! <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
			        	<li>
			            	<button class="btn_slt" id="admin">
			            		管理系統
			            	</button>
			        	</li>
			        	<li>
			            	<button class="btn_slt" id="pathplan">
			            		路徑規劃系統
			            	</button>
			        	</li>
			      	</ul>
			    </div><!-- /btn-group -->
			</div><!-- /input-group -->
		</td>
		<td>
			<button type="button" class="btn btn-default" id="clear2">
				Clear
			</button>
		</td>
	</tr>
</table>
<p>
<div style="width:55%;height:300px;overflow:auto;border:0px silver solid;">
	<textarea id="record_txt" style="width:100%;height:auto;border:0px;" readonly></textarea>
</div><br>
<div id="d_p" align="center">
	<button id="download" style="font-size:25px;width:100px;">
		<span class="glyphicon glyphicon-download-alt"></span>
		下載
	</button>
	<button id="print" style="font-size:25px;width:100px;">
		<span class="glyphicon glyphicon-print"></span>
		列印
	</button>
</div>