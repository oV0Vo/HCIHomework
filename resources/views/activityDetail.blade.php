@extends('main')

@section('childCss')
    <link href="{{ URL::asset('css/activity.css')}}" type="text/css" rel="stylesheet"/>
@stop

@section('realContent')
    <div class="title">健身活动</div>
    <div class="selectContainer">
        <div class="subContent">
            <span>选择城市：&nbsp;&nbsp;</span>
            <select id="citySelect" class="whiteButton">
                <option <?= $city=="上海"?"selected='selected'":""?>>南京</option>
                <option <?= $city=="上海"?"selected='selected'":""?>>上海</option>
            </select>
        </div>
    </div>

    <ul id="selectResultList">
        <?php
            $activityCount = count($activitys);
            if($activityCount != 0) {
                $actShowNum = ($activityCount == 1? 1: $activityCount - 1);
                for($i=0; $i<$actShowNum; ++$i) {
                    $activity = $activitys[$i];
                    $beginDate = $activity->beginDate;
                    $beginTime = $activity->beginTime;
                    $endDate = $activity->endDate;
                    $endTime = $activity->endTime;
        ?>
        <div class="activityContent">
            <table class="activityTable">
                <tr>
                    <td>
                        活动时间：
                    </td>
                    <td>
                        <?= $beginDate ?> <?= $beginTime ?> -
                            <?= $endDate ?> <?= $endTime ?>
                    </td>
                    <td class="lastColumn">
                        活动地点：<?= $activity->place ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        发起人：
                    </td>
                    <td class="emphaiseText">
                        <?= $activity->authorName ?>
                    </td>
                    <td class="lastColumn">
                        参与情况：已有<?= $activity->joinNum ?>人报名参加
                    </td>
                </tr>
            </table>
            <div>
                活动内容：<?= $activity->content ?>
                <a href="javascript:joinActivity(<?= $activity->id?>)" class="btn actJoin" >我要参与</a>
            </div>
        </div>

        <?php
                }
            }?>
    </ul>
    <div class="pageSelectContainer">
    <?php
        if($page == 0 && $activityCount == 5) {?>
        <a href=<?= 'http://health.com/activity?city='.$city.'&page='.($page + 1)?>
            class="nextPageButton">下一页</a>
    <?php
        } else if($page == 0 && $activityCount > 0 && $activityCount < 5) {?>
    <?php
        } else if($page == 0 && $activityCount == 0) {?>
        <span class="emptyText">没有在<?= $city ?>进行的活动额</span>
    <?php
        } else if($page != 0 && $activityCount == 5) {?>
        <a href=<?= 'http://health.com/activity?city='.$city.'&page='.($page - 1)?>
           class="beforePageButton">上一页</a>
        <a href=<?= 'http://health.com/activity?city='.$city.'&page='.($page + 1)?>
           class="nextPageButton">下一页</a>
    <?php
        } else if($page !=0 && $activityCount < 5) {?>
        <a href=<?= 'http://health.com/activity?city='.$city.'&page='.($page - 1)?>
           class="beforePageButton">上一页</a>
    <?php
        }?>
    </div>
    <script>
        function joinActivity(actId, actBtn) {
            $.get("../activity/join?id=" + actId, function(datas, statusText) {
                if(statusText != "success") {
                    alert('网络异常');
                    return;
                }
                if(datas == "true") {
                    alert('参与成功');
                } else {
                    alert('参与失败');
                }
            });
        }
        $(document).ready(function() {
            $("#citySelect").change(function() {
                window.location.href = "http://health.com/activity?city="
                        + $(this).children('option:selected').val();
            })
        })
    </script>
@stop