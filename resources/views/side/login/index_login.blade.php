@extends('side.layouts.body')

@section('content')
    <label id = "title">請點選登入方式</label>
    <br/><br/><br/><br/> 
    <div align="left">
        <label id ="main_login"><u>會員登入</u></label>
    </div>      
    <form action="" id="login_form" name="login_form" method="POST" data-ajax="false">
        @csrf
        <table border="0" width="100%">                         
            <tr>    
                <td width="10%">                                
                </td>                   
                <td width="20%">                                
                    <label for="account">帳號：</label>                         
                </td>
                <td>
                    <input type="text" name="account" id="account" required maxlength="10" minlength="4" placeholder="輸入帳號">
                </td>
                <td>
                        <!-- 多一欄讓介面好看一點 -->
                </td>                       
            </tr>
            <tr>
                <td>                                
                </td>
                <td>
                    <label for="pwd">密碼：</label>
                </td>
                <td>
                    <input type="password" name="pwd" id="pwd" required maxlength="10" minlength="4" placeholder="輸入密碼">
                </td>
                <td width="15%">                                                                
                </td>                           
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <input type="submit" value="登入" data-inline = "true">
                    <a href="register" rel="external" data-role = "button" data-inline = "true">註冊</a>
                    <label id="visitor" style="color:blue;"><u><i>訪客登入</i></u></label>
                </td>
            </tr>                                                 
        </table>                            
    </form>         
    <p>
    <div align="left">
        <label id = "other_login"><u>其他登入方式</u></label> <p>                   
    </div>
    <div id="login_img">
        <a href="https://accounts.google.com/o/oauth2/auth?scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.me&redirect_uri=http://localhost/MVC/LA/shortestPath/public/google&response_type=code&client_id=5689275515-hi0btls0k8gc0cgt6h7r311l032318ep.apps.googleusercontent.com&access_type=online" align="center"><img id = "g_login" src = "{{asset('img/g_login2.png')}}"></a><br>
        <fb:login-button scope="public_profile,email" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();"></fb:login-button>
    </div>           ﻿   
@stop

@section('sidebar')
    <script type="text/javascript">
            $(function() {
                $("#visitor").click(function() {
                    var txt = "警告！選擇訪客登入資料將只會保存一天，並不會留下紀錄，若需要長期使用建議其他的登入方式。";
                    if(confirm(txt)) {
                        document.location.href="visitor";
                    }
                });
            });
    </script>
@stop