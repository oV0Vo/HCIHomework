<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HealthDataModel;
use App\Contracts\FriendModel;

class TestController extends Controller
{

	public function __construct(HealthDataModel $model)
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
		/*$a1 = array("hehe"=>1);
		$a2 = array("hehe"=>2);
		$a3 = array("hehe"=>3);
		$ar = array($a2, $a1, $a3);*/
		return $this->model->getFirstTenFanRank(12);
		//return array($a2, $a1, $a3);
	}
	
}
