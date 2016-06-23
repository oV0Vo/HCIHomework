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

	public function newActivity($userId, $beginTime, $durationSeconds, $maxJoinNum, 
			$title, $content, $city, $place)	
	{
		$result = DB::insert("INSERT INTO activity(title, authorId, city, city_crc,
							  place, content, joinNum, maxJoinNum, beginTime, duration) 
							  VALUES(?,?,?,CRC32(?),?,?, 0, ?, ?, ?)", [$title, $userId, $city, 
							$city, $place, $content, $maxJoinNum, $beginTime, $durationSeconds]);
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

	public function cancelAttend($userId, $activityId)
	{
		$effectRows = DB::delete("DELETE FROM activity_join WHERE userId = ? AND activityId = ?"
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
		$hasJoins = array();
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$activitys = DB::select("SELECT id, beginTime, duration, title, content, 
								 joinNum, maxJoinNum 
								 FROM activity
								 WHERE beginTime + duration > current_timestamp()
								 ORDER BY joinNum DESC LIMIT ?, ?", [$fetchFrom, $fetchNum]);

		$totalNum = count($activitys);
		$leftPage = (int)(($totalNum - 1)/ 10);
		$activitys = array_slice($activitys, 0, 10);
		$actCount = count($activitys);
		if ($uid) {
			for ($i=0; $i < $actCount; ++$i) {
				$joinFriends[$i] = DB::select("SELECT id, avatar, nickname
											   FROM activity_join LEFT JOIN user
													ON (activity_join.userId = user.id)
											   WHERE activity_join.activityId = ?
											   AND activity_join.userId <> ?
											   LIMIT 0, 10",
											   [$activitys[$i]->id, $uid]);
				$hasJoins[$i] = $this->getHasJoin($activitys[$i]->id, $uid);
			}
		}

		
		return array("activitys" => $activitys, "hasJoins" => $hasJoins, "joinFriends" => $joinFriends, "leftPage" => $leftPage);
	}
	
	public function search($key, $city, $orderType, $asc, $uid, $page) 
	{
		$order = $orderType == 0? 'beginTime': 'joinNum';
		$order = $asc? $order.' ASC' : $order.' DESC';
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$activitys = DB::select("SELECT id, beginTime, duration, title, content, 
									    joinNum, maxJoinNum 
								 FROM activity 
								 WHERE city_crc = crc32(?) AND (title like ? OR content like ?) 
									   AND beginTime + duration > current_timestamp() 
								 ORDER BY ? 
								 LIMIT ?, ?;", [$city, '%'.$key.'%', '%'.$key.'%', $order, 
								 $fetchFrom, $fetchNum]);
								 
		$totalNum = count($activitys);
		$leftPage = (int)(($totalNum - 1)/ 10);
		$activitys = array_slice($activitys, 0, 10);
		$actCount = count($activitys);
		
		$hasJoins = array();
		$leftPage = (int)(($totalNum - 1)/ 10);
		if ($uid) {
			for ($i=0; $i < $actCount; ++$i) {
				$hasJoins[$i] = $this->getHasJoin($activitys[$i]->id, $uid);
			}
		}
		return array("activitys" => $activitys, "hasJoins" => $hasJoins, "leftPage" => $leftPage);
	}

	public function getDetail($activityId, $uid)
	{
		$activitys = DB::select("SELECT activity.id id , authorId, user.nickname authorName, user.avatar authorAvatar,
										beginTime, duration, title, content, activity.city city, place,
										joinNum, maxJoinNum, false hasJoin
								 FROM activity
									LEFT JOIN user ON(activity.authorId = user.id)
								 WHERE activity.id = ?
								 LIMIT 0, 1", [$activityId]);
							 
		$actCount = count($activitys);
		$activity = null;
		$joinFriends = null;
		$hasJoin = $this->getHasJoin($activityId, $uid);
		if ($actCount != 0) {
			$activity = $activitys[0];
			if ($uid) {
				$joinFriends = DB::select("SELECT user.id id, avatar, nickname 
											   FROM activity_join LEFT JOIN friend 
												    ON(friend.friendId = activity_join.userId) 
													LEFT JOIN user ON (friend.friendId = user.id) 
											   WHERE activity_join.activityId = ? AND 
											   friend.userId = ? ", 
											   [$activityId, $uid]);
			}
		}
		
		return array("activity" => $activity, "hasJoin" => $hasJoin, "joinFriends" => $joinFriends);
	}
	
	public function getHasJoin($activityId, $uid) {
		if ($uid) {
			$joins = DB::select("SELECT 1 FROM activity_join 
						WHERE activityId = ? AND userId = ?;", 
						[$activityId, $uid]);
			return count($joins) != 0;
		} else {
			return false;
		}
	}
	
	public function getAllCitys() 
	{
		return array("南京", "上海", "杭州", "苏州", "无锡");
	}
	
	public function getUserPublish($uid, $page) 
	{
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$activitys = DB::select("SELECT id, beginTime, duration, title, content, 
									    joinNum, maxJoinNum 
								 FROM activity 
								 WHERE authorId = ? 
								 LIMIT ?, ?;", [$uid, $fetchFrom, $fetchNum]);
		$totalNum = count($activitys);
		$leftPage = (int)(($totalNum - 1)/ 10);
		$activitys = array_slice($activitys, 0, 10);
		$actCount = count($activitys);
		return array("activitys" => $activitys, "leftPage" => $leftPage);
	}
	
	public function getUserAttend($uid, $page)
	{
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$activitys = DB::select("SELECT id, beginTime, duration, title, content, 
									    joinNum, maxJoinNum 
								 FROM activity_join LEFT JOIN activity 
									ON(activity.id = activity_join.activityId) 
								 WHERE activity_join.userId = ? 
								 LIMIT ?, ?;", [$uid, $fetchFrom, $fetchNum]);
		$totalNum = count($activitys);
		$leftPage = (int)(($totalNum - 1)/ 10);
		$activitys = array_slice($activitys, 0, 10);
		$actCount = count($activitys);
		return array("activitys" => $activitys, "leftPage" => $leftPage);
	}
	
	public function getSportGoal($uid) 
	{
		
	}
	
	public function setSportGoal($uid, $distance, $calories, $step)
	{
		
	}
	
	public function getSportData($uid, $fromDate, $toDate, $page)
	{
		
	}
	
	public function getTotalSportData($uid)
	{
		
	}
	
	public function getSleepData($uid, $date)
	{
		
	}
	
	public function getSleepDate($uid, $fromDate, $toDate)
	{
		
	}
	
	public function getSleepDate($uid, $fromDate, $toDate)
	{
		
	}
	
	
}
