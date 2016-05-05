<?php

namespace App\Contracts;

interface HealthPlanModel
{
    public function getHistoryPlanByPage($userId, $page);
	
	public function newPlan($annoucContent, $beginDate, $endDate, $walkMinute,
		$runMinute, $weightLossGoal);
	
	public function getCurrentPlan($userId);
	
	public function deleteUser($userId);
	
	public function update($nickname, $city, array $favariteSports, $briefInfo);
	
	public function modifyPriority($userId, $newPriority);
	
	public function getUserDetail($userId);
}
