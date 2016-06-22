<?php

namespace App\Contracts;

interface FriendModel
{
	public function deleteFriend($userId);
	
	public function addFriend($userId, $friendId);
	
	public function getFriendBriefsByPage($userId, $page);
	
	public function commentToFriend($uid, $friendId, $content);
	
	public function getComments($uid, $page);
	
	public function getFreindBriefs($userId);

	public function getUserConcerns($uid, $page, $asc);

	public function getUserFans($uid, $page, $asc);
}
