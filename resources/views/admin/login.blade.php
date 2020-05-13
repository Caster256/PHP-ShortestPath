<!DOCTYPE html>
<html>
	<head>
		<title>後台管理系統</title>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap3.3.7.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.min.css')}}">
		<style type="text/css">
			.bgcolor {
				color: blue;
			}
			.btn_slt, #print, #download { 
	            background-color: transparent;
	            border: 0;
	            width:150px;
	            text-align: left;
	            font-size:16px;
        	}
        	.class {
            	text-decoration:underline; /*加入底線*/
            	font-weight: bold; /*粗體*/
       	 	}
       	 	.footer {
       	 		/* 設定footer絕對位置在底部 */
			    position: absolute;
			    bottom: 0;
			    /* 展開footer寬度 */
			    width: 100%;
       	 	}
		</style>
		<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
		<script type="text/javascript">
			$(function() {
                //var w = $(window).width();
                var h = $(window).height();
                $(".overflow").css("height",(h/2));
            });     
		</script>
	</head>
	<body>
		<table border="0" width="100%">
			<tr>
				<td width="50%"><label style="font-size:40px;">後台管理系統</label></td>
				<td width="30%"></td>
				<td width="20%" align="right" valign="top">
					<label>管理者:{{$_SESSION['name']}}</label>		
					<a href="admin/logout">登出</a>			
					<input type="hidden" class="idy" id="{{$_SESSION['id']}}" identity="{{$_SESSION['identity']}}">
				</td>
			</tr>
		</table>
		<hr>
		<div>
		  	<!-- Nav tabs -->
		  	<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">管理者</a></li>
			    <li role="presentation"><a href="#member" aria-controls="member" role="tab" data-toggle="tab">會員資訊</a></li>
			    <li role="presentation"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">地址</a></li>
			    <li role="presentation"><a href="#record" aria-controls="record" role="tab" data-toggle="tab">使用紀錄</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- 管理者資訊 -->
				<div role="tabpanel" class="tab-pane fade in active" id="admin">
					@include('admin.layouts.admin')
				</div>
				<!-- 會員資訊 -->
				<div role="tabpanel" class="tab-pane fade" id="member">
					@include('admin.layouts.member')									
				</div>
				<!-- 地址查詢 -->
				<div role="tabpanel" class="tab-pane fade" id="address">
					@include('admin.layouts.address')					
				</div>
				<!-- 使用紀錄 -->
				<div role="tabpanel" class="tab-pane fade" id="record">
					@include('admin.layouts.record')
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/bootstrap3.3.7.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery-migrate-1.1.0.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jqprint/jquery.jqprint-0.3.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.flexibleArea.js')}}"></script>
		<script type="text/javascript">
			$(function() {				
				var idy = $(".idy").attr("identity"); /*判斷目前登入的是否為root*/
				var id = $(".idy").attr("id"); /*取得當前登入的ID*/
				var revise_id;  /*用於修改資料時存放ID*/
				var DocumentName;  /*用於下載或列印要辨別是呢個資料夾*/
				var FileName;  /*用於下載或列印要辨別是呢個檔案*/
				$("#record_txt").hide();
				if(idy != "root")
					$(".revise").attr("disabled",true);  /*非root則關閉修改按鈕*/
				$("#A_ud"+id).addClass('bgcolor');	/*明顯顯示登入的使用者為誰*/
				$("#ud"+id).addClass('bgcolor');	/*明顯顯示登入的使用者為誰*/
				$("#clear").attr("disabled",true);	/*地址清除紐關閉*/
				$("#clear2").attr("disabled",true);	/*log清除紐關閉*/
				$("#d_p").hide();	/*隱藏下載與列印按鈕*/
				/*更改身分欄位*/
				$(".idy").change(function() {	
					var values = {}; /*物件陣列-修改資料*/
					var values2 = {};/*上傳至log檔*/
					var identity = $(this).find(":selected").val(); /*取更改後的身分*/
					var id = $(this).attr("id");	/*取id*/	
					var name = $(this).parents('tr').children('td:eq(1)').text();				
					//alert(id);
					values["idy"] = identity;
					values['count'] = $("#A_count").val();
					values["id"] = id;
					values["action"] = "modify";
					Update(values,id);	/*資料表更新*/
					//alert(id);
					values2["action"] = "admin";
					values2["txt"] = "變更使用者："+name+" 的權限 => "+identity;
					upfile(values2); /*寫入Log*/
				});
				/*修改資料*/
				$(".revise").click(function() {
					revise_id = $(this).attr("id").split("m_uid")[1]; /*取得使用者按哪一個按鈕的ID*/
					var name = $("#n_"+revise_id).attr("name");	/*取得相同ID的名字*/
					var at = $("#a_"+revise_id).attr("name");	/*取得相同ID的帳號*/
					var	pwd = $("#p_"+revise_id).attr("name");	/*取得相同ID的密碼*/
					$("#name").val(name); /*將名字塞到文字框裡*/
					$("#at").val(at);	/*將帳號塞到文字框裡*/
					$("#pwd").val(pwd);	/*將密碼塞到文字框裡*/
					//alert(pwd);									
				});
				//修改使用者資料
				$("#modal_form").validate({
					submitHandler: function(form) {
						var values = {};
						var values2 = {};
						$("#modal_form :input").not(":submit").each(function() {
							var $input = $(this);
							var name = $input.attr('name');
							var value = $input.val();
							values[name] = value;
							values["id"] = revise_id;
							values["action"] = "modify";
						});
						values2["action"] = "admin";
						values2["txt"] = "修改id為："+revise_id+" 的資料";
						$.ajax({
							type:'POST',
					        url:"{{asset('admin/action')}}",
					        data:{values:values},
					        dataType:'json',
					        headers: {
				               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				            },
					        success:function(data) {
					        	if(data.ans == "success") {
									upfile(values2);
									alert("success");
									document.location.reload();
								} else								
									alert("修改失敗");
						    }
						});						
					}
				});
				/*刪除資料*/
				$(".delete").click(function() {
					var table = $(this).attr("name");/*取得該欄位屬於那個資料表*/
					var str_id = $(this).attr("id"); /*取刪除按鈕id的字串*/
					var id = str_id.split(table+"_del")[1]; /*用.split()取得字串中的數字(id)*/
					var values = {};	
					var values2 = {};
					var tf = true;
					var name = $(this).parents('tr').children('td:eq(1)').text();
					values["table"] = table;
					values["id"] = id;
					values["action"] = "del";
					if(table == "userdata") {
						var identity = $("#"+id).find(":selected").val(); /*取得身分*/
						//alert(identity); 
						if(identity == "general") { /*身分為一般才能刪除*/
							Delete(values,"#ud"+id)  /*刪除資料表(userdata)的資料*/					
						}
						else {
							alert("請先降為一般會員再刪除資料");
							tf = false;
						}
					}
					else if (table == "facebook") {
						Delete(values,"#fb"+id);	/*刪除資料表(facebook)的資料*/				
					}
					else if (table == "google") {
						Delete(values,"#ge"+id);	/*刪除資料表(google)的資料*/
					}
					else
						Delete(values,"#vt"+id);
					if(tf) {
						values2["txt"] = "刪除資料表為："+table+" 的使用者 => "+name+" 的資料";
						upfile(values2);
					}
				});			
				//顯示地址查詢結果
				$("#slt_button").click(function() {
					var at = $("#slt_at").val(); //取得輸入的帳號
					clear();
					if(at != "") {  //若有輸入帳號，就查詢資料
						var values = {};
						var	values2 = {};
						var txt;
						values["at"] = at;
						values["action"] = "pathplan";
						$.post("{{asset('data/_slt_ads_data.php')}}", values, function(response, content){
							if(response[0] == 'success') {
								if(response[1])  //判斷資料庫是否有資料
									$("#f_l_data").append(response[1]);
								if(response[2])	//判斷資料庫是否有資料
									$("#std_data").append(response[2]);
								$("#clear").attr("disabled",false);
								txt = "查詢帳號為："+at+" 的地址資訊";				
							}
							else if(response[0] == "failure1") {
								alert("查詢失敗1");
								txt = "error_01";
							}
							else if(!(response[1] && response[2])) { //資料庫都沒資料 
								alert("查無資料");
								txt = "查無此資料："+at;
								$("#slt_at").val("");  //將文字框清空
							}
							else {
								alert("查詢失敗2");
								txt = ",error_02";						
							}
							values2["txt"] = txt;
							upfile(values2);
						}, "json");
					}
				});
				//清除地址查詢結果
				$("#clear").click(function() {
					var values = {};
					$("#clear").attr("disabled",true); /*關閉清除紐*/
					$("#slt_at").val("");  /*清除輸入框的字*/
					clear();
					values["action"] = "admin";
					values["txt"] = "清除地址資訊";
					upfile(values);
				});
				//游標移過去會有反白的效果
				$(".btn_slt").hover( function() {  
	                $(this).addClass('class');
	            },
	            function() {
	                $(this).removeClass('class');
	            });
	            //查詢紀錄
	            $(".btn_slt").click(function() {
	            	$("#record_txt").empty(); //清除該DOM內的資料
	            	DocumentName = $(this).attr("id"); //取得檔案放置的資料夾名稱
	            	FileName = $("#slt_at2").val();	//取得帳號
	            	if(FileName != "") {
		            	var values = {};
		            	values["DocumentName"] = DocumentName;
		            	values["FileName"] = FileName;
		            	values["action"] = "admin";
		            	get_record_txt(values,FileName,DocumentName);  //顯示查詢log紀錄的結果
		           		$("#clear2").attr("disabled",false); 	//開啟清除紐
		            }	
	            });
	            //清除log查詢
	            $("#clear2").click(function() {
	            	$("#record_txt").empty(); //清除該DOM內的資料
	            	$("#record_txt").hide();
	            	$("#slt_at2").val("");
	            	$("#clear2").attr("disabled",true);
					$("#d_p").hide();
	            	var values = {};
	            	values["action"] = "admin";
	            	values["txt"] = "清除log紀錄";
	            	upfile(values); //紀錄log
	            });
	            //列印出log查詢結果
	            $("#print").click(function() {
	            	/*var html = $("#tab_record").html(); //列印指定的範圍，如果按了又按取消會有小BUG
	            	var bodyHtml = document.body.innerHTML;
	            	document.body.innerHTML = html;
	            	window.print();
	            	document.body.innerHTML = bodyHtml;*/
	            	var values = {};
	            	values["txt"] = "列印帳號為："+FileName+" 在 "+DocumentName+" 的log檔";
	            	values["action"] = "admin";
	            	upfile(values);
	            	$("#record_txt").jqprint();	//列印指定的範圍
	            });
	            //下載log文字檔
	            $("#download").click(function() {
	            var values = {};
	            values["txt"] = "下載帳號為："+FileName+" 在 "+DocumentName+" 的log檔";
	           	values["action"] = "admin";
	            upfile(values); //紀錄log
	            document.location.href="{{asset('data/download.php')}}?at="+FileName+"&D_N="+DocumentName;
	          	});
			});
			//刪除資料 /*刪除的副程式，利用ajax的方式刪除資料，不必重載頁面*/
			function Delete(values,tr) {
				$.ajax({
					type:'POST',
				    url:"{{asset('admin/action')}}",
				    data:{values:values},
				    dataType:'json',
				    headers: {
			           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
				    success:function(data) {
				    	if(data.ans == "success")
							$(tr).remove(); /*將表格刪除*/
						else 
							alert('刪除失敗');							
				    }
				});
				}
			//改變身分
			function Update(values,id) {  /*更新資料的副程式*/
				$.ajax({
					type:'POST',
				    url:"{{asset('admin/action')}}",
				    data:{values:values},
				    dataType:'json',
				    headers: {
			           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
				    success:function(data) {
				     	if(data.ans['ans'] == "success") {
							$("#uptime"+id).html(data.ans['time']); /*更新表格中的時間*/
							if(data.ans['idy'] == "admin") {
								//alert(1);
								$("#admin_tab").append(data.ans['tr']); /*新增欄位到管理者的表格*/
							} else {
								//alert(2);
								$("#A_ud"+id).remove(); /*刪除管理者表格中的欄位*/
							}
							$("#A_count").val(data.ans['count']);
						} else
							alert("更新失敗");
					}
				});				
				return;
			}
			//清除地址查詢結果
			function clear() {
				$("#f_l_data").empty();	//將表格內的DOM刪除
				$("#std_data").empty(); //將表格內的DOM刪除
				return;
			}
			//寫入log
			function upfile(values) {
				$.ajax({
					type:'POST',
			        url:"{{asset('admin/writeLog')}}",
			        data:{values:values},
			        dataType:'json',
			        headers: {
		               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            },
			        success:function(data) {
						//success
				    }
				});
			}
			//讀取文字檔(log)
			function get_record_txt(values,name,d_n) {
				$.post("{{asset('data/_get_record_txt.php')}}", values, function(response, content){
					var values = {};
					var txt;
					if(response[0] == 'success') {
						$("#record_txt").show();				
						var data = "";
						var tag = response.length;
						//alert(response[1]);
						for (var i = 1; i < tag; i++) {
							data += response[i]+"\n";
						}						
						txt = "查詢帳號為："+name+" 的管理員log紀錄";
						$("#record_txt").append(data);
						$('textarea').flexible(); //讓多行文字方塊自動增減
						//$("#record_txt").html("<td>").append(data).append("</td>");
						$("#d_p").show();
					}
					else {
						alert("查無此資料");
						txt = "查無此帳號："+name;
					}					  
		            values["txt"] = txt;
		            values["action"] = "admin";
	           		upfile(values);	//log紀錄
				}, "json");				
				return;
			}
		</script>
	</body>
</html>