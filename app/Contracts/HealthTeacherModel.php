<?php

namespace App\Contracts;

interface HealthTeacherModel
{

    public function getTeacherBriefs($userId);
	
	public function deleteTeacher($teacherId);
	
	public function addTeacher ($teacherId);
	
	public function getHotTeacher();
	
	public function getByName($name);
}
