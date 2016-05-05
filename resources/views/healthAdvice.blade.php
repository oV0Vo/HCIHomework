@extends('main')
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/healthAdvice.css')}}"/>
    @stop
@section('realContent')
    <?php
        if(count($advices) != 0) {
            $latestAdvice = $advices[0];
            ?>
    <div class="title">最新建议</div>
    <div class="subContent"><?=$latestAdvice->content?></div>
    <div class="adviceAuthor">——来自<?=$latestAdvice->advisorName?>
        <?php
            if($latestAdvice->advisorType == 2)
                echo "教练";
            else
                echo "医生";?>
        的建议，于<?=(int)($latestAdvice->adviseDate / 10000)?>年
        <?= (int)($latestAdvice->adviseDate / 100) % 100?>月
        <?= $latestAdvice->adviseDate % 100?>日</div>

    <div class="title">所有建议</div>
    <?php
        $adviceNum = count($advices);
        for($i=0; $i<$adviceNum; ++$i) {
            $advice = $advices[$i];
    ?>

    <div class="subContent"><?=$advice->content?></div>
    <div class="adviceAuthor">——来自<?=$advice->advisorName?>
        <?php
        if($advice->advisorType == 2)
            echo "教练";
        else
            echo "医生";?>
        的建议，于<?=(int)($advice->adviseDate / 10000)?>年
        <?= (int)($advice->adviseDate / 100) % 100?>月
        <?= $advice->adviseDate % 100?>日</div>

    <?php
        }
    }else { ?>
    <div class="emptyText">还没有教练或医生给你提过建议哦oV_Vo</div>
    <?php
    } ?>
@stop