<?php

namespace App\Contracts;

interface FriendModel
{
	public function deleteFriend($userId);
	
	public function addFriend($userId, $friendId);
	
	public function getFriendBriefsByPage($userId, $page);
	
	public function commentToFriend($content);
	
	public function getFreindBriefs($userId);
}
