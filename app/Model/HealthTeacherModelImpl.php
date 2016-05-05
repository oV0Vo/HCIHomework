<?php

namespace App\Model;

use DB;

use App\Contracts\HealthTeacherModel;

class HealthTeacherModelImpl implements HealthTeacherModel
{
    public function getTeacherBriefs($userId)
	{
		$teachers = DB::select("SELECT id, avatar, nickname
					FROM customer_teacher JOIN user ON(teacherId = id)
					WHERE userId = ?", [$userId]);
		return $teachers;
	}
	
	public function deleteTeacher($teacherId)
	{
		
	}
	
	public function addTeacher ($teacherId)
	{
		
	}
	
	public function getHotTeacher()
	{
		
	}
	
	public function getByName($name)
	{
		
	}
}
