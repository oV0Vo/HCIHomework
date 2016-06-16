<?php

namespace App\Contracts;

interface UserModel
{
	public function searchByNickname($nickname, $page);

	public function getUserById($id);
	
	public function addUser($account, $password, $nickname, $city, $role, $sex,
		array $sports);
	
	public function findUser($name, $priority);
	
	public function deleteUser($userId);
	
	public function update($userid, $nickname, $city, $signature);
	
	public function modifyPriority($userId, $newPriority);
	
	public function getUserDetail($userId);

	public function getUserSports($userId);

	public function hasNickname($nickname);

	public function hasAccount($account);

	public function getUserId($account, $password);

	public function getRoleAndCity($id);
	
	public function getUserLoginInfo($account, $password);
}
