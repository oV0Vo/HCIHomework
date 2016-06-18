@extends('main')

@section('childCss')
    <link href="{{ URL::asset('css/activity.css')}}" type="text/css" rel="stylesheet"/>
@stop

@section('realContent')
    <h4> 周边热门活动 </h4>
    <div id="activityList">
        <?php
            $outputs = array_map(function($activity) {
                $title = isSet($activity->title) ? $activity->title : "该活动无标题";
                $time = "今天";
                $authorName = $activity->authorName;
                $content = $activity->content;
                $beginTime = $activity->beginTime;
                $joinNum = $activity->joinNum;
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
                        <div class="col-md-2"><button type="button" class="btn btn-success">点击参与</button></div>
                   </div>
                    </div>
OUT;
                return $str;
            }, $hotActivitys);

            foreach($outputs as $output) {
                echo $output;
            }

            echo <<<HTML
            <footer>
              <ul class="pagination">
HTML;

             $startPage = min(1, $page - 4);
             for ($i=1; $i <= 10; $i++) {
                 $liClass = ($page + 1) == $i ? 'class="active"' : "";
                 $normailizeI = $i - 1;
                 echo <<< HTML
                    <li $liClass><a href="activity?page=$normailizeI">$i</a></li>
HTML;
             }

            echo <<<HTML
                <li style="padding-left:20px">跳转到第<input type="text" class="form-control" style="display: inline; width: 15%; margin-left: 4px ; margin-top: 4px; height: 24px"/> 页</li>
              </ul>
            </footer>
HTML;
        ?>

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
