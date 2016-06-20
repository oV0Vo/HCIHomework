@extends('newMain')

@section('childCss')
    <link href="{{ URL::asset('css/activity.css')}}" type="text/css" rel="stylesheet"/>
@stop

@section('realContent')
    <?php
        echo "<h4> $type </h4>"
    ?>
    <div id="activityList">
        <?php
            $citys = ["上海", "南京"];
            echo <<< HTML
            <div style="margin-bottom: 20px">
                <span>城市:</span>
                <select id="citySelect" class="form-control" style="width: 30%; display: inline-block; margin-left: 10px">
HTML;
            $shouldNoLimitSelect = $city ? '' : 'selected=selected';
            echo "<option value='不限' $shouldNoLimitSelect>不限</option>";
            foreach ($citys as $perCity) {
                $shouldSelect = $city == $perCity ? 'selected=selected' : '';
                echo "<option value='$perCity' $shouldSelect>$perCity</option>";
            }
                //
                //
                //   <option value="南京">南京</option>
             echo <<< HTML
                </select>
            </div>
HTML;

            $outputs = array_map(function($activity) {
                $title = isSet($activity->title) ? $activity->title : "该活动无标题";
                $time = "今天";
                $authorName = $activity->authorName;
                $content = $activity->content;
                $beginTime = $activity->beginTime;
                $joinNum = $activity->joinNum;
                $hasJoin = true;
                $goalNum = 80;
                $duration = "两小时";
                $involveds = ['asd', 3, 24];

                $involvedsHTML = "";
                $invovledCnt = count($involveds);

                foreach ($involveds as $involved) {
                    $involvedsHTML .= <<< HTML
                    <img style="width:40px;height:40px;border-radius:20px" src="https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=1642940013,2147239593&fm=111&gp=0.jpg"/>
HTML;
                }


                $buttonType = $hasJoin ? "btn-danger" : "btn-success";
                $buttonText = $hasJoin ? "取消参与" : "点击参与";

                $str = <<<OUT
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 style="margin: 0"> $title</h4>
                        <div class="row activityHeader">
                            <div class="col-md-6">发布时间 $time</div>
                            <div class="col-md-3">发起人: $authorName</div>
                            <div class="col-md-3">参与情况: $joinNum / $goalNum</div>
                        </div>
                        <div class="row activityHeader">
                            <div class="col-md-9">活动时间 $beginTime</div>
                            <div class="col-md-3">计划时长: $duration</div>
                       </div>
                      </div>
                      <div class="panel-body">
                          <h4>活动内容:</h4>
                          $content
                      </div>
                    </div>
                    <div class="panel-footer">
                    <div class="row" style="display:flex; align-items:center">
                        <div class="col-md-8">$involvedsHTML</div>
                        <div class="col-md-2">等 $invovledCnt 人参与</div>
                        <div class="col-md-2"><button type="button" class="btn $buttonType joinBtn" actId="{$activity->id}">$buttonText</button></div>
                   </div>
                    </div>
OUT;
                return $str;
            }, $activitys);

            foreach($outputs as $output) {
                echo $output;
            }

            echo <<<HTML
            <footer>
              <ul class="pagination">
HTML;

             $startPage = min(1, $page - 4);
             $leftPage = 10;
             echo <<< HTML
             <li>
               <a href="activity?page=0" aria-label="Previous">
                 <span aria-hidden="true">&laquo;</span>
               </a>
             </li>
HTML;

             for ($i=0; $i < min($page + $leftPage, 10); $i++) {
                 $liClass = $page == $i ? 'class="active"' : "";
                 echo "<li $liClass><a href='activity?page=$i'>".($i + 1)."</a></li>";
             }

            echo <<<HTML
                <li style="padding-left:20px">跳转到第<input id="pageInput" type="text" class="form-control" style="display: inline; width: 15%; margin-left: 4px ; margin-top: 4px; height: 24px"/> 页</li>
              </ul>
            </footer>
HTML;
        ?>

    </div>

        <script>
        function joinActivity(actId) {
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

        function cancelJoinActivity(actId) {
            $.get("../activity/cancelJoin?id=" + actId, function(datas, statusText) {
                if(statusText != "success") {
                    alert('网络异常');
                    return;
                }
                if(datas == "true") {
                    alert('取消参与成功');
                } else {
                    alert('取消参与失败');
                }
            });
        }

        $(document).ready(function() {
            $("#activityList").on('click', 'button.joinBtn' , function () {
                var actId = $(this).attr("actId")
                if ($(this).text() == '取消参与') {
                    cancelJoinActivity(actId)
                    $(this).removeClass('btn-danger')
                    $(this).addClass('btn-success')
                    $(this).text("点击参与")
                } else {
                    joinActivity(actId)
                    $(this).removeClass('btn-success')
                    $(this).addClass('btn-danger')
                    $(this).text("取消参与")
                }

            })

            $("#citySelect").change(function() {
                window.location.href = "http://health.com/activity?city="
                        + $(this).children('option:selected').val();
            })

            $("#pageInput").keydown(function(e) {
                if (e.keyCode == 13) {
                    window.location.href = `activity?page=${event.target.value - 1}`
                }
            })
        })
    </script>
@stop
