@extends("indexMain")

@section('childHead')
    <meta http-equiv="refresh" content="3; url='../home'"/>
@stop

@section('mainContent')
    <div id="welcomeText">
        欢迎你，<?= $nickname?> ，<span id="timeLeft"></span>秒后会进入你的主页
        <div>
            <a href="../home" id="tiaozhuan" value>如果没有跳转，点击这里进入主页</a>
        </div>
    </div>
    <script>
        function leftTimeCount() {
            timeLeft.text(leftSec--);
        }
        var leftSec = 3;
        var timeLeft;
        $(document).ready(function () {
            timeLeft = $("#timeLeft");
            setInterval("leftTimeCount()", 1000);
        });
    </script>

@stop