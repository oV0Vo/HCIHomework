@extends("indexMain")
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/signInDetail.css')}}"/>
@section('mainContent')
    <div class="signInForm">
        <div id="signInTitle">注册</div>
        <form >
            <input class="input" type="text" name="nickname" id="nickname" maxlength="16"
                   placeholder=" 昵称"/>
            <span id="nicknameHint"></span><br/>
            <input class="input" type="text" name="account" id="account" maxlength="16"
                   placeholder=" 账号"/>
            <span id="accountHint">&nbsp;&nbsp;8-16位字符</span>
            <input class="input" type="password" name="password" id="password" maxlength="18"
                   placeholder=" 密码"/>
            <span id="passwordHint">&nbsp;&nbsp;8-18位字符，建议大小写混合</span>
            <input class="input" type="password" name="password1" id="password1" maxlength="18"
                   placeholder=" 确认密码"/>
            <span id="password1Hint"></span>
            <br/>
            <input class="input" type="text" name="city" id="city" maxlength="18"
                   placeholder=" 所在城市"/><br/>
            &nbsp;&nbsp;性别：
            <input type="radio" name="sex" value="1" checked/>男<br/>
            <input type="radio" name="sex" value="0"/>女<br/>
            &nbsp;&nbsp;您的职业是：
            <select class="whiteButton" id="userRole">
                <option value="1">个人用户</option>
                <option value="2">健康教练</option>
                <option value="3">医生</option>
            </select><br/>
            &nbsp;&nbsp;喜欢或擅长的运动：
            <input type="checkbox" name="sports" value="1"/>长跑
            <input type="checkbox" name="sports" value="0"/>步行<br/>
            <div id="netHint"></div>
            <a class="btn btn-primary btn-block" href="javascript:void(0);" id="signUpSummit">注册</a>
        </form>
    </div>
    <script>

        $(document).ready(function () {
            $("#signUpSummit").click(function () {
                var nickname = $("#nickname").val();
                var account = $("#account").val();
                var password = $("#password").val();
                var password1 = $("#password1").val();
                if (account.length < 6) {
                    var accountHint = $("#accountHint");
                    accountHint.text("账号长度不能少于6个字符");
                    accountHint.css("color", "red");
                } else if (password.length < 8) {
                    var passwordHint = $("#passwordHint");
                    passwordHint.text("密码长度不能少于8个字符");
                    passwordHint.css("color", "red");
                } else if (password != password1) {
                    var password1Hint = $("#password1Hint");
                    password1Hint.text("前后两次输入的密码不一致");
                    password1Hint.css("color", "red");
                } else if (nickname.length == 0) {
                    var nicknameHint = $("#nicknameHint");
                    nicknameHint.text("用户名不能为空");
                    nicknameHint.css("color", "red");
                } else {
                    $.get("../hasNickname?nickname=" + nickname, function (data, statusText) {
                        if (statusText != "success") {
                            var netHint = $("#netHint");
                            netHint.text("网络异常");
                            netHint.css("color", "red");
                            return;
                        }
                        if (data == "true") {
                            var nicknameHint = $("#nicknameHint");
                            nicknameHint.text("用户名已存在");
                            nicknameHint.css("color", "red");
                        } else {
                            $.get("../hasAccount?account=" + account, function (data, statusText) {
                                if (statusText != "success") {
                                    var netHint = $("#netHint");
                                    netHint.text("网络异常");
                                    netHint.css("color", "red");
                                    return;
                                }
                                if (data == "true") {
                                    var accountHint = $("#accountHint");
                                    accountHint.text("账号已被注册");
                                    accountHint.css("color", "red");
                                } else {
                                    var sex = $(".signInForm [name='sex']:checked").val();
                                    var checkedSports = $(".signInForm [name='sports']:checked");
                                    var sports = [];
                                    for(var i=0; i<checkedSports.length; ++i) {
                                        sports[i] = checkedSports[i].value;
                                    }
                                    var city = $("#city").val();
                                    var role = $("#userRole").val();

                                    var url = "../signUp?nickname=" + nickname + "&account=" + account + "&password="
                                            + password + "&sex=" + sex + "&city=" + city + "&sports=" + sports
                                            + "&role=" + role;
                                    var netHint = $("#netHint");
                                    $.get(url, function (data, statusText) {
                                        if (statusText != "success") {
                                            var netHint = $("#netHint");
                                            netHint.text("网络异常");
                                            netHint.css("color", "red");
                                            return;
                                        }
                                        if (data == "true") {
                                            location.href = "../signUp/redirect?nickname=" + nickname;
                                        } else {
                                            var netHint = $("#netHint");
                                            netHint.text('注册失败..');
                                            netHint.css("color", "red");
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