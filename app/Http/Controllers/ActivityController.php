<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\ActivityModel;

class ActivityController extends Controller
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
		$city = $request['city'];
		if(is_null($city))
			$city = '上海';
		$page = $request['page'];
		if(is_null($page))
			$page = 0;
		$activitys = $this->model->getActivityByCondition($city, $page);
		$hotActivitys = $activitys;
		$datas['activitys'] = $activitys;
		$datas['hotActivitys'] = $hotActivitys;
		$datas['city'] = $city;
		$datas['page'] = $page;
		return view('activity', $datas);
    }

	public function getLatestActivity()
	{
		return 'getLatestActivity';
	}

	public function getHotActivity()
	{
		return 'getHotActivity';
	}

	public function getByCondition(Request $request)
	{
		$city = $request['city'];
		if(is_null($city))
		$page = $request['page'];
		if(is_null($page))
			$page = 0;
		$activitys = $this->model->getActivityByCondition($city, $page);
		return $activitys;
	}

	public function getMyActivity()
	{
		return 'getMyActivity';
	}

	public function publishActivity(Request $request) {
		if(is_null($request['isCommit'])) {
			$userId = Session::get('userId');
			$page = $request['page'];
			if(is_null($page))
				$page = 0;
			$activitys = $this->model->getUserPublishByPage($userId, $page);
			$datas["activitys"] = $activitys;
			$datas['page'] = $page;
			return view('publishActivity', $datas);
		} else {
			return $this->newActivity($request);
		}
	}

	public function activityManage(Request $request) {
		$page = $request['page'];
		if(is_null($page))
			$page = 0;
		$city = $request['city'];
		if(is_null($city))
			$city = '南京';
		$activitys = $this->model->getActivityByCondition($city, $page);
		$datas['activitys'] = $activitys;
		$datas['city'] = $city;
		$datas['page'] = $page;
		return view('activityManage', $datas);
	}

	private function newActivity(Request $request)
	{
		$userId = Session::get('userId');
		$beginDate = $request['beginDate'];
		$beginTime = $request['beginTime'];
		$endDate = $request['endDate'];
		$endTime = $request['endTime'];
		$city = $request['city'];
		$place = $request['place'];
		$content = $request['content'];
		$insertSuccess = $this->model->newActivity($userId, $beginDate, $beginTime, $endDate, $endTime, $city, $place,
				$content);
		$request['isCommit'] = null;
		return $this->publishActivity($request);
	}

	public function attendActivity(Request $request)
	{
		$actId = $request['id'];
		if($actId) {
			$userId = Session::get('userId');
			$attentSuccess = $this->model->attendActivity($userId, $actId);
			return $attentSuccess ? "true": "false";
		}
	}

	public function getUserPublishByPage(Request $request)
	{
		$page = $request['page'];
		return 'getUserPublishByPage';
	}

	public function getUserJoinByPage(Request $request)
	{
		$page = $request['page'];
		return 'getUserJoinByPage';
	}

	public function deleteActivity(Request $request)
	{
		$id = intval($request['id']);
		if($id != 0) {
			$deleteSuccess = $this->model->deleteActivtiy($id);
			return $deleteSuccess? "true": "false";
		}
	}
	
	public function getAllCitys(Request $request) 
	{
		return $this->model->getAllCitys();
	}
}
