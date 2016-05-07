@extends("indexMain")
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}"/>
@section('mainContent')
    <div class="signUpForm">
        <form>
            <input class="normalInput" type="text" name="nickname" id="nickname" maxLength="12"
                   placeholder=" 用户名"/>
            <input class="normalInput" type="text" name="account" id="account" maxlength="16"
                   placeholder=" 账号"/>
            <input class="normalInput" type="text" name="city" id="city" maxlength="18"
                   placeholder=" 城市"/>
            <input class="normalInput" type="password" name="password" id="password" maxlength="18"
                   placeholder=" 密码"/>
            <div id="inputHint">一起记录分享运动，享受高品质生活</div>
            <a class="btn btn-primary btn-block" href="javascript:void(0);" id="signUpSummit">注册</a>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $("#signUpSummit").click(function() {
                var nickname = $("#nickname").val();
                var account = $("#account").val();
                var password = $("#password").val();
                var inputHint = $("#inputHint");
                inputHint.text("一起记录分享运动，享受高品质生活");
                inputHint.css("color", "black");
                if(account.length < 6) {
                    inputHint.text("账号长度不能少于6个字符");
                    inputHint.css("color", "red");
                } else if(password.length < 8) {
                    inputHint.text("密码长度不能少于8个字符");
                    inputHint.css("color", "red");
                } else if(nickname.length == 0){
                    inputHint.text("用户名不能为空");
                    inputHint.css("color", "red");
                } else {
                    $.get("../hasNickname?nickname=" + nickname, function(data, statusText) {
                        if(statusText != "success") {
                            inputHint.text("网络异常");
                            inputHint.css("color", "red");
                            return;
                        }
                        if(data=="true") {
                            inputHint.text("用户名已存在");
                            inputHint.css("color", "red");
                        } else {
                            $.get("../hasAccount?account=" + account, function(data, statusText) {
                                if(statusText != "success") {
                                    inputHint.text("网络异常");
                                    inputHint.css("color", "red");
                                    return;
                                }
                                if(data == "true") {
                                    inputHint.text("账号已被注册");
                                    inputHint.css("color", "red");
                                } else {
                                    $.get("../signUp?nickname=" + nickname + "&account=" + account + "&password="
                                            + password, function(data, statusText)
                                    {
                                        if(statusText != "success") {
                                            inputHint.text("网络异常");
                                            inputHint.css("color", "red");
                                            return;
                                        }
                                        if(data == "true") {
                                            location.href = "../signUp/redirect?nickname=" + nickname;
                                        } else {
                                            alert('注册失败..');
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        })
    </script>
    @stop
