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
	
	
	public function getSportGoal($uid) 
	{
		$goal = DB::select("SELECT distance, calories, step 
							FROM sportGoal 
							WHERE uid = ?", [$uid]);
		return $goal;
	}
	
	public function setSportGoal($uid, $distance, $calories, $step)
	{
		$success = DB::update("UPDATE sportGoal SET distance = ?, calories = ?, step = ? 
								WHERE uid = ?", [$uid]);
		return $success;
	}
	
	public function getSportData($uid, $fromDate, $toDate, $page)
	{
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$sportDatas = DB::select("SELECT recordDate date, meter distance, duration, calories, step 
								  FROM sport_data 
								  WHERE uid = ? AND recordDate BETWEEN ? AND ? 
								  ORDER BY recordDate DESC 
								  LIMIT ?, ?", [$uid, $fromDate, $toDate, $fetchFrom, $fetchNum]);

		$leftPage = (int)((count($sportDatas) - 1)/ 10);
		$sportDatas = array_slice($sportDatas, 0, 10);
		return array("sportDatas" => $sportDatas, "leftPage" => $leftPage);
	}
	
	public function getSleepData($uid, $date)
	{
		$data = DB::select("SELECT recordDate, fromTime, toTime, 
								   totalMinute, shallowSleepMinute, deepSleepMinute 
								   FROM sleep_data 
								   WHERE uid = ? AND recordDate = ?"
								   , [$uid, $date]);
		return $data;
	}
	
	public function getSleepData($uid, $fromDate, $toDate)
	{
		$data = DB::select("SELECT recordDate, totalMinute, shallowSleepMinute, deepSleepMinute 
							FROM sleep_data 
							WHERE uid = ? AND recordDate BETWEEN ? AND ? 
							GROUP BY recordDate 
							ORDRE BY recordDate DESC", 
							[$uid, $fromDate, $toDate]);
		return $data;
	}
	
	public function getSleepData($uid, $fromDate, $toDate, $page)
	{
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$sleepDatas = DB::select("SELECT recordDate, totalMinute, shallowSleepMinute, deepSleepMinute 
								  FROM sleep_data 
								  WHERE uid = ? AND recordDate BETWEEN ? AND ? 
								  GROUP BY recordDate 
								  ORDER BY recordDate DESC 
								  LIMIT ?, ?", 
								  [$uid, $fromDate, $toDate, $fetchFrom, $fetchNum]);
		$leftPage = (int)((count($sleepDatas) - 1)/ 10);
		$sleepDatas = array_slice($sleepDatas, 0, 10);
		return array("sleepDatas" => $sleepData, "leftPage" => $leftPage);
	}
	
	public function getTotalStats($uid) 
	{
		
	}
	
	public function getTotalSportData($uid)
	{
		$data = DB::select("SELECT uid, meter, duration, calories, step 
							FROM total_sport_data 
							WHERE uid = ?", [$uid]);
		return $data;
	}	
	
	public function getFirstTenFanRank($uid) 
	{ 
		$data = DB::select("SELECT user.id uid, avatar, nickname, rank 
							 FROM friend 
								LEFT JOIN sport_rank ON(sport_rank.uid = friend.userId) 
							 WHERE friend.friendId = ? 
							 ORDER BY rank ASC 
							 LIMIT 0, 10", [$uid]);
		return $this->mergeMyRank($ranks, $uid);
	}
	
	public function getFirstTenConcernRank($uid) 
	{
		$ranks = DB::select("SELECT user.id uid, avatar, nickname, rank 
							 FROM friend 
								LEFT JOIN sport_rank ON(sport_rank.uid = friend.friendId) 
							 WHERE friend.userId = ? 
							 ORDER BY rank ASC 
							 LIMIT 0, 10", [$uid]);
		return $this->mergeMyRank($ranks, $uid);
	}
	
	private function mergeMyRank($ranks, $uid) 
	{
		$myRank = $this->getUserRank($uid);
		$data = array_merge($data, $myRank);
		$data = usort($data, function($a, $b) {
			return $a->rank > $b->rank;});
		$data = array_slice($data, 0, 10);
		return $data;
	}
	
	private function getUserRank($uid) {
		$myRank = DB::select("SELECT uid, avatar, nickname, rank 
							  FROM sport_rank 
							  WHERE uid = ?", [$uid]);
		return $myRank;
	}
	
	public function getTotalRank($uid) 
	{
		return $this->getUserRank($uid);
	}
}
