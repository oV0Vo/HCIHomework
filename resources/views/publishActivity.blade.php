@extends('main')
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/activity.css')}}"/>
    @stop

@section('realContent')
    <div class="title">发布活动</div>
    <form id="actPublish" action="../activity/publishActivity">
        <div class="subContent" id="activityPublishContainer">
            <div>开始时间&nbsp;&nbsp;<input class="timeInput" type="date" name="beginDate"/>
                <input class="timeInput" type="time" name="beginTime"/></div>
            <div>结束时间&nbsp;&nbsp;<input class="timeInput" type="date" name="endDate"/>
                <input class="timeInput" type="time" name="endTime"/></div>
            <div>活动城市&nbsp;&nbsp;<input class="textInput" type="text" name="city"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;活动地点&nbsp;
                <input id="actPlace" class="textInput" type="text" name="place" /></div>

            <div>活动内容&nbsp;
                <textarea id="actContentInput" maxlength="120" name="content" placeholder=" 活动要做些什么"></textarea>
            </div>
            <input type="text" name="isCommit" value="" hidden="hidden"/>
            <div><input id="actSubmit" class="whiteButton" type="submit" value="发布" /></div>
        </div>
    </form>
    <div class="title">发布历史</div>
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
            </div>
        </div>

        <?php
			}
        } ?>
    </ul>
    <div class="pageSelectContainer">
        <?php
        if($page == 0 && $activityCount == 5) {?>
        <a href=<?= '../activity/publishActivity?page='.($page + 1)?>
                class="whiteButton">下一页</a>
        <?php
        } else if($page == 0 && $activityCount > 0 && $activityCount < 5) {?>
    <?php
        } else if($page == 0 && $activityCount == 0) {?>
        <span class="emptyText">你还没有发布过活动额~</span>
        <?php
        } else if($page != 0 && $activityCount == 5) {?>
        <a href=<?= '../activity/publishActivity?page='.($page - 1)?>
                class="whiteButton">上一页</a>
        <a href=<?= '../activity/publishActivity?page='.($page + 1)?>
                class="whiteButton">下一页</a>
        <?php
        } else if($page !=0 && $activityCount < 5) {?>
        <a href=<?= '../activity/publishActivity?page='.($page - 1)?>
                class="whiteButton">上一页</a>
        <?php
        }?>
    </div>
    <script>
    </script>
@stop