<?php

namespace App\Model;

use DB;

use App\Contracts\ActivityModel;

class ActivityModelImpl implements ActivityModel
{

	public function getActivityByTimeDesc($num)
	{
		$sql = 'SELECT id, title
				FROM activity
    			ORDER BY createTime DESC
    			LIMIT 10;';
		$activitys = DB::select($sql);
		return $activitys;
	}
	
	public function getHotestActivitys($city)
	{
		$sql = 'SELECT id, title
				FROM activity LEFT JOIN activity_join ON(activity.id = activity_join.activityId)
				WHERE city_crc = crc32(?)
				GROUP BY activity.id
				ORDER BY COUNT(userId) DESC LIMIT 10';
		$hotActivitys = DB::select($sql, [$city]);
		return $hotActivitys;
	}
	
	public function getTopHotActivity($city)
	{
		$activitys = DB::select("SELECT activity.id as id, beginDate, beginTime, endDate, endTime, place,
								 user.nickName as authorName, count(userId) as joinNum, content
								 FROM activity LEFT JOIN user ON(activity.authorId = user.id)
								 		LEFT JOIN activity_join ON(activity.id = activity_join.activityId)
								 WHERE activity.city_crc = crc32(?)
								 GROUP BY activity.id ORDER BY joinNum DESC
								 LIMIT 1", [$city]);
		return $activitys;
	}
	
	public function findActivity($title)
	{
		
	}
	
	public function getActivityByCondition($city, $page)
	{
		$activitys = DB::select("SELECT activity.id as id, beginDate, beginTime, endDate, endTime, place,
								 user.nickName as authorName, count(userId) as joinNum, content
								 FROM activity LEFT JOIN user ON(activity.authorId = user.id)
								 		LEFT JOIN activity_join ON(activity.id = activity_join.activityId)
								 WHERE activity.city_crc = crc32(?)
								 GROUP BY activity.id ORDER BY beginDate DESC, beginTime DESC
								 LIMIT ?, 5;", [$city, $page * 4]);
		return $activitys;
	}
	
	public function myActivity($userId)
	{
		
	}
	
	public function newActivity($userId, $beginDate, $beginTime, $endDate, $endTime, $city, $place, $content)
	{
		$result = DB::insert("INSERT INTO activity(authorId, beginDate, beginTime, endDate, endTime, city, city_crc,
							  place, content) values(?,?,?,?,?,?,crc32(?), ?,?)", [$userId, $beginDate, $beginTime, $endDate,
							$endTime, $city, $city, $place, $content]);
		if($result > 0)
			return true;
		else
			return false;
	}
	
	public function attendActivity($userId, $activityId)
	{
		$effectRows = DB::insert("INSERT INTO activity_join VALUES(?, ?) ON DUPLICATE KEY UPDATE userId = userId;"
				, [$userId, $activityId]);
		return count($effectRows) > 0;
	}
	
	public function getUserPublishByPage($userId, $page)
	{
		$activitys = DB::select("SELECT activity.id, beginDate, beginTime, endDate, endTime, place,
								 user.nickName as authorName, count(userId) as joinNum, content
								 FROM activity LEFT JOIN user ON(activity.authorId = user.id)
								 		LEFT JOIN activity_join ON(activity.id = activity_join.activityId)
								 WHERE authorId = ?
								 GROUP BY activity.id ORDER BY beginDate DESC, beginTime DESC
								 LIMIT ?, 5;", [$userId, $page * 4]);
		return $activitys;
	}

	public function getUserJoinByPage($userId, $page)
	{
		
	}
	
	public function deleteActivtiy($activityId)
	{
		$effectRows = DB::delete("DELETE FROM activity WHERE id = ?", [$activityId]);
		DB::delete("DELETE FROM activity_join WHERE activityId = ?", [$activityId]);
		return count($effectRows) > 0? true: false;
	}
}
