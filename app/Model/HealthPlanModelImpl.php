<?php

namespace App\Model;

use DB;

use App\Contracts\HealthPlanModel;

class HealthPlanModelImpl implements HealthPlanModel
{

    public function getHistoryPlanByPage($userId, $page)
	{
        $pageNum = 3;
		$historyPlans = DB::select('SELECT * FROM sportPlan WHERE userId = ? AND endDate < current_date()
                            ORDER BY endDate DESC LIMIT ?, ?;', [$userId, $page * $pageNum, $pageNum]);
        return $historyPlans;
	}
	
	public function newPlan($annoucContent, $beginDate, $endDate, $walkMinute,
		$runMinute, $weightLossGoal)
	{
		
	}
	
	public function getCurrentPlan($userId)
	{
		$currentPlans = DB::select("SELECT * FROM sportPlan WHERE userId = ? AND endDate >= current_date();" ,
            [$userId]);
        return $currentPlans;
	}
	
	public function deleteUser($userId)
	{

	}
	
	public function update($nickname, $city, array $favariteSports, $briefInfo)
	{
		
	}
	
	public function modifyPriority($userId, $newPriority)
	{
		
	}
	
	public function getUserDetail($userId)
	{
		
	}
}
