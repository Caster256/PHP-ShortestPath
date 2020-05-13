<!DOCTYPE html>
<html>
	<head>
        <title>{{$data['title'] or 'default'}}</title>
	    <meta charset="UTF-8">	   
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="viewport" content="width=device-width,initial-scale=1">
		<link type="text/css" rel="stylesheet" href="{{asset('js/jqmb/jquery.mobile-1.3.2.min.css')}}">
        @if (isset($data['bootstrap']))
            <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap3.3.7.min.css')}}">
        @endif
        @if (isset($data['cssFile']))
            <link rel="stylesheet" type="text/css" href="{{asset('css/'.$data['cssFile'])}}">
        @endif
        @section('style') 
        @show
        @if (isset($data['picFile']))
        <style type="text/css">
            #content {
                background-image: url('{{asset('img/'.$data['picFile'])}}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
                background-color: white;
            }
        </style>
        @endif		
		<script type="text/javascript" src="{{asset('js/jqmb/demos/js/jquery.js')}}"></script>
		<script type="text/javascript" src = "{{asset('js/jqmb/jquery.mobile-1.3.2.min.js')}}"></script>
        @if (isset($data['bootstrap']))
            <script type="text/javascript" src="{{asset('js/bootstrap3.3.7.min.js')}}"></script>
        @endif
		@if ($data['title'] == "會員登入")
			<script type="text/javascript" src="{{asset('js/hide.js')}}"></script>				
			<script type="text/javascript" src="{{asset('js/fb_verify/fb-api.js')}}"></script>				
	    @endif
        @section('script') 
        @show
        <script type="text/javascript">
            $(function() {
                //var w = $(window).width();
                var h = $(window).height();
                $("#content").css("height",(h-93));
            });            
        </script>
	</head>
	<body>
        <div data-role = "page" id = "home"> 
            @if (isset($data['bootstrap']))
                <div data-role="panel" id="rightpanel" data-position="left" data-display="overlay" data-theme="a">
                    <div align="right">
                        <label>
                            <span class="glyphicon glyphicon-user" aria-hidden="true">
                                {{$user_data["name"]}}
                            </span>
                        </label>
                    </div>
                    <a href="logout" data-role="button" style="color: red;" rel="external">
                        登出 <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                       <!-- <img src="{{asset('img/logout.png')}}" style="width:15px;height:15px;">-->
                    </a>
                    <a href="firstads" class="link" data-role="button" style="color: orange;" rel="external">
                        起始位置<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                    <a href="lastads" class="link" data-role="button" style="color: green;" rel="external">
                        終點位置<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                    <a href="stuads" class="link" data-role="button" style="color: blue;" rel="external">
                        新增資料<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                    <a href="check" class="link" data-role="button" style="color: gray;" rel="external">
                        確認資料<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                    <a href="plan_path" class="link" data-role="button" style="color: purple;" rel="external">
                        規劃路徑<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a><br>
                    @if($user_data["name"] == '訪客')
                    <a href="register" class="link" data-role="button" style="color: block;" rel="external">
                        轉為會員<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                    @endif
                    <a href="#my-header" data-role="button" style="color: #00A15C" data-rel="close">
                        關閉面板 <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>                
                </div>
            @endif
            <div data-role = "header"  data-theme= "e">
                @if (isset($data['bootstrap']))
                    <a href="logout" rel="external">
                        <!--<img src="{{asset('img/logout.png')}}" style="width:15px;height:15px;">-->
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true">
                    </a>
                @endif
                <h4>{{$data['title']}}</h4>
                @if (isset($data['bootstrap']))
                    <a href="#rightpanel">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true">
                        </span>
                    </a>
                @endif
            </div>
            <div data-role = "content" id="content" align="center">
                @yield('content')
            </div>
            <div align = "left">
                <label style="font-size: 13px;"><b>Copyright © 2017-2018 | 黃庭緯,吳珮如</b></label>               
            </div>
            <!--<div data-role = "footer" data-position = "fixed" data-theme="w">
                
            </div>-->
        </div>
	    @section('sidebar')	
	    @show
	</body>
</html>