<?php

namespace App\Contracts;

interface HealthDataModel
{
    public function getStatsByCondition($userId, $datatype, $viewType);
	
	public function getDatasByDate($userId, $beginDate, $endDate, $page);

	public function getTodayDatas($userId);
	
	public function getDataByTimeType($userId, $timeType);
	
}
