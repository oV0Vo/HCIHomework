@extends('newMain')
@section('childCss')
    <link href="{{ URL::asset('css/userInfo.css')}}" type="text/css" rel="stylesheet"/>
    @stop
@section('realContent')
<div id="userInfoPanel">
	<div class="centerItem">
	<img src="<?= $user->avatar? $user->avatar: 'http://tva3.sinaimg.cn/crop.132.20.332.332.180/6c546c01jw8ezb77ekcssj20gm0adtah.jpg'?>"
		alt="用户头像">
	</div>
	<div class="centerItem">
	<span id='nickname'>$user->nickname</span>
	<img src=<?= $user->sex?URL::asset('image/female.png'): URL::asset('image/male.png')?> alt="性别" 
			class="img-small"></div>
</div>
@stop