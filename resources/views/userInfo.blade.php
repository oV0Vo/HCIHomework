@extends('newMain')
@section('childCss')
    <link href="{{ URL::asset('css/userCenter.css')}}" type="text/css" rel="stylesheet"/>
    @stop
@section('realContent')
<div>
<ol class="breadcrumb">
  <li><a href="#">首页</a></li>
  <li><a href="#">个人中心</a></li>
</ol>
	<ul class="nav nav-pills nav-stacked" id="userCenterNav">
  <li role="presentation" class="active"><a href="../userCenter/info">基本资料</a></li>
  <li role="presentation"><a href="../userCenter/modifyPassword">密码修改</a></li>
  <li role="presentation"><a href="../userCenter/info">留言版</a></li>
  <li role="presentation"><a href="../userCenter/info">系统通知</a></li>
  <li role="presentation"><a href="../userCenter/info">好友管理</a></li>
	</ul>
	
	<div class="contentPanel">
		<h2>基本资料</h2>
		
		<div class="lineItem">
		<span class="title2">头像 </span>
		<img src="http://7xpcat.com1.z0.glb.clouddn.com/1451286513/tmp/phpbSVAr8?e=3598770160&token=hdZdapjcdEK2vbVKTo--ETEciepTc9Eqs12BKS7T:nBhvCFb-oI8WZ3yoT11lHnky70Q="
	  alt="头像" class="img-round">
		</div>
		
		<div class="lineItem">
			<span class="title2">昵称 </span>
			<span>七下元年</span>
		</div>
		
		<div class="lineItem">
			<span class="title2">生日</span>
		</div>
		
		<textarea name="" id="" cols="30" rows="10"></textarea>
		
        <div id="editContainer">
            <button class="btn btn-default" id="edit">编辑</button>
            <button class="btn btn-default" id="cancel">取消</button>
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