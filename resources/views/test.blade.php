@extends('main')

@section('childCss')
    <link href="{{ URL::asset('css/activity.css')}}" type="text/css" rel="stylesheet"/>
@stop

@section('realContent')
    <input id="time" class="timeInput" type="date" name="beginTime" value="2015-11-06"/></div>
    <input class="timeInput" type="time" name="beginTime" value="11:08"/></div>
    <script>
        $(document).ready(function() {var g1 = 0;

            function f1() {
                g1 = 123;
            }

            function f2() {
                alert(g1);
            }

            f1();
            f2();
        })
    </script>
@stop