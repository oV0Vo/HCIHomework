<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HealthPlanModel;
use Illuminate\Support\Facades\Session;

class HealthPlanController extends Controller
{
	
	public function __construct(HealthPlanModel $model)
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
		$userId = Session::get('userId');
		$datas['currentPlans'] = $this->model->getCurrentPlan($userId);
		$datas['historyPlans'] = $this->model->getHistoryPlanByPage($userId, 0);
		return view('healthPlan', $datas);
    }
	
	public function getHistoryPlanByPage(Request $request)
	{
		$page = $request['page'];
		$result = $this->model->getHistoryPlanByPage($page);
		return $result;
	}
	
	public function newHealthPlan()
	{
		
		return "newHealthPlan";
	}
		
	public function commitPlan(Request $request)
	{
		$annoucContent = $request['annoucContent'];
		$beginDate = $request['beginDate'];
		$endDate = $request['endDate'];
		$walkMinute = $request['walkMinute'];
		$runMinute = $request['runMinute'];
		$weightLossGoal = $request['weightLossGoal'];
		return $annoucContent + '<br/>' + $beginDate + '.';
	}
}
