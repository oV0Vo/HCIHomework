@extends('main2')
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/setting.css')}}"/>
@stop
@section('realContent')
    <div id="mainContent">
        <div id="navList">
            <img id="userBigAvatar"
                 src=<?= is_null($user->avatar) ? URL::asset('image/default_user_avatar.png') : $user->avatar?>/>
            <ul id="navContentList">
                <li><a href="javascript:void(0);">账户资料设置</a></li>
                <li><a href="javascript:alert('功能尚在测试当中，敬请期待');">我的朋友</a></li>
                <li><a href="javascript:alert('功能尚在测试当中，敬请期待');">我的健康导师</a></li>
                <li><a href="javascript:alert('功能尚在测试当中，敬请期待');">参加过的活动</a></li>
            </ul>
        </div>
        <div id="detailContainer">
            <div id="detailContent">
                <div class="detailItem">昵称：
                    <input id="nickname" class="settingInput"  type="text"
                           value=<?= $user->nickname?> readonly/>
                </div>
                <div class="detailItem">性别：&nbsp;
                    <img src=<?= ($user->sex == 0) ? URL::asset('image/female.png') :
                            URL::asset('image/male.png')?> id="sexImg"/>
                </div>
                <div class="detailItem">所在城市：
                    <input id="city" class="settingInput" type="text" readonly
                           value=<?= is_null($user->city) ? "未知的遥远太空" : $user->city?> />
                </div>
                <div class="detailItem">喜欢的运动：
                    <span id="sports">
                    </span>
                </div>
                <div class="detailItem">
                    <span id="signatureTitle">个人简介：</span>
                    <textarea id="signature" readonly><?= $user->signature?> </textarea>
                </div>
            </div>
            <div id="editContainer">
                <button class="editButton" id="edit">编辑</button>
                <button class="editButton" id="cancel">取消</button>
            </div>
        </div>
    </div>
    <script>
        var originNickname;
        var originCity;
        var originSign;
        function changeToEditStyle() {
            var nicknameInput = $("#nickname");
            originNickname = nicknameInput.val();
            nicknameInput.removeAttr("readonly");
            nicknameInput.css("background-color", "white");
            nicknameInput.css("border", "solid 1px #aaa");

            var cityInput = $("#city");
            originCity = cityInput.val();
            cityInput.removeAttr("readonly");
            cityInput.css("background-color", "white");
            cityInput.css("border", "solid 1px #aaa");

            var signInput = $("#signature");
            originSign = signInput.val();
            signInput.removeAttr("readonly");
            signInput.css("background-color", "white");
            signInput.css("border", "solid 1px #aaa");
        }

        function changeToReadonlyStyle() {
            var nicknameInput = $("#nickname");
            nicknameInput.val(originNickname);
            nicknameInput.attr("readonly", "readonly");
            nicknameInput.css("background-color", "#EEFFFF");
            nicknameInput.css("border", "none");

            var cityInput = $("#city");
            cityInput.val(originCity);
            cityInput.attr("readonly", "readonly");
            cityInput.css("background-color", "#EEFFFF");
            cityInput.css("border", "none");

            var signInput = $("#signature");
            signInput.val(originSign);
            signInput.attr("readonly", "readonly");
            signInput.css("background-color", "#EEFFFF");
            signInput.css("border", "none");
        }
        $(document).ready(function() {
            var editClickCount = 0;
            $("#edit").click(function() {
                if(editClickCount % 2 == 0) {
                    changeToEditStyle();
                    $(this).text('确认');
                    $("#cancel").css("display", "inline-block");
                } else {
                    var newNickname = $("#nickname").val();
                    if(newNickname.length == 0) {
                        alert('昵称不能为空！');
                        return;
                    }
                    var newCity = $("#city").val();
                    var newSign = $("#signature").val();
                    var nicknameModified = newNickname != originNickname;
                    var cityModified = newCity != originCity;
                    var signModified = newSign != originSign;
                    var editButton = $(this);
                    var url = "../userInfo/update?nickname=" + newNickname + "&city=" + newCity + "&signature="
                            + newSign;
                    if(nicknameModified || cityModified || signModified) {
                        $.get(url, function(data, statusText) {
                            if(statusText != "success") {
                                alert('网络异常');
                                return;
                            }
                            if(data == "true") {
                                originCity = newCity;
                                originSign = newSign;
                                originNickname = newNickname;
                                changeToReadonlyStyle();
                                $("#cancel").css("display", "none");
                                editButton.text("编辑");
                            } else {
                                alert('很抱歉，服务器君傲娇了...');
                            }
                        });
                    } else {
                        originCity = newCity;
                        originSign = newSign;
                        originNickname = newNickname;
                        changeToReadonlyStyle();
                        $(this).text('编辑');
                    }
                }
                editClickCount++;
            })

            $("#cancel").click(function() {
                changeToReadonlyStyle();
                $("#edit").text("编辑");
                $(this).css("display", "none");
                editClickCount = 0;
            });
        })
    </script>
@stop