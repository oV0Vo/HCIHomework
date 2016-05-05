<?php

namespace App\Model;

use DB;

use App\Contracts\HealthDataModel;

class HealthDataModelImpl implements HealthDataModel
{
	public function getStatsByCondition($userId, $datatype, $viewType)
	{
		
	}
	
	public function getDatasByDate ($userId, $beginDate, $endDate, $page)
	{
		$datas = DB::select("SELECT recordDate, walk_data.duration / 60 as walkMinute, run_data.distance as runMeters,
 									avg(rate) as avgHeartRate, avg(low) as avgLowBL, avg(high) as avgHighBL,
 									sum(sleep_data.duration) / 60 as sleepMinutes
 									FROM date_record LEFT JOIN walk_data ON(walkDataId = walk_data.id)
 									LEFT JOIN run_data ON(runDataId = run_data.id)
 									LEFT JOIN heartRate ON(heartRateId = heartRate.id)
 									LEFT JOIN bloodPressure ON(bloodPressureId = bloodPressure.id)
 									LEFT JOIN sleep_data ON(sleepDataId = sleep_data.id)
 									WHERE recordDate BETWEEN ? AND ? AND userId = ?
 									GROUP BY recordDate DESC LIMIT ?, 11;", [$beginDate, $endDate, $userId, $page * 10]);
		return $datas;
	}

	public function getTodayDatas($userId) {
		$todayHealth = DB::select("SELECT walk_data.duration / 60 as walkMinute, walk_data.steps as walkSteps,
 									run_data.duration / 60 as runMinute, run_data.distance as runMeters,
 									avg(rate) as avgHeartRate, min(rate) as lowestHeartRate, max(rate) as highestHeartRate,
 									avg(low) as avgLowBL, avg(high) as avgHighBL,
 									sum(sleep_data.duration) / 60 as sleepMinutes
 									FROM date_record LEFT JOIN walk_data ON(walkDataId = walk_data.id)
 									LEFT JOIN run_data ON(runDataId = run_data.id)
 									LEFT JOIN heartRate ON(heartRateId = heartRate.id)
 									LEFT JOIN bloodPressure ON(bloodPressureId = bloodPressure.id)
 									LEFT JOIN sleep_data ON(sleepDataId = sleep_data.id)
 									WHERE recordDate = current_date() AND userId = ?", [$userId]);
		return $todayHealth;
	}
	
	public function getDataByTimeType($userId, $timeType)
	{

	}
}
