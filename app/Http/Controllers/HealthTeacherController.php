<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HealthTeacherModel;

class HealthTeacherController extends Controller
{
	
	public function __construct(HealthTeacherModel $model)
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
		$teachers = $this->model->getTeacherBriefs($userId);
		$datas['friends'] = $teachers;
        return view('healthTeacher', $datas);
    }
	
	public function getTeacherBriefsByPage(Request $request)
	{
		$page = $request['page'];
		return 'getTeacherBriefsByPage';
	}
 	
	public function deleteTeacher (Request $request)
	{
		$teacherId = $request['teacherId'];
		return 'deleteTeacher';
	}
 	
	public function addTeacher (Request $request)
	{
		$teacherId = $request['teacherId'];
		return 'addTeacher';
	}
 	
	public function getHotTeacher(Request $request)
	{
		return 'getHotTeacher';
	}
 
}
