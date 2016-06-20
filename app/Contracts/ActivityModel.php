<?php

namespace App\Contracts;

interface ActivityModel
{
    public function getActivityByTimeDesc($num);
	
	public function getHotestActivitys($city);
	
	public function getTopHotActivity($city);
	
	public function findActivity($title);
	
	public function getActivityByCondition($city, $page);
	
	public function myActivity($userId);
	
	public function newActivity($userId, $beginDate, $beginTime, $endDate, $endTime, $city, $place, $content);
	
	public function attendActivity($userId, $activityId);
	
	public function getUserPublishByPage($userId, $page);

	public function getUserJoinByPage($userId, $page);
	
	public function deleteActivtiy($activityId);

	public function getHotActivity($page, $uid);
	
	public function search($key, $city, $orderType, $asc, $uid, $page);
	
	public function cancelAttend($userId, $activityId);

	public function getDetail($activityId, $uid);

	public function getAllCitys();
}
