<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\ActivityModel;
use App\Contracts\HealthDataModel;
use App\Contracts\UserActionModel;
use App\Contracts\UserModel;
use App\Contracts\HealthPlanModel;

class MainController extends Controller
{
	protected $healthDataModel;
	protected $healthPlanModel;
	protected $activityModel;
	protected $userActionModel;
	protected $userModel;

	public function __construct(HealthDataModel $healthDataModel, HealthPlanModel $healthPlanModel,
						ActivityModel $activityModel, UserActionModel $userActionModel, UserModel $userModel)
	{
		$this->healthDataModel = $healthDataModel;
		$this->healthPlanModel = $healthPlanModel;
		$this->userActionModel = $userActionModel;
		$this->activityModel = $activityModel;
		$this->userModel = $userModel;
	}
	
    public function getIndex()
    {
		$userId = Session::get('userId');
		$userInfos = $this->userModel->getRoleAndCity($userId);
		if(is_null($userInfos))
			return;
		$role = $userInfos->role;
		$city = $userInfos->city;
		if(is_null($city))
			$city = '南京';
		if($role == 1) {
			$todayHealth = $this->healthDataModel->getTodayDatas($userId);
			$datas['todayHealth'] = $todayHealth[0];
			$datas['currentPlans'] = $this->healthPlanModel->getCurrentPlan($userId);
			$datas['activitys'] = $this->activityModel->getTopHotActivity($city);
			return view('userMain', $datas);
		} else if($role == 2) {
			return redirect('customer');
		} else if($role == 3) {
			return redirect('customer');
		} else if($role == 0) {
			return redirect('userManage');
		}
    }
}
