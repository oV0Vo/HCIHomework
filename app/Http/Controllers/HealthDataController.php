<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HealthDataModel;

class HealthDataController extends Controller
{

    public function __construct(HealthDataModel $model)
    {
        $this->model = $model;
    }

    public function getIndex()
    {
        $userId = Session::get('userId');

        $beginDateStr = date('Y-m-d', strtotime('-1 month'));
        $beginYear = substr($beginDateStr, 0, 4);
        $beginMon = substr($beginDateStr, 5, 2);
        $beginDay = substr($beginDateStr, 8, 2);
        $beginDate = $beginYear * 10000 + $beginMon * 100 + $beginDay;
        $endDateStr = getdate();
        $currentYear = $endDateStr['year'];
        $currentMon = $endDateStr['mon'];
        $currentDay = $endDateStr['mday'];
        $endDate = $currentYear * 10000 + $currentMon * 100 + $currentDay;
        $page = 0;
        $healthDatas = $this->model->getDatasByDate($userId, $beginDate, $endDate, $page);
        $datas['healthDatas'] = $healthDatas;

        $todayHealth = $this->model->getTodayDatas($userId);
        $datas['todayHealth'] = $todayHealth[0];
        $datas['beginDate'] = $beginDate;
        $datas['endDate'] = $endDate;
        $datas['page'] = $page;
        return view('healthData', $datas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatsByCondition(Request $request)
    {
        $dataType = $request['dataType'];
        $viewType = $request['viewType'];
        return "getStatsByCondition";
    }

    public function getDatasByDate(Request $request)
    {
        $beginDate = $request['beginDate'];
        $endDate = $request['endDate'];
        $page = $request['page'];
        if (is_null($page))
            $page = 0;
        if ($beginDate && $endDate) {
            $userId = Session::get('userId');
            $datas = $this->model->getDatasByDate($userId, $beginDate, $endDate, $page);
            return $datas;
        }
    }

}
