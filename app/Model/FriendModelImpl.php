<?php

namespace App\Model;

use DB;

use App\Contracts\FriendModel;

class FriendModelImpl implements FriendModel
{	

	public function deleteFriend($userId)
	{
		
	}
	
	public function addFriend($userId, $friendId)
	{
		$effectedRows = DB::insert("INSERT INTO friend VALUES(?, ?) ON DUPLICATE KEY UPDATE userId = userId;"
				, [$userId, $friendId]);
		return $effectedRows > 0;
	}
	
	public function getFriendBriefsByPage($userId, $page)
	{
	}
	
	public function commentToFriend($uid, $friendId, $content)
	{
		$effectedRows = DB::insert("INSERT IGNORE INTO friendcomment VALUES(?, ?, current_timestamp(),
									?", [$friendId, $uid, $content]);
		return ($effectedRows) > 0;
	}
	
	public function getComments($uid, $page)
	{
		$perPageNum = 10;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$comments = DB::select("SELECT user.id authorId, user.avatar authorAvatar, user.nickname authorName, 
									   friendcomment.createTime commentTime, content
								FROM friendcomment 
									LEFT JOIN user ON(user.id = friendcomment.senderId) 
								WHERE receiverId = ? 
								LIMIT ?, ?", 
								[$uid, $fetchFrom, $fetchNum]);
		$leftPage = (int)((count($comments) - 1) / 10);
		return array("comments" => $comments, "leftPage" => $leftPage);
	}
	
	public function getFreindBriefs($userId)
	{
		$friends = DB::select("SELECT friendId, avatar, nickname
    				FROM friend JOIN user ON(friend.friendId = user.id)
    				WHERE userId = ?;", [$userId]);
		return $friends;
	}
	
	public function getUserConcerns($uid, $page, $asc) {
		$perPageNum = 6;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$users = DB::select("SELECT id, avatar, nickname 
							 FROM friend LEFT JOIN user ON(friend.friendId = user.id) 
							 WHERE friend.userId = ? 
							 ORDER BY ? 
							 LIMIT ?, ?", 
							 [$uid, $asc? "concernTimeconcernTime ASC": "concernTime DESC", 
							 $page * $fetchFrom , $fetchNum]);
		$totalNum = count($users);
		$leftPage = (int)(($totalNum - 1)/ $perPageNum);
		$users = array_slice($users, 0, $perPageNum);
		return array("users" => $users, "leftPage" => $leftPage, 'asc' => $asc);
	}
	
	public function getUserFans($uid, $page, $asc) {
		$perPageNum = 6;
		$fetchFrom = $page * $perPageNum;
		$prefetchPage = $page < 5? 10 - $page: 5;
		$fetchNum = $prefetchPage * $perPageNum + 1;
		$users = DB::select("SELECT id, avatar, nickname 
							 FROM friend LEFT JOIN user ON(friend.userId = user.id) 
							 WHERE friend.friendId = ? 
							 ORDER BY ? 
							 LIMIT ?, ?", 
							 [$uid, $asc? "concernTime ASC": "concernTime DESC",
							 $page * $fetchFrom , $fetchNum]);
		$totalNum = count($users);
		$leftPage = (int)(($totalNum - 1)/ $perPageNum);
		$users = array_slice($users, 0, $perPageNum);
		return array("users" => $users, "leftPage" => $leftPage, 'asc' => $asc);
	}
}
