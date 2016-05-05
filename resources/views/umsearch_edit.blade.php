@extends('umMain')
@section('childCss')
    <link rel="stylesheet" type="text/css" href={{URL::asset('css/umsearch.css')}}/>
    @stop
@section('realContent')
    <div id="mainContainer">
        <ul id="userList">
            <?php
                $userCount = count($users);
                $userShowNum = $userCount == 1? 1: $userCount - 1;
                for($i=0; $i<$userShowNum; ++$i) {
                    $user = $users[$i];
            ?>
            <li class="userInfoItem" id=<?= "user".$user->id?>>
                <img class="userAvatar" src=<?= is_null($user->avatar)?
                        URL::asset('image/default_user_avatar.png'): $user->avatar?>/>
                <div class="userInfoContainer">
                   <div>
                       <span class="userNickname"><?= $user->nickname?></span>
                       <img class="sexImage"
                            src=<?= $user->sex==0?URL::asset('image/female.png'):URL::asset('image/male.png')?>/>
                       <?= $user->city?>
                   </div>
                    <div >权限: <span id=<?= "p".$user->id?>>
                        <?php
                            switch($user->role) {
                                case 0:
                                    echo "系统管理员";
                                    break;
                                case 1:
                                    echo "个人用户";
                                    break;
                                case 2:
                                    echo "健身教练";
                                    break;
                                case 3:
                                    echo "医生";
                                    break;
                            }
                        ?></span>
                        <select class="pSelect" id=<?= "pSelect".$user->id?>>
                            <option value="1">个人用户</option>
                            <option value="2">健身教练</option>
                            <option value="3">医生</option>
                        </select>
                        <a href="javascript:void(0);" class="userEdit" id=<?= "edit".$user->id?>
                                value=<?= $user->id?> count="0">编辑</a>
                        <a href="javascript:void(0);" class="editCancel" id=<?= "cancel".$user->id?>
                                value=<?= $user->id?> count="0">取消</a>
                    </div>
                </div>
            </li>
            <?php
                }
                ?>
        </ul>
        <div class="pageSelectContainer">
            <?php
            if($page == 0 && $userCount == 6) {?>
            <a href=<?= '../searchUser?key='.$key.'&type='.$type.'&page='.($page + 1)?>
                    class="nextPageButton">下一页</a>
            <?php
            } else if($page == 0 && $userCount > 0 && $userCount < 6) {?>
            <?php
            } else if($page == 0 && $userCount == 0) {?>
            <span class="emptyText">没有和<?= $type==0?"昵称":"ID"."为".$key?>相关的结果哦</span>
            <?php
            } else if($page != 0 && $userCount == 6) {?>
            <a href=<?= '../searchUser?key='.$key.'&type='.$type.'&page='.($page - 1)?>
                    class="beforePageButton">上一页</a>
            <a href=<?= '../searchUser?key='.$key.'&type='.$type.'&page='.($page + 1)?>
                    class="nextPageButton">下一页</a>
            <?php
            } else if($page !=0 && $userCount < 6) {?>
            <a href=<?= '../searchUser?key='.$key.'&type='.$type.'&page='.($page - 1)?>
                    class="beforePageButton">上一页</a>
            <?php
            }?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".userEdit").click(function(event) {
                var count = $(this).attr("count");
                var userId = $(this).attr("value");
                var pSelect = $("#pSelect" + userId);
                var cancel = $("#cancel" + userId);
                if(count % 2 == 0) {
                    $(this).text("确认");
                    pSelect.css("visibility", "visible");
                    cancel.css("visibility", "visible");
                    var pText = $("#p" + userId);
                    cancel.attr("originText", pText.text());
                    pSelect.change(function () {
                        pText.text(pSelect.children("option:selected").text());
                    });
                } else {
                    var that = $(this);
                    $.get("userPriorityManage/modify?userId=" + userId + "&priority="
                            + pSelect.children("option:selected").val(), function(data, statusText)
                    {
                        if(data == "true") {
                            that.text("编辑");
                            pSelect.css("visibility", "hidden");
                            $("#cancel" + userId).css("visibility", "hidden");
                            alert('修改用户权限成功');
                        } else {
                            alert("修改用户权限失败");
                        }
                    });
                }
                $(this).attr("count", ++count);
                event.stopPropagation();
            })
        });
        $(".editCancel").click(function(event) {
            var userId = $(this).attr("value");
            var editButton = $("#edit" + userId);
            editButton.text("编辑");
            editButton.attr("count", 0);
            $("#p" + userId).text($(this).attr("originText"));
            $("#pSelect" + userId).css("visibility", "hidden");
            $(this).css("visibility", "hidden");
            event.stopPropagation();
        })
    </script>
@stop