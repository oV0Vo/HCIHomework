<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\ActivityModel;
use App\Contracts\FriendModel;

class TestController extends Controller
{

	public function __construct(ActivityModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getIndex()
	{
		echo $this->model->newActivity(12, 20160820080000, 7200, 640, 
			'测试', '测试内容', '上海', '外滩');
	}
	
}
