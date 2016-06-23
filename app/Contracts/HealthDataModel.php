<?php

namespace App\Contracts;

interface HealthDataModel
{
    public function getStatsByCondition($userId, $datatype, $viewType);
	
	public function getDatasByDate($userId, $beginDate, $endDate, $page);

	public function getTodayDatas($userId);
	
	public function getDataByTimeType($userId, $timeType);
	
	public function getSportGoal($uid);

	public function setSportGoal($uid, $distance, $calories, $step);
	
	public function getSportData($uid, $fromDate, $toDate, $page);

	public function getSleepData($uid, $date);
	
	public function getSleepData($uid, $fromDate, $toDate);
	
	public function getSleepData($uid, $fromDate, $toDate, $page);
		
	public function getTotalStats($uid);
	
	public function getTotalSportData($uid);
	
	public function getFirstTenFanRank($uid);
	
	public function getFirstTenConcernRank($uid);
	
	public function getTotalRank($uid);
}
