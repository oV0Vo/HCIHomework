@extends("indexMain")
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/signIn.css')}}"/>
@section('mainContent')
    <div class="signInForm">
        <div id="signInTitle">登录</div>
        <form>
            <input class="normalInput" type="text" name="account" id="account" maxlength="16"
                   placeholder=" 账号"/>
            <input class="normalInput" type="password" name="password" id="password" maxlength="18"
                   placeholder=" 密码"/>
            <div id="inputHint">一起记录分享运动，享受高品质生活</div>
            <a class="btn btn-primary btn-block" href="javascript:void(0);" id="signInSummit">登录</a>
        </form>
    </div>
    <script>
        $(document).ready(function() {
           $('#signInSummit').click(function(event) {
               var account = $('#account').val();
               var password = $('#password').val();
               var inputHint = $('#inputHint');
               inputHint.text("一起记录分享运动，享受高品质生活");
               inputHint.css("color", "black");
               if(account.length == 0) {
                   inputHint.text('请输入账号');
                   inputHint.css('color', 'red');
                   return;
               }
               if(password.length == 0) {
                   inputHint.text('请输入密码');
                   inputHint.css('color', 'red');
                   return;
               }
               $.get('../signIn?account=' + account + '&password=' + password, function(data, statusText) {
                    if(statusText != 'success') {
                        inputHint.text('网络异常');
                        inputHint.css('color', 'red');
                        return;
                    }
                    if(data == 'true') {
                        location.href = '../home';
                    } else {
                        inputHint.text('用户名或密码错误');
                        inputHint.css('color', 'red');
                        return;
                    }
               });
               event.stopPropagation();
           })
        });
    </script>
    @stop