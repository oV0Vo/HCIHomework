<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\TeacherAdModel;

class TeacherAdController extends Controller
{
	
	public function __construct(TeacherAdModel $model)
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
        return "TeacherAdController";
    }
		
	public function newAd(Request $request)
	{
		$title = $request['title'];
		$content = $request['content'];
		$city = $request['city'];
		return 'newAd';
	}
 			
	public function getMyAdByPage(Request $request)
	{
		$page = $request['page'];
		return 'getMyAdByPage';
	}
 	
}
