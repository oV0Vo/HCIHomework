@extends('main')
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/healthData.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/healthPlan.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/activity.css')}}"/>
@stop
@section('realContent')
    <div class="title">每日健康</div>
    <div class="subContent">
        <img src="{{URL::asset('image/running_man.jpg')}}"/>
        <span>步行：<span class="healthData"><?= (int)$todayHealth->walkMinute ?></span>分钟，
            共计<span class="healthData"><?= $todayHealth->walkSteps?></span>步</span>
    </div>
    <div class="subContent">
        <img src="{{URL::asset("image/running_man.jpg")}}"/>
        <span>跑步：<span class="healthData"><?= (int)$todayHealth->runMinute ?></span>分钟，
            共计<span class="healthData"><?= $todayHealth->runMeters?></span>步</span>
    </div>
    <div class="subContent">
        <img src="{{URL::asset("image/bloodPressure.jpg")}}"/>
        <span>血压：平均<span class="healthData"><?= round($todayHealth->avgLowBL,1) ?>-
                <?= round($todayHealth->avgHighBL, 1) ?></span>kpa</span>
    </div>
    <div class="subContent">
        <img src="{{URL::asset("image/sleep.jpg")}}"/>
        <span>睡眠：已经休息<span class="healthData"><?= (int)($todayHealth->sleepMinutes / 60) ?></span>小时
            <span class="healthData"><?= $todayHealth->sleepMinutes % 60 ?></span>分钟</span>
    </div>
    <div class="subContent">
        <img src="{{URL::asset("image/heartRate.png")}}"/>
        <span>心率：平均<span class="healthData"><?= (int)$todayHealth->avgHeartRate ?></span>次/秒，
            最低<span class="healthData"><?= $todayHealth->lowestHeartRate?></span>次/秒，
            最高<span class="healthData"><?= $todayHealth->highestHeartRate?></span>次/秒</span>
    </div>
    <div class="showMoreContainer"><a href="../healthData" class="whiteButton showMore">查看更多</a></div>
    <br/>
    <div class="title">进行中的计划</div>
    <?php
    $currentPlanNum = count($currentPlans);
    if($currentPlanNum != 0) {
    for($i = 0; $i<$currentPlanNum; ++$i) {
    $plan = $currentPlans[$i];
    $beginDate = $plan->beginDate;
    $endDate = $plan->endDate;
    $durationDate = $endDate - $beginDate;
    if($durationDate == 0)
        $durationDate = 1;
    $planMinute = $plan->planMinute;?>
    <ul class="content">
        <li>口号：<?=$plan->slogan?></li>
        <li>计划时间：<?=$beginDate?>到<?=$endDate?></li>
        <li>计划内容：总计<?=$planMinute?>分钟，预计能燃烧<?= (int)($planMinute / 4)?>卡路里，
            减少<?= (int)($planMinute / 150) ?>kg</li>
    </ul>
    <?php  }
    } else {?>
    <div class="emptyText">没有正在进行中的计划哦oV_Vo</div>
    <?php }?>
    <div class="showMoreContainer"><a href="../healthPlan" class="whiteButton showMore">查看更多</a></div>
    <br/>
    <div class="title">热门活动</div>
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
    }?>
@stop