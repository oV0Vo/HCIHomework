<?php

namespace App\Model;

use DB;

use App\Contracts\HealthAdviceModel;

class HealthAdviceModelImpl implements HealthAdviceModel
{
	
    public function getAdviceByPage($userId, $page)
	{
		$advices = DB::select('SELECT content, nickname as advisorName,
 								role as advisorType, adviseTime div 1000000 as adviseDate
							   FROM advice JOIN user ON(advice.advisorId = user.id)
							   WHERE receiverId = ?
     						   ORDER BY adviseTime LIMIT ?, 10;', [$userId, $page * 10]);
		return $advices;
	}

	public function getAdviceByDateRange($beginDate, $endDate, $page) {
		$beginTime = $beginDate * 1000000;
		$endTime = $endDate * 1000000;
		$advices = DB::select('SELECT * FROM advice WHERE adviceTime BETWEEN ? AND ?
					ORDER BY adviseTime DESC LIMIT ?,10;', [$beginTime, $endTime, $page * 10]);
		return $advices;
	}

	public function getAdviceByRelation($receivorId, $advisorId, $page)
	{
		$advices = DB::select('SELECT * FROM advice WHERE receiverId = ? AND advisorId = ?
 					ORDER BY adviseTime DESC  LIMIT ?, 10;', [$receivorId, $advisorId, $page * 10]);
		return $advices;
	}

	
	public function addAdvice($receivorId, $advisorId, $adviceTime, $content)
	{
		if(is_null($adviceTime)) {
			$effectRows = DB::insert('INSERT INTO advice VALUES(?, ?, current_timestamp(), ?)',
					[$receivorId, $advisorId, $content]);
		} else {
			$effectRows = DB::insert('INSERT INTO advice VALUES(?, ?, ?, ?)', [$receivorId, $advisorId,
					$adviceTime, $content]);
		}
		return count($effectRows) > 0;
	}
}
