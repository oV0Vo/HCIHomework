<?php

namespace App\Contracts;

interface TeacherAdModel
{
	public function newAd($userId, $title, $content, $city);
	
	public function getMyAdByPage($userId, $page);
}
