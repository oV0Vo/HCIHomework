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
	public function getIndex(Request $request)
	{
		$a1 = array("hehe"=>1);
		$a2 = array("haha"=>2);
		return array_merge($a1, $a2);
	}
	
}
