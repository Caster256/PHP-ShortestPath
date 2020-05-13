@extends('side.layouts.body')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('path/cs.css')}}">
@stop

@section('script')
<script type="text/javascript" src="{{asset('path/map.js')}}"></script>
<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC9W34dxLKMCViq6lWdlAd543cpvlufFDo&callback=initMap"></script>
@stop

@section('content')
	<div id="map" style="height: 300px; position: relative; background-color: rgb(229, 227, 223); overflow: hidden;">
	</div> 
    <b>Start</b>
    <select id="start">
    	@foreach($data['ads'] as $item)
    		<option value="{{$item->firstaddress}}">{{$item->firstaddress}}</option>
    	@endforeach    
    </select>
    <br>  
    <table id="tb1" border="0">
    	<tr>
            <td id="td1"></td>
            <td id="td2"><b>要接送的學生</b></td>
            <td id="td3"><label id="SelectAll">SelectAll</label> </td>
        </tr>
    </table>      
    <select multiple id="waypoints">
    	@foreach($data['stu_info'] as $item)
    		<option value="{{$item->address}}">{{$item->name}}</option>
    	@endforeach 
          <!--<option value="板橋區中正路379巷">路徑1</option>
          <option value="新莊捷運站">新莊捷運站</option>
          <option value="新埔捷運站">新埔捷運站</option> -->    
    </select>
    <br>
    <b>End</b>
    <select id="end">
    	@foreach($data['ads'] as $item)
    		<option value="{{$item->lastaddress}}">{{$item->lastaddress}}</option>
    	@endforeach
    </select>
    <br>
    <button type="submit" id="submit" class="btn btn-primary">送出</button>
     <!-- 街景服務 -->
    <div id ="directions-panel"></div>
    <div data-role="popup" id="popupMap" data-overlay-theme="b" data-theme="b">
        123
        <a href="#" data-rel="back" data-role="button" class="ui-btn-right">back</a>
        <!--<iframe src="{{asset('path/full_path.php')}}" style="width:100%;" height="600" frameborder="0"></iframe>-->
    </div>
@stop

@section('sidebar')
	<script type="text/javascript">
		//全選要接送的學生
		$(document).on("pageinit", function () {           
			$("#SelectAll").click(function () {            
				alert("Select All");
				$('#waypoints option').attr('selected', 'selected');                       
			});
		});
	</script>
@stop