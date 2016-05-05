@extends('main')
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/healthData.css')}}"/>
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
    <div class="title">健康趋势</div>
    <div class="subContent">
        <span class="selectCondition">选择数据类型：</span>
        <a class="whiteButton" href="javascript:void(0);">跑步</a>
        <a class="whiteButton" href="javascript:void(0);">散步</a>
        <a class="whiteButton" href="javascript:void(0);">心率</a>
        <a class="whiteButton" href="javascript:void(0);">血压</a>
        <a class="whiteButton" href="javascript:void(0);">睡眠</a>
    </div>
    <div class="subContent">
        <span class="selectCondition">选择视图：</span>
        <a class="whiteButton" href="javascript:void(0);">日视图</a>
        <a class="whiteButton" href="javascript:void(0);">周视图</a>
        <a class="whiteButton" href="javascript:void(0);">月视图</a>
        <a class="whiteButton" href="javascript:void(0);">年视图</a>
    </div>
    <div id="healthDataStatus" class="emptyText">新功能正在研制当中...</div>

    <div class="title">每日记录</div>
    <div class="subContent">选择时间段：
        <?php
            $beginDay = $beginDate % 100;
            $beginDayStr = $beginDay >= 10 ? strval($beginDay): "0".strval($beginDay);
            $beginMon = (int)($beginDate / 100) % 100;
            $beginMonStr = $beginMon >= 10 ? strval($beginMon): "0".strval($beginMon);
            $beginYearStr = strval((int)($beginDate / 10000));
            $beginDateStr = $beginYearStr."-".$beginMonStr."-".$beginDayStr;
            $endDay = $endDate % 100;
            $endDayStr = $endDay >= 10 ? strval($endDay): "0".strval($endDay);
            $endMon = (int)($endDate / 100) % 100;
            $endMonStr = $endMon >= 10 ? strval($endMon): "0".strval($endMon);
            $endYearStr = strval((int)($endDate / 10000));
            $endDateStr = $endYearStr."-".$endMonStr."-".$endDayStr;
        ?>
        <div>开始时间
            <input id="beginDate" class="timeInput" type="date" name="beginDate"
                                    value="<?= $beginDateStr?>"/>
        </div>
        <div>结束时间
            <input id="endDate" class="timeInput" type="date" name="endDate"
                                    value="<?= $endDateStr?>"/>&nbsp;&nbsp;
            <a href="javascript:void(0);" id="timeConfirm" class="btn">确认</a>
        </div>
    </div>
    <table id="dataTable">
        <tr>
            <th>日期</th>
            <th>步行时间</th>
            <th>跑步米数</th>
            <th>平均心率</th>
            <th>平均血压</th>
            <th>睡眠时间</th>
        </tr>
        <?php
            $dataLen = count($healthDatas);
            $dataShowNum = ($dataLen == 11)? 10: $dataLen;
            for($i=0; $i<$dataShowNum; ++$i) {
                $data = $healthDatas[$i];
                $date = $data->recordDate;
                $sleepMinutes = $data->sleepMinutes;
        ?>
            <tr>
                <td><?= $date?></td>
                <td><?= (int)$data->walkMinute?>分钟</td>
                <td><?= $data->runMeters?>米</td>
                <td><?= (int)$data->avgHeartRate?>次/秒</td>
                <td><?= round($data->avgLowBL, 1)?>-<?= round($data->avgHighBL, 1)?>kpa</td>
                <td><?= (int)($sleepMinutes / 60)?>小时<?= $sleepMinutes % 60?>分钟</td>
            </tr>
        <?php }?>
    </table>
    <div class="pageSelectContainer">
        <a id="beforePage" class="beforePageButton" href="javascript:void(0);">上一页</a>
        <a id="nextPage" class="nextPageButton" href="javascript:void(0);">下一页</a>
    </div>
    <br/>

    <script>
        function updateHealthDatas(datas) {
            var dataLen = datas.length;
            var tds = $("#dataTable td");
            var dataCount = datas.length;
            if(dataCount == 11)
                dataCount = 10;
            var updateRowCount = dataCount;
            for(var i=0; i<updateRowCount; ++i) {
                var b = i * 6;
                tds[b].innerText = (datas[i].recordDate);
                tds[b + 1].innerText = parseInt(datas[i].walkMinute) + "分钟";
                tds[b + 2].innerText = datas[i].runMeters + "米";
                tds[b + 3].innerText = parseInt(datas[i].avgHeartRate) + "次/每秒";
                tds[b + 4].innerText = datas[i].avgLowBL.toFixed(1) + "-" + datas[i].avgHighBL.toFixed(1) + "kpa";
                tds[b + 5].innerText = datas[i].sleepMinutes / 60 + "小时" + datas[i].sleepMinutes % 60 + "分钟";
            }
            var rowCount = tds.length / 6;
            for(var i=updateRowCount; i<rowCount; ++i) {
                var b = i * 6;
                tds[b].innerText = "";
                tds[b + 1].innerText = "";
                tds[b + 2].innerText = "";
                tds[b + 3].innerText = "";
                tds[b + 4].innerText = "";
                tds[b + 5].innerText = "";
            }

            var beforePage = $("#beforePage");
            var nextPage = $("#nextPage");
            if(page == 0 && datas.length == 11) {
                beforePage.css("display", "none");
                nextPage.css("display", "inline-block");
            } else if(page == 0 && datas.length < 11) {
                beforePage.css("display", "none");
                nextPage.css("display", "none");
            } else if(page == 0 && datas.length == 0) {
                beforePage.css("display", "none");
                nextPage.css("display", "none");
            } else if(page != 0 && datas.length == 11) {
                alert('hehe');
                beforePage.css("display", "inline-block");
                nextPage.css("display", "inline-block");
            } else {
                beforePage.css("display", "inline-block");
                nextPage.css("display", "none");
            }
        }

        function getUpdateUrl(page) {
            var beginDate = $("#beginDate").val();
            var beginYear = beginDate.substring(0, 4);
            var beginMon = beginDate.substring(5, 7);
            var beginDay = beginDate.substring(8, 10);
            var endDate = $("#endDate").val();
            var endYear = endDate.substring(0, 4);
            var endMon = endDate.substring(5, 7);
            var endDay = endDate.substring(8, 10);
            var beginDatePara = beginYear + beginMon + beginDay;
            var endDatePara = endYear + endMon + endDay;
            url = "../healthData/getDatasByDate?beginDate=" + beginDatePara +"&endDate=" + endDatePara
                    + "&page=" + page;
            return url;
        }

        function update(url) {
            $.get(url, function(datas, statusText) {
                if(statusText != "success") {
                    return false;
                }
                updateHealthDatas(datas);
                return true;
            })
        }

        var page = parseInt("<?= $page?>");
        $(document).ready(function() {
            var beforePage = $("#beforePage");
            beforePage.click(function() {
                page = page - 1;
                url = getUpdateUrl(page);
                var updateSuccess = update(url);
            });
            var nextPage = $("#nextPage");
            nextPage.click(function () {
                page = page + 1;
                url = getUpdateUrl(page);
                var updateSuccess = update(url);
            });
            beforePage.css("display", "none");
            var firstPageCount = "<?= $dataLen?>";
            if(firstPageCount == 11) {
                nextPage.css("display", "inline-block")
            } else  {
                nextPage.css("display", "none")
            }

            $("#timeConfirm").click(function(){
                url = getUpdateUrl(page);
                var updateSuccess = update(url);
            });

        })
    </script>
@stop