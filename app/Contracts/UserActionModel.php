<?php

namespace App\Contracts;

interface UserActionModel
{
	public function newUserAction($userId, $content);
	
	public function getFriendActions($userId);
	
	public function getMostPraiseFriendAction($userId, $date);
	
	public function reply($userId, $actionId, $content);
	
	public function praise($userId, $actionId);
}
