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
                <img class="userAvatar" src=<?= is_null($user->avatar)?URL::asset('image/default_user_avatar.png'):$user->avatar?>/>
                <div class="userInfoContainer">
                   <div>
                       <span class="userNickname"><?= $user->nickname?></span>
                       <img class="sexImage"
                            src=<?= $user->sex==0?URL::asset('image/female.png'):URL::asset('image/male.png')?>/>
                       <?= $user->city?>
                   </div>
                    <div>权限:
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
                        ?>
                        <a href="javascript:void(0);" class="userDelete" value=<?= $user->id?>
                            name=<?= $user->nickname?>>删除</a>
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
            $(".userDelete").click(function(event) {
                var userId = $(this).attr("value");
                var confirmDelete = confirm('确认删除用户' + $(this).attr("name") + "?");
                if(confirmDelete) {
                    $.get('../userManage/delete?id=' + userId, function (data, statusText) {
                        if (data == "true") {
                            $("#userList").children("#user" + userId).remove();
                        } else {
                            alert('删除失败');
                        }
                    })
                }
                event.stopPropagation();
            })
        });
    </script>
@stop