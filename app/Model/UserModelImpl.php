<?php

namespace App\Model;

use DB;

use App\Contracts\UserModel;

class UserModelImpl implements UserModel
{
	public function searchByNickname($nickname, $page)
	{
		$users = DB::select('SELECT id, avatar, nickname, sex, city, signature, role
							FROM user
							WHERE nickname LIKE :nickname AND role != 0
							LIMIT :start, 6;', ["nickname"=>"%".$nickname."%", "start"=>$page * 5]);
		return $users;
	}

	public function getUserById($id)
	{
		$user = DB::select('SELECT id, avatar, nickname, sex, city, signature, role
							FROM user
							WHERE id = ? AND role != 0;', [$id]);
		return $user;
	}

	public function addUser($account, $password, $nickname, $city, $role, $sex,
		array $sports)
	{	
		if($city) {
			DB::insert("INSERT INTO user(role, sex, city, city_crc, nickname) values(?, ?, ?, CRC32(?), ?);"
				, [$role, $sex, $city, $city, $nickname]);
		} else {
			DB::insert("INSERT INTO user(role, sex, nickname) values(?, ?, ?);"
					, [$role, $sex, $nickname]);
		}
		$id = DB::select("SELECT id FROM user WHERE nickname = ?", [$nickname])[0]->id;
		DB::insert("INSERT INTO account(userId, account, password) values(?, ?, MD5(?))", [$id, $account, $password]);
		for($i=0; $i<count($sports); ++$i) {
			DB::insert("INSERT INTO usersport(userId, sportType) values(?, ?)", [$id, $sports[$i]]);
		}
		return $id;
	}

	public function findUser($name, $priority)
	{
		return "findUser";
	}

    public function getRoleAndCity($id) {
        $role = DB::select("SELECT role, city FROM user WHERE id = ?", [$id]);
        if(count($role) == 1)
            return $role[0];
        else
            return null;
    }

	public function deleteUser($userId)
	{
		$effectRows = DB::delete("DELETE FROM user WHERE id = ?;", [$userId]);
		DB::delete("DELETE FROM account WHERE userId = ?", [$userId]);
		return $effectRows > 0;
	}

	public function update($userId, $nickname, $city, $signature)
	{
		$effectRows = DB::update('UPDATE user SET city = ?, city_crc = CRC32(?), nickname = ?, signature = ?
								  WHERE id = ?'
								, [$city, $city, $nickname, $signature, $userId]);
		return count($effectRows) > 0;
	}

	public function modifyPriority($userId, $newPriority)
	{
		$effectedRows = DB::update("UPDATE user SET role = ? WHERE id = ?", [ $newPriority, $userId]);
		return true;
	}

	public function getUserDetail($userId)
	{
		$userDetail = DB::select('SELECT nickname, sex, role, city, avatar, signature
							  	  FROM user
								  WHERE id = ?;', [$userId]);
		return $userDetail;
	}

	public function getUserSports($userId)
	{
		$userSports = DB::select('SELECT sportType
								  FROM userSport
								  WHERE userId = ?;', [$userId]);
		return $userSports;
	}

	public function hasNickname($nickname) {
		$ids = DB::select("SELECT id FROM user WHERE nickname = ? LIMIT 1", [$nickname]);
		return count($ids) > 0;
	}

	public function hasAccount($account) {
		$ids = DB::select("SELECT userId FROM account WHERE account = ? LIMIT 1", [$account]);
		return count($ids) > 0;
	}

	public function getUserId($account, $password)
	{
		$id = DB::select("SELECT userId FROM account WHERE account = ? AND password = MD5(?)", [$account, $password]);
		if(count($id) == 1) {
			return $id[0]->userId;
		} else {
			return null;
		}
	}
	
	public function getUserLoginInfo($account, $password) 
	{
		$info = DB::select("SELECT userId, nickname, avatar FROM account LEFT JOIN user ON 
							(account.userId = user.id) WHERE account = ? AND password=MD5(?)", 
							[$account, $password]);
		if (count($info) !=0)
			return $info[0];
		else
			return null;
	}

}
