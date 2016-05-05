<?php

namespace App\Contracts;

interface HealthAdviceModel
{
    public function getAdviceByPage($userId, $page);

	public function getAdviceByDateRange($beginDate, $endDate, $page);
	
	public function getAdviceByRelation($receivorId, $advisorId, $page);
	
	public function addAdvice($receivorId, $advisorId, $adviceTime, $content);
	
}
