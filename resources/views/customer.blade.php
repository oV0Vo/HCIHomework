@extends('teacherMain')
@section('title')
    我的朋友
    @stop
@section('childCss')
    <link href="{{ URL::asset('css/friend.css')}}" type="text/css" rel="stylesheet"/>
@stop

@section('realContent')
    <div id="friendManage">
        <a class="myButton" href="javascript:void(0);">管理客户</a>
    </div>
    <div >
        <div id="briefContainer">
            <div id="friendListTitle">我的客户(<?= count($friends)?>个)</div>
            <ul class="friendList">
                <?php
                    $friendNum = count($friends);
                    for($i=0; $i<$friendNum; ++$i) {
                        $friend = $friends[$i];
                        $userId = $friend->id;
                        $avatar = $friend->avatar;
                        if(is_null($avatar))
                            $avatar = 'image/default_user_avatar.png';
                        $name = $friend->nickname;
                ?>
                <li class="userBrief">
                    <a href="javascript:getUserDetail(<?=$userId?>);"  id="<?=$userId?>">
                        <img src="{{URL::asset($avatar)}}" class="avatarSmall"/>
                        <span class="nickname_brief"><?= $name ?></span>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
            <div id="userDetail">
                <div>
                    <span id="userDetailName"></span>
                    <img id="userSexImg"/>
                    <span id="userCity"></span>
                    <span id="userRole"></span>
                    <img id="userBigAvatar"/>
                </div>
                <div id="sportContainer">
                    <span>喜欢的运动：&nbsp;</span>
                    <div id="userSports"></div>
                </div>
                <div id="userSignature"></div>
                <br/>
                <div class="titleText">给他提建议</div>
                    <textarea id="commentText" name="commentText" type="text" placeholder=" 输入建议内容"></textarea>
                    <div id="submitContainer">
                        <a id="commentSummit" class="whiteButton" type="submit"
                           href="javascript:commitComment($('#commentText').val());">确定</a>
                    </div>
            </div>
    </div>
    <script>
        var curUserId;
        function commitComment(comment) {
            if(comment.length == 0) {
                alert('请输入建议内容!');
                return;
            }
            if(!curUserId)
                return;
            var url = '../healthAdvice/addAdvice?receiverId=' + curUserId + "&content=" + comment;
            $.get(url, function(data, statusText) {
                if(statusText != 'success') {
                    alert('网络异常!');
                    return;
                }
                if(data == 'true') {
                    alert('提交建议成功！');
                    $("#commentText").val("");
                } else {
                    alert('服务器君傲娇了，提交建议失败，请稍后再尝试提交');
                }
            });
        }

        function getUserDetail(userId) {
            curUserId = userId;
            $.get("/userManage/getUserDetail?userId=" + userId, function(data, status) {
                $("#userDetailName").text(data[0][0].nickname);

                var sexType = data[0][0].sex;
                if(sexType == 0) {
                    $("#userSexImg").attr("src", "{{URL::asset("image/female.png")}}");
                } else {
                    $("#userSexImg").attr("src", "{{URL::asset("image/female.png")}}");
                }

                $("#userCity").text(data[0][0].city);
                var userRole = data[0][0].role;
                if(userRole == 0) {
                    $("#userRole").text("系统管理员");
                } else if(userRole == 1) {
                    $("#userRole").text("个人用户");
                } else if(userRole == 2) {
                    $("#userRole").text("健身教练");
                } else {
                    $("#userRole").text("医生");
                }

                var userSports = data[1];
                $("#userSports").text("");
                for(var i=0; i<userSports.length; ++i) {
                    var sportNode = $("<span></span>");
                    sportNode.attr("class", "whiteButton");
                    var sportType = userSports[i].sportType;
                    switch(sportType) {
                        case 0:
                            sportNode.text("步行");
                            break;
                        case 1:
                            sportNode.text("跑步");
                            break;
                    }
                    sportNode.css("margin-left", "10px");
                    $("#userSports").append(sportNode);
                }

                $("#userSignature").text("个人简介：" + data[0][0].signature);

                var avatar = data[0][0].avatar;
                if(!avatar)
                    avatar = "{{URL::asset('image/default_user_avatar.png')}}";
                $("#userBigAvatar").attr("src", avatar);
                $("#userDetail").show();
            });
        }

        $(document).ready(function(){
            <?php
                if($friendNum != 0) {
            ?>
                getUserDetail(<?= $friends[0]->id?>)
            <?php
                }?>
        });
    </script>
@stop