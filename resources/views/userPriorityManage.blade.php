@extends('umMain')
@section('childCss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/userManage.css')}}"/>
    @stop
@section('realContent')
    <div id="mainContainer">
        <form id="search" action="../searchUser" onsubmit="">
            <div id="selectContainer">根据
                <select id="searchTypes" class="whiteButton">
                    <option value="0">昵称</option>
                    <option value="1">ID</option>
                </select>
                搜索用户
            </div>
            <input id="keyInput" type="text" name="key" placeholder=" 输入关键字"/>
            <input id="searchType" hidden="hidden" name="type" value="0"/>
            <input hidden="hidden" name="pageType" value="1"/>
            <a id="submit" class="searchButton" type="submit" href="javascript:void(0);">搜索</a>
        </form>
    </div>
    <script>
        $(document).ready(function() {
           $("#searchTypes").change(function() {
               var type = $(this).children('option:selected').val();
               $("#searchType").attr("value", type);
           });
            $("#submit").click(function() {
                $("#search").submit();
            })
        });
    </script>
@stop