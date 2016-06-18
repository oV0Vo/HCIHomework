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
	
	public function getHotActivity($page, $uid)
	{
		$activitys = array();
		$joinFriends = array();
		$prefetchPage = $page < 5? 10 - $page: 5;
		$prefetchNum = ($page + $prefetchPage) * 10 + 1;
		if($uid) {
			$activitys = DB::select("SELECT id, beginTime, duration, title, content,
								 joinNum, maxJoinNum, !ISNULL(activity_join.userId) hasJoin
								 FROM activity 
									  LEFT JOIN activity_join ON(activity.id = activity_join.activityId)
								 WHERE beginTime + duration > current_timestamp() AND activity_join.userId = ? 
								 ORDER BY joinNum DESC LIMIT ?, ?", [$uid, $page * 10, $prefetchNum]);
		} else {
			$activitys = DB::select("SELECT id, beginTime, duration, title, content, 
								 joinNum, maxJoinNum, FALSE 
								 FROM activity 
								 WHERE beginTime + duration > current_timestamp() 
								 ORDER BY joinNum DESC LIMIT ?, ?", [$page * 10, $prefetchNum]);
		}
	
		$actCount = count($activitys);
		if ($uid) {
			for ($i=0; $i < $actCount; ++$i)
				$joinFriends[$i] = DB::select("SELECT id, avatar, nickname 
											   FROM activity_join LEFT JOIN user 
													ON (activity_join.userId = user.id) 
											   WHERE activity_join.activityId = ? 
											   AND activity_join.userId <> ?", 
											   [$activitys[$i]->id, $uid]);
		}
		
		$leftPage = ($actCount - 1)/ 10;
		
		return array("activitys" => $activitys, "joinFriends" => $joinFriends, "leftPage" => $leftPage);
	}
	
	public function search($key, $place, $orderType) 
	{
		$activitys = DB::select("SELECT id, beginTime, duration, title, content, 
									    joinNum, maxJoinNum, !ISNULL(activity_join.userId) hasJoin 
								 FROM activity 
								 	  LEFT JOIN activity_join ON(activity.id = activity_join.activityId)
								 WHERE ");
	}
}
