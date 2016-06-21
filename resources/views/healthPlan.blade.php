@extends('main2')

@section('realContent')
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

    <a class="myButton" href="javascript:void(0);">新计划</a>

    <div class="title">历史计划</div>
    <?php
    $historyPlanNum = count($historyPlans);
    if($historyPlanNum != 0) {
    for($i = 0; $i<$historyPlanNum; ++$i) {
    $plan = $historyPlans[$i];
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

@stop
