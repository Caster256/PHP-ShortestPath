<div align="center">
	<label><h1>會員資訊</h1></label>
</div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#at_pwd" aria-controls="at_pwd" role="tab" data-toggle="tab">以帳密登入</a></li>
   	<li role="presentation"><a href="#fb" aria-controls="fb" role="tab" data-toggle="tab">以Facebook登入</a></li>				    	
	<li role="presentation"><a href="#google" aria-controls="google" role="tab" data-toggle="tab">以Google登入</a></li>
	<li role="presentation"><a href="#visitor" aria-controls="visitor" role="tab" data-toggle="tab">以訪客登入</a></li>
</ul>
 <!-- Tab panes -->
<div class="tab-content">
	<!-- 帳密登入 -->
	<div role="tabpanel" class="tab-pane fade in active" id="at_pwd">
		@include('admin.layouts.member.at_pwd')		
	</div>
	<!-- FB登入 -->
	<div role="tabpanel" class="tab-pane fade" id="fb">	
		@include('admin.layouts.member.fb')
	</div>
	<!-- GOOGLE登入 -->
	<div role="tabpanel" class="tab-pane fade" id="google">	
		@include('admin.layouts.member.google')
	</div>
	<!-- 訪客登入 -->
	<div role="tabpanel" class="tab-pane fade" id="visitor">
		@include('admin.layouts.member.visitor')
	</div>
</div>	