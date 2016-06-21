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
		$prefetchPage = $page < 5? 10 - $page: 5;
		$prefetchNum = ($page + $prefetchPage) * 10 + 1;
		$comments = DB::select("SELECT * FROM friendcomment 
								WHERE receiverId = ? 
								LIMIT ?, ?", 
								[$userId, $page * 10, $prefetchNum]);
		$leftPage = (count($comment) - 1)/ 10;
		return array("comments" => $comments, "leftPage" => $leftPage);
	}
	
	public function getFreindBriefs($userId)
	{
		$friends = DB::select("SELECT friendId, avatar, nickname
    				FROM friend JOIN user ON(friend.friendId = user.id)
    				WHERE userId = ?;", [$userId]);
		return $friends;
	}
}
