<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HealthAdviceModel;

class HealthAdviceController extends Controller
{	

	public function __construct(HealthAdviceModel $model)
	{
		$this->model = $model;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$userId = Session::get('userId');
		$datas['advices'] = $this->model->getAdviceByPage($userId, 0);
		return view('healthAdvice', $datas);
    }

	public function getAdviceByPage(Request $request) 
	{
		$page = $request['page'];
		return "getAdviceByPage";
	}
	
	public function getReceivedAdviceByTeacher(Request $request)
	{
		$receivorId = Session::get('userId');
		$advisorId = $request['teacherId'];
		$page = $request['page'];
		return 'getRec';
	}
	
	public function getPromtAdviceByUser(Request $request)
	{
		$userId = $request['userId'];
		return 'getPro';
		
	}

	public function addAdvice(Request $request) {
		$advisorId = Session::get('userId');
		$receiverId = $request['receiverId'];
		$content = $request['content'];
		$addSuccess = $this->model->addAdvice($receiverId, $advisorId, null, $content);
		return $addSuccess ? "true": "false";
	}
	
	public function importAdvice(Request $request)
	{
		//$adviceFile = $File['upload']['adviceFile'];
		return 'importA';
	}

}
